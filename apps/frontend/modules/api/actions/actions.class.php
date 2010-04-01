<?php

/**
 * api actions.
 *
 * @package    dockeet
 * @subpackage api
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class apiActions extends sfActions
{
  /**
   * Executes an application defined process prior to execution of this sfAction object.
   *
   * By default, this method is empty.
   */
  public function preExecute()
  {
    $api_access = Doctrine::getTable('ApiAccess')->findOneBy('api_key', $this->getRequest()->getParameter('api_key', ''));

    if (!$api_access instanceof ApiAccess)
    {
      throw new sfException("Wrong API Key");
    }

    $parameters = $this->getRequest()->getParameterHolder()->getAll();
    ksort($parameters);

    $plain_sig = $api_access->api_secret;
    foreach ($parameters as $key => $value)
    {
      if (in_array($key, array('api_sig', 'module', 'action'))) continue;
      $plain_sig .= $key . $value;
    }

    if ($this->getRequest()->getParameter('api_sig') !== md5($plain_sig))
    {
      throw new sfException("Wrong API signature");
    }

    if (!$api_access->User->isNew())
    {
      $this->getUser()->login($api_access->User);
    }
    $this->api_access = $api_access;
  }

 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeList (sfWebRequest $request)
  {
    $category = $request->hasParameter('slug') ? Doctrine::getTable('Category')->findOneBy('slug', $request->getParameter('slug', '')) : null;
    $document_query = $this->getUser()->getDocumentsQuery($category);
    $document_query->limit($request->getParameter('limit', 10));

    $document_yaml = array();
    foreach ($document_query->execute() as $document)
    {
      $document_yaml[$document->slug] = array(
        'title' => $document->title,
        'updated_at' => $document->updated_at,
        'size' => $document->size,
        'description' => $document->description,
        'thumbnail' => $document->genThumbnail($request->getParameter('width', 125)),
        'download' => '/api/download?slug=' . $document->slug . '&api_key=' . $this->api_access->api_key . '&api_sig=' . md5($this->api_access->api_secret . 'api_key' . $this->api_access->api_key . 'slug' . $document->slug)
      );
    }

    sfConfig::set('sf_web_debug', false);
    return $this->renderText(sfYaml::dump($document_yaml));
  }

  /**
   *
   * @param sfWebRequest $request
   */
  public function executeDownload (sfWebRequest $request)
  {
    $document = Doctrine::getTable('Document')->findOneBy('slug', $request->getParameter('slug', ''));
    if (!$document instanceof Document)
    {
      throw new sfException("Bad slug.");
    }

    $version = ($request->hasParameter('version')) ? Doctrine::getTable('DocumentVersion')->find($request->getParameter('version')) : null;

    $this->setLayout(false);
    sfConfig::set('sf_web_debug', false);

    $file_path = ($version instanceof DocumentVersion) ? $document->getFilePath($version->id) : $document->getFilePath();
    if (! file_exists($file_path) || ! is_readable($file_path))
    {
      throw new sfException(sprintf("File %s doesn't exist or read access denied.", $file_path));
    }


    // Adding the file to the Response object
    $this->getResponse()->clearHttpHeaders();
    $this->getResponse()->setHttpHeader('Pragma: public', true);
    $this->getResponse()->setHttpHeader('Content-Disposition', 'attachment; filename=' . (($version instanceof DocumentVersion) ? $version->file : $document->file));
    $this->getResponse()->setContentType(($version instanceof DocumentVersion) ? $version->mime_type : $document->mime_type);
    $this->getResponse()->sendHttpHeaders();
    $this->getResponse()->setContent(readfile($file_path));

    return sfView::NONE;

  }

}

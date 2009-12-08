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
    $api_access = Doctrine::getTable('ApiAccess')->findOneBy('api_key', $this->getRequest()->getParameter('api_key'));
    
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
  }
  
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeList(sfWebRequest $request)
  {
    $category = $request->hasParameter('slug') ? Doctrine::getTable('Category')->findOneBy('slug', $request->getParameter('slug', '')) : null;
    $document_query = $this->getUser()->getDocumentsQuery($category);
  }
}

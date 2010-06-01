<?php

/**
 * document actions.
 *
 * @package    dockeet
 * @subpackage document
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class documentActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
  	$document = Doctrine::getTable('Document')->findOneBy('slug', $request->getParameter('slug', ''));

  	$this->forward404Unless($document instanceof Document, "Unknown document.");

  	$this->document = $document;
  }

 /**
  * Executes add action
  *
  * @param sfRequest $request A request object
  */
  public function executeAdd(sfWebRequest $request)
  {
  	$category = Doctrine::getTable('Category')->findOneBy('slug', $request->getParameter('category_slug'));

  	if (!$category instanceof Category)
  	{
  		throw new sfException(sprintf("Category slug '%s' unknown", $request->getParameter('category_slug')));
  	}


    $document = Doctrine::getTable('Document')->createQuery('d')->where('slug = ?', $request->getParameter('slug', ''))->fetchOne();

    if (!$document instanceof Document && $request->isMethod('post'))
    {
      $file = $request->getFiles('file');
      $document = array_key_exists('name', $file) ? Doctrine::getTable('Document')->createQuery('d')->leftJoin('d.Categories')->where('title = ?', substr($file['name'], 0, strrpos($file['name'], '.')))->fetchOne() : null;
    }

    if (!$document instanceof Document)
    {
      $document = new Document();
    }

  	$form = new DocumentFrontendAddForm($document);

  	if ($request->isMethod('post'))
  	{
  	  if ($form->bindAndSave($request->getPostParameters(), $request->getFiles()))
  	  {
  	  	if (0 == Doctrine::getTable('DocumentCategory')->createQuery('d')->where('document_id = ? AND category_id = ?', array($form->getObject()->id, $category->id))->count())
  	  	{
  	  		$document_category = new DocumentCategory();
  	  		$document_category->Document = $form->getObject();
  	  		$document_category->Category = $category;
  	  		$document_category->save();
  	  	}
  	  	return $this->renderPartial('document/document_edit_url', array('document' => $form->getObject()));
  	  }
  	  else
  	  {
  	  	return $this->renderPartial('document/document_upload_fail', array('form' => $form));
  	  }
  	}
  	$this->category = $category;
  	$this->form = $form;
  }

 /**
  * Executes edit action
  *
  * @param sfRequest $request A request object
  */
  public function executeEdit(sfWebRequest $request)
  {
    $document = Doctrine::getTable('Document')->find($request->getParameter('id', ''));
    if (!$document instanceof Document)
    {
    	$document = Doctrine::getTable('Document')->findOneBy('slug', $request->getParameter('slug', ''));
    }

    $form = new DocumentFrontendForm($document);
    if ($request->isMethod('post'))
    {
      if ($form->bindAndSave($request->getParameter($form->getName()), $request->getFiles($form->getName())))
        $this->getUser()->setFlash('notice', 'Document successfully saved');
      else
        $this->getUser()->setFlash('error', 'An error occurred during the saving of the document');
    }

    $this->form = $form;
  }

 /**
  * Executes delete action
  *
  * @param sfRequest $request A request object
  */
  public function executeDelete(sfWebRequest $request)
  {
    $document = Doctrine::getTable('Document')->findOneBy('slug', $request->getParameter('slug', ''));

    $document->delete();

    $this->getUser()->setFlash('notice', 'Document successfully deleted');
    $this->redirect('@homepage');
  }

 /**
  * Executes download action
  *
  * @param sfRequest $request A request object
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
	  $this->getResponse()->setHttpHeader('Content-Disposition', 'attachment; filename=' . $document->getDownloadFilename($version));
	  $this->getResponse()->setContentType(($version instanceof DocumentVersion) ? $version->mime_type : $document->mime_type);
	  $this->getResponse()->sendHttpHeaders();
	  $this->getResponse()->setContent(readfile($file_path));

	  return sfView::NONE;
  }

 /**
  * Executes thumbnail action
  *
  * @param sfRequest $request A request object
  */
  public function executeThumbnail(sfWebRequest $request)
  {
    $document = Doctrine::getTable('Document')->findOneBy('slug', $request->getParameter('slug', ''));
    if (!$document instanceof Document)
    {
      throw new sfException("Bad slug.");
    }

    $this->setLayout(false);
	  sfConfig::set('sf_web_debug', false);

	  $file_path = $document->genThumbnail($request->getParameter('width', 150));
	  if (! file_exists($file_path) || ! is_readable($file_path))
	  {
	  	throw new sfException(sprintf("File %s doesn't exist or read access denied.", $file_path));
	  }

	  // Adding the file to the Response object
	  $this->getResponse()->clearHttpHeaders();
	  $this->getResponse()->setHttpHeader('Pragma: public', true);
	  $this->getResponse()->setHttpHeader('Content-Disposition', 'attachment; filename=' . basename($file_path));
	  $this->getResponse()->setContentType('image/png');
	  $this->getResponse()->sendHttpHeaders();
	  $this->getResponse()->setContent(readfile($file_path));

	  return sfView::NONE;
  }

  /*
  * Executes search action
  *
  * @param sfRequest $request A request object
  */
  public function executeSearch (sfWebRequest $request)
  {
    $form = new DocumentSearchForm();

    $form->bind(array('q' => $request->getParameter('q')));
    $this->getUser()->setFlash('q', $request->getParameter('q'));

    if ($form->isValid())
    {
      $documents_query = $this->getUser()->getDocumentsQuery(array('search' => $form->getValue('q')));

      $pager = new sfDoctrinePager('Document');
      $pager->setQuery($documents_query);
      $pager->setPage($request->getParameter('page', 1));
      $pager->init();
    }
    else
    {
      $pager = null;
    }

    $this->pager = $pager;
    $this->form = $form;
  }

  /**
   *
   * @param sfWebRequest $request
   */
  public function executeAddCategory (sfWebRequest $request)
  {
    $request_document = $request->getParameter('document');
    $document = Doctrine::getTable('Document')->find($request_document['id']);
    if (!$document instanceof Document)
    {
      throw new sfException("Document ID unknown.");
    }

    $form = new DocumentCategoryAddForm($document);
    if ($form->bindAndSave($request->getParameter($form->getName())))
      $this->getUser()->setFlash('notice', 'Document successfully added in category');
    else
      $this->getUser()->setFlash('error', 'An error occurred during the saving of the document');

    $this->renderPartial('document_categories', array('form' => $form));
    return sfView::NONE;
  }

  /**
   *
   * @param sfWebRequest $request
   */
  public function executeRemoveCategory (sfWebRequest $request)
  {
    $document = Doctrine::getTable('Document')->findOneBy('slug', $request->getParameter('slug', ''));
    if (!$document instanceof Document)
    {
      throw new sfException("Bad slug.");
    }

    if (1 < count($document->Categories))
    {
      $document->unlink('Categories', array($request->getParameter('category_id')), true);
      $this->getUser()->setFlash('notice', 'Document successfully removed from category');
    }
    else
      $this->getUser()->setFlash('error', 'An error occurred during the saving of the document');

    $this->renderPartial('document_categories', array('form' => new DocumentCategoryAddForm($document)));
    return sfView::NONE;
  }

 /**
  * Subscribe to a document
  * @param sfRequest $request A request object
  */
  public function executeSubscribe (sfWebRequest $request)
  {
    $document = Doctrine::getTable('Document')->findOneBy('slug', $request->getParameter('slug', ''));
    if (!$document instanceof Document)
    {
      throw new sfException("Wrong Document slug.");
    }

    $document->subscribe($this->getUser()->getUser());
    $this->getUser()->setFlash('notice', 'Document subscription successfully saved');

    $this->redirect('document/index?slug=' . $document->slug);
  }

 /**
  * Subscribe to a document
  * @param sfRequest $request A request object
  */
  public function executeUnsubscribe (sfWebRequest $request)
  {
    $document = Doctrine::getTable('Document')->findOneBy('slug', $request->getParameter('slug', ''));
    if (!$document instanceof Document)
    {
      throw new sfException("Wrong Document slug.");
    }

    $document->unsubscribe($this->getUser()->getUser());
    $this->getUser()->setFlash('notice', 'Document unsubscription successfully saved');

    $this->redirect('document/index?slug=' . $document->slug);
  }

 /**
  * Add a Tag from a document
  * @param sfRequest $request A request object
  */
  public function executeAddTag(sfWebRequest $request)
  {
    $document = Doctrine::getTable('Document')->findOneBy('slug', $request->getParameter('slug', ''));
    if (!$document instanceof Document)
    {
      throw new sfException("Wrong Document slug.");
    }

    $tag = Doctrine::getTable('Tags')->find($request->getParameter('tag_id'));
    if (!$tag instanceof Tag)
    {
      throw new sfException("Wrong Tag Id.");
    }

    $document->Tags[] = $tag;
    $document->save();

    return $this->getPartial('document/document_tags', array('document' => $document));
  }

 /**
  * Remove a Tag from a document
  * @param sfRequest $request A request object
  */
  public function executeRemoveTag(sfWebRequest $request)
  {
    // TODO
  }


}

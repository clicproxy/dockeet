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
    $document = Doctrine::getTable('Document')->findOneBy('slug', $request->getParameter('slud', ''));
    
  	$form = new DocumentFrontendAddForm($document);
  	
  	if ($request->isMethod('post') && $form->bindAndSave($request->getParameter($form->getName()), $request->getFiles($form->getName())))
  	{
  		$this->redirect('document/edit?id=' . $form->getObject()->id);
  	}
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
    if ($request->isMethod('post') && $form->bindAndSave($request->getParameter($form->getName())))
    {
    	
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
    
    $this->getUser()->setFlash('notice', 'File has been deleted.');
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
  
    $this->setLayout(false);
	  sfConfig::set('sf_web_debug', false);
	  
	  if (! file_exists($document->getFilePath()) || ! is_readable($document->getFilePath()))
	  {
	  	throw new sfException(sprintf("File %s doesn't exist or read access denied.", $document->getFilePath()));
	  }
	
	  // Adding the file to the Response object
	  $this->getResponse()->clearHttpHeaders();
	  $this->getResponse()->setHttpHeader('Pragma: public', true);
	  $this->getResponse()->setHttpHeader('Content-Disposition', 'attachment; filename=' . $document->file);
	  $this->getResponse()->setContentType($document->getMimeType());
	  $this->getResponse()->sendHttpHeaders();
	  $this->getResponse()->setContent(readfile($document->getFilePath()));
	
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
      $documents_query = $this->getUser()->getDocumentsQuery();
      $documents_query = Doctrine_Core::getTable('Document')->search($form->getValue('q'), $documents_query);
      
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
}

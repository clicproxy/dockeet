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
  	$document = Doctrine::getTable('Document')->findOneBy('slug', $request->getParameter('slud', ''));
  	
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
  		$this->redirect('document/edit?id=' . $document->id);
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
    	$document = Doctrine::getTable('Document')->findOneBy('slug', $request->getParameter('slud', ''));
    }
    
    $form = new DocumentFrontendForm($document);
    if ($request->isMethod('post') && $form->bindAndSave($request->getParameter($form->getName()), $request->getParameter($form->getName())))
    {
    	
    }
    
    $this->document = $document;
  }
}

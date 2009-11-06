<?php

/**
 * category actions.
 *
 * @package    dockeet
 * @subpackage category
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class categoryActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
  	$category = Doctrine::getTable('Category')->findOneBy('slug', $request->getParameter('slug', ''));
  	$title = sfContext::getInstance()->getI18N()->__('Homepage');
  	
  	$documents_query = Doctrine_Query::create()->from('document d');
    $documents_query->addOrderBy((($this->getUser()->hasAttribute('order_by', 'document')) ? $this->getUser()->getAttribute('order_by', 'document') : 'created_at') . ' DESC');
    
    if ($category instanceof Category)
    {
    	$documents_query->innerJoin('d.Categories c WITH c.id = ?', $category->id);
    	$title = sfContext::getInstance()->getI18N()->__('Category') . ' ' . $category->title;
    }
    
    // TODO : rajouter les droits à terme
    
    $this->documents = $documents_query->execute();
  	$this->title = $title;
  	$this->category = $category;
  }
  
 /**
  * Executes add action
  *
  * @param sfRequest $request A request object
  */
  public function executeEdit(sfWebRequest $request)
  {
  	$category = Doctrine::getTable('Category')->findOneBy('slug', $request->getParameter('slug', ''));
  	
  	$form = new CategoryFrontendForm($category);
  	if ($request->isMethod('post') && $form->bindAndSave($request->getParameter($form->getName())))
  	{
  		$this->redirect('category/index?slug=' . $form->getObject()->slug);
  	}
  	$this->form = $form;
  }
}

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
  * Show a category or homepage
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
  	$category = $request->hasParameter('slug') ? Doctrine::getTable('Category')->findOneBy('slug', $request->getParameter('slug', '')) : null;
  	$title = ($category instanceof Category) ? sfContext::getInstance()->getI18N()->__('Category') . ' ' . $category->title : sfContext::getInstance()->getI18N()->__('Homepage');
  	
	  $pager = new sfDoctrinePager('Document');
    $pager->setQuery($this->getUser()->getDocumentsQuery($category));
    $pager->setPage($request->getParameter('page', 1));
    $pager->init();
    
    $this->pager = $pager;
  	$this->title = $title;
  	$this->category = $category;
  }
  
 /**
  * Edit a category
  * @param sfRequest $request A request object
  */
  public function executeEdit(sfWebRequest $request)
  {
  	$category = Doctrine::getTable('Category')->findOneBy('slug', $request->getParameter('slug', ''));
  	$this->forward404If($request->hasParameter('slug') && ! $category instanceof Category, "Wrong category slug");
  	
  	$form = new CategoryFrontendForm($category);
  	if ($request->isMethod('post'))
  	{
  	  if ($form->bindAndSave($request->getParameter($form->getName())))
      {
        $this->getUser()->setFlash('notice', 'Category successfully saved');
        $this->redirect('category/index?slug=' . $form->getObject()->slug);
      }
      else
      {
        $this->getUser()->setFlash('error', 'An error occurred during the saving of the category');
      }
    }
    
  	$this->form = $form;
  }
  
  /**
   * 
   * @param sfWebRequest $request
   */
  public function executeAddUser (sfWebRequest $request)
  {
    $category = Doctrine::getTable('Category')->find($request->getParameter('category[id]', ''));
    if (!$category instanceof Category)
    {
      throw new sfException("Wrong Category ID.");
    }
    
    $form = new UserCategoryAddForm($category);
    if ($form->bindAndSave($request->getParameter($form->getName())))
      $this->getUser()->setFlash('notice', 'User access successfully added in category');
    else
      $this->getUser()->setFlash('error', 'An error occurred during the saving of the category');
    
    $this->renderPartial('category_users', array('form' => $form));
    return sfView::NONE;
  }
  
  /**
   * 
   * @param sfWebRequest $request
   */
  public function executeRemoveUser (sfWebRequest $request)
  {
    $category = Doctrine::getTable('Category')->findOneBy('slug', $request->getParameter('slug', ''));
    if (!$category instanceof Category)
    {
      throw new sfException("Wrong Category slug.");
    }
    
    $category->unlink('Users', array($request->getParameter('user_id')), true);
    $this->getUser()->setFlash('notice', 'User access successfully removed from category');

    $this->renderPartial('category_users', array('form' => new UserCategoryAddForm($category)));
    return sfView::NONE;
  }
  
 /**
  * Subscribe to a category
  * @param sfRequest $request A request object
  */
  public function executeSubscribe (sfWebRequest $request)
  {
    $category = Doctrine::getTable('Category')->findOneBy('slug', $request->getParameter('slug', ''));
    if (!$category instanceof Category)
    {
      throw new sfException("Wrong Category slug.");
    }
    
    $category->subscribe($this->getUser()->getUser());
    $this->redirect('category/index?slug=' . $category->slug);
  }
  
 /**
  * Subscribe to a category
  * @param sfRequest $request A request object
  */
  public function executeUnsubscribe (sfWebRequest $request)
  {
    $category = Doctrine::getTable('Category')->findOneBy('slug', $request->getParameter('slug', ''));
    if (!$category instanceof Category)
    {
      throw new sfException("Wrong Category slug.");
    }
    
    $category->unsubscribe($this->getUser()->getUser());
    $this->redirect('category/index?slug=' . $category->slug);
  }
}

<?php

/**
 * user actions.
 *
 * @package    dockeet
 * @subpackage user
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class userActions extends sfActions
{
 /**
  * Executes index action
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $pager = new sfDoctrinePager('User', 10);
    $pager->setPage($request->getParameter('page', 1));
    $pager->init();
    
    $this->pager = $pager;
  }
  
  /**
   * Edit a user profile
   * @param sfWebRequest $request
   */
  public function executeEdit (sfWebRequest $request)
  {
    $user = Doctrine::getTable('User')->findOneBy('username', $request->getParameter('username', ''));
    
    // Only for admin and the user himself
    $this->redirectUnless($this->getUser()->hasCredential('admin') || ($user instanceof User && $user === $this->getUser()->getUser()), sfConfig::get('sf_secure_module') . '/' . sfConfig::get('sf_secure_action'));
    
    if ($this->getUser()->hasCredential('admin'))
      $form = new UserAdminForm($user);
    else
      $form = new UserForm($user);
    if ($request->isMethod('post'))
    {
      if ($form->bindAndSave($request->getParameter($form->getName())))
        $this->getUser()->setFlash('notice', 'User profile successfully saved');
      else
        $this->getUser()->setFlash('error', 'An error occurred during the saving of the user profile');
    }
    
    $this->user = $user;
    $this->form = $form;
  }
  
  /**
   * Delete a user
   * @param sfWebRequest $request
   */
  public function executeDelete (sfWebRequest $request)
  {
    $user = Doctrine::getTable('User')->findOneBy('username', $request->getParameter('username'));
    $this->forward404Unless($user instanceof User, 'Incorrect user ID.');
    
    $user->delete();
    $this->getUser()->setFlash('notice', 'User successfully deleted');
    
    $this->redirect('user/index');
  }
}

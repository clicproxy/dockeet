<?php

/**
 * navigation actions.
 *
 * @package    dockeet
 * @subpackage navigation
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class navigationActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->redirect('@homepage');
  }
  
  /**
   * Execute login action
   * @param sfWebRequest $request
   */
  public function executeLogin (sfWebRequest $request)
  {
    $form = new UserLoginForm();
    if ($request->isMethod('post'))
    {
      $form->bind($request->getParameter($form->getName()));
      if ($form->isValid())
      {
        $this->getUser()->login($form->getValue('user'));
        $this->redirect($request->getReferer());
      }
    }
    
    $this->getUser()->setFlash('login', $request->getParameter($form->getName() . '[login]'));
    $this->form = $form;
  }
  
  /**
   * Execute logout
   * @param sfWebRequest $request
   */
  public function executeLogout (sfWebRequest $request)
  {
    $this->getUser()->logout();
    $this->redirect('@homepage');
  }
  
  /**
   * Execute Error404 Page
   * @param sfWebRequest $request
   */
  public function executeError404 (sfWebRequest $request)
  {
  }
  
  /**
   * Execute Secure Page
   * @param sfWebRequest $request
   */
  public function executeSecure (sfWebRequest $request)
  {
  }
}

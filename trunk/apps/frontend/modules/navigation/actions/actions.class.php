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
    $this->redirectIf($this->getUser()->isAuthenticated(), '@homepage');
    
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
  
  /**
   * Execute Secure Page
   * @param sfWebRequest $request
   */
  public function executeSetDisplay (sfWebRequest $request)
  {
    if (!$request->hasParameter('display') && !in_array($request->getParameter('display'), array('thumbnail', 'mixed', 'detail')))
    {
      $this->getUser()->setFlash('error', 'An error occured, display change failed');
    }
    else
    {
      $this->getUser()->setAttribute('display', $request->getParameter('display'), 'frontend');
    }
    $this->redirect($request->getReferer());
  }
  
  /**
   * Set order to display document
   * @param sfWebRequest $request
   */
  public function executeSetOrder(sfWebRequest $request)
  {
    if (!$request->hasParameter('order_by') && !in_array($request->getParameter('order_by'), array('thumbnail', 'mixed', 'detail')))
    {
      $this->getUser()->setFlash('error', 'An error occured, display change failed');
    }
    else
    {
      $order_by = $this->getUser()->getAttribute('order_by', 'frontend');
      if (strpos($order_by, $request->getParameter('order_by')))
      {
        $order_by = $request->getParameter('order_by') . ' ' . (strpos($order_by, 'ASC') ? 'DESC' : 'ASC');
      }
      else
      {
        $order_by = $request->getParameter('order_by') . ' ASC';
      }
      $this->getUser()->setAttribute('order_by', $order_by, 'frontend');
    }
    $this->redirect($request->getReferer());
  }
}

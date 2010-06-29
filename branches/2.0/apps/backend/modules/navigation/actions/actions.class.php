<?php

/**
 * navigation actions.
 *
 * @package    dockeet
 * @subpackage navigation
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
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
    $this->forward('@homepage');
  }
  
  public function executeLogin(sfWebRequest $request)
  {
  	if ($this->getUser()->isAuthenticated()) $this->forward('@homepage');
  	
  	$this->form = new backendLoginForm();
    if ($request->isMethod('post'))
    {
      $this->form->bind($request->getParameter('backend_login'));
      if ($this->form->isValid())
      {
        $this->getUser()->login($this->form->getValue('login'));
        $this->redirect('@homepage');
      }
    }
  	
  }
}

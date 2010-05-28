<?php

/**
 * services actions.
 *
 * @package    dockeet
 * @subpackage services
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class servicesActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {

  }

 /**
  * Executes Api access action
  *
  * @param sfRequest $request A request object
  */
  public function executeApiAccess(sfWebRequest $request)
  {
    $pager = new sfDoctrinePager('ApiAccess');
    $pager->setPage($request->getParameter('page', 1));
    $pager->init();

    $this->pager = $pager;
  }

  /**
   *
   * @param sfWebRequest $request
   */
  public function executeEditApiAccess (sfWebRequest $request)
  {
    $api_access = Doctrine::getTable('ApiAccess')->findOneBy('api_key', $request->getParameter('api_key', ''));

    if (! $api_access instanceof ApiAccess)
    {
      $api_access = new ApiAccess();
      $api_access->api_key = substr(md5(rand(100000, 999999)), 0, 24);
      $api_access->api_secret = substr(md5(rand(100000, 999999)), 0, 8);
    }

    $form = new ApiAccessForm($api_access);
    if ($request->isMethod('post') && $form->bindAndSave($request->getParameter($form->getName())))
    {
      $this->getUser()->setFlash('notice', "Api accesss successfully saved");
    }

    $this->form = $form;
  }
}

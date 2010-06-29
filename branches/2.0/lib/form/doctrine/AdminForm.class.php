<?php

/**
 * Admin form.
 *
 * @package    dockeet
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AdminForm extends BaseAdminForm
{
  public function configure()
  {
  	$this->useFields(array('login', 'password'));
  	$this->setWidget('password', new sfWidgetFormInputPassword());
  }
}

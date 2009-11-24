<?php

/**
 * User form.
 *
 * @package    dockeet
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class UserForm extends BaseUserForm
{
  public function configure()
  {
    $this->useFields(array('username', 'password', 'email'));
    $this->widgetSchema['password'] = new sfWidgetFormInputPassword();
    
    $this->validatorSchema['email'] = new sfValidatorEmail();
  }
}

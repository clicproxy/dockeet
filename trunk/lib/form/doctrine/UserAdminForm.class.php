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
    $this->useFields(array('username', 'password', 'email', 'admin'));
    $this->widgetSchema['password'] = new sfWidgetFormInputPassword();
    $this->widgetSchema['password_confirm'] = new sfWidgetFormInputPassword();
    
    $this->validatorSchema['password'] = new sfValidatorString(array('max_length' => 255, 'required' => false));
    $this->validatorSchema['password_confirm'] = new sfValidatorString(array('max_length' => 255, 'required' => false));
    $this->validatorSchema['email'] = new sfValidatorEmail();
    
    $this->validatorSchema->setPostValidator(
      new sfValidatorSchemaCompare('password', sfValidatorSchemaCompare::EQUAL, 'password_confirm', array('throw_global_error' => true), array('invalid' => "Passwords do not match"))
    );
  }
}

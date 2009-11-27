<?php
class UserLoginForm extends BaseForm
{
  public function configure ()
  {
    $this->setWidgets(array(
      'login' => new sfWidgetFormInput(),
      'password' => new sfWidgetFormInputPassword()
    ));

    $this->setValidators(array(
      'login' => new sfValidatorDoctrineChoice(array('model' => 'User', 'column' => 'username', 'required' => true)),
      'password' => new sfValidatorString(array('required' => true))
    ));

    $this->validatorSchema->setPostValidator(new UserLoginPostValidator());
  }
  
}
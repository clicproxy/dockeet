<?php
class backendLoginForm extends sfForm 
{
  public function configure()
  {
    $this->setWidgets(array(
      'login' => new sfWidgetFormInput(),
      'password' => new sfWidgetFormInputPassword()
    ));

    $this->setValidators(array(
      'login' => new sfValidatorString(array('required' => TRUE)),
      'password' => new sfValidatorString(array('required' => TRUE))
    ));

    $this->validatorSchema->setPostValidator(new backendLoginValidator());

    $this->widgetSchema->setNameFormat('backend_login[%s]');
  }
	
}
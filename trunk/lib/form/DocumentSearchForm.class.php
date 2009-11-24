<?php
class DocumentSearchForm extends BaseForm 
{
  public function configure()
  {
  	$this->setWidgets(array(
  	  'q' => new sfWidgetFormInput()
  	));
  	
  	$this->setValidators(array(
  	  'q' => new sfValidatorString(array('min_length' => 3))
  	));
  	
  	$this->disableCSRFProtection();
  	$this->widgetSchema->setNameFormat('%s');
  }
}
<?php

/**
 * Document form.
 *
 * @package    dockeet
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class DocumentFrontendForm extends DocumentForm
{
  public function configure()
  {
  	$this->useFields(array('title', 'description', 'public', 'file'));
    
    $this->widgetSchema['file'] = new sfWidgetFormInputFile();
    $this->validatorSchema['file'] = new sfValidatorFile(array('required' => false));
  }
}

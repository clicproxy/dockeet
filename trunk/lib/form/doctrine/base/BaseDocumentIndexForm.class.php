<?php

/**
 * DocumentIndex form base class.
 *
 * @method DocumentIndex getObject() Returns the current form's model object
 *
 * @package    dockeet
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BaseDocumentIndexForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'       => new sfWidgetFormInputHidden(),
      'keyword'  => new sfWidgetFormInputHidden(),
      'field'    => new sfWidgetFormInputHidden(),
      'position' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'id'       => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'keyword'  => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'keyword', 'required' => false)),
      'field'    => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'field', 'required' => false)),
      'position' => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'position', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('document_index[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DocumentIndex';
  }

}

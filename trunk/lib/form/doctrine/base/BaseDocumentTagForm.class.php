<?php

/**
 * DocumentTag form base class.
 *
 * @method DocumentTag getObject() Returns the current form's model object
 *
 * @package    dockeet
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24051 2009-11-16 21:08:08Z Kris.Wallsmith $
 */
abstract class BaseDocumentTagForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'document_id' => new sfWidgetFormInputHidden(),
      'tag_id'      => new sfWidgetFormInputHidden(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'document_id' => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'document_id', 'required' => false)),
      'tag_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'tag_id', 'required' => false)),
      'created_at'  => new sfValidatorDateTime(),
      'updated_at'  => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('document_tag[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DocumentTag';
  }

}

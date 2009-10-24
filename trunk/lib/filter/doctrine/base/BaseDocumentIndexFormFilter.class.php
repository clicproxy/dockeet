<?php

/**
 * DocumentIndex filter form base class.
 *
 * @package    dockeet
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BaseDocumentIndexFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
    ));

    $this->setValidators(array(
    ));

    $this->widgetSchema->setNameFormat('document_index_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DocumentIndex';
  }

  public function getFields()
  {
    return array(
      'id'       => 'Number',
      'keyword'  => 'Text',
      'field'    => 'Text',
      'position' => 'Number',
    );
  }
}

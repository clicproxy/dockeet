<?php

/**
 * User filter form base class.
 *
 * @package    dockeet
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseUserFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'username'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'password'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'salt'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'email'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'admin'           => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'culture'         => new sfWidgetFormFilterInput(),
      'created_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'slug'            => new sfWidgetFormFilterInput(),
      'categories_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Category')),
      'documents_list'  => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Document')),
    ));

    $this->setValidators(array(
      'username'        => new sfValidatorPass(array('required' => false)),
      'password'        => new sfValidatorPass(array('required' => false)),
      'salt'            => new sfValidatorPass(array('required' => false)),
      'email'           => new sfValidatorPass(array('required' => false)),
      'admin'           => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'culture'         => new sfValidatorPass(array('required' => false)),
      'created_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'slug'            => new sfValidatorPass(array('required' => false)),
      'categories_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Category', 'required' => false)),
      'documents_list'  => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Document', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('user_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addCategoriesListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query
      ->leftJoin($query->getRootAlias().'.UserCategory UserCategory')
      ->andWhereIn('UserCategory.category_id', $values)
    ;
  }

  public function addDocumentsListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query
      ->leftJoin($query->getRootAlias().'.UserDocument UserDocument')
      ->andWhereIn('UserDocument.document_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'User';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'username'        => 'Text',
      'password'        => 'Text',
      'salt'            => 'Text',
      'email'           => 'Text',
      'admin'           => 'Boolean',
      'culture'         => 'Text',
      'created_at'      => 'Date',
      'updated_at'      => 'Date',
      'slug'            => 'Text',
      'categories_list' => 'ManyKey',
      'documents_list'  => 'ManyKey',
    );
  }
}

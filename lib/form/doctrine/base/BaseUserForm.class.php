<?php

/**
 * User form base class.
 *
 * @method User getObject() Returns the current form's model object
 *
 * @package    dockeet
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24051 2009-11-16 21:08:08Z Kris.Wallsmith $
 */
abstract class BaseUserForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'username'        => new sfWidgetFormInputText(),
      'password'        => new sfWidgetFormInputText(),
      'salt'            => new sfWidgetFormInputText(),
      'email'           => new sfWidgetFormInputText(),
      'created_at'      => new sfWidgetFormDateTime(),
      'updated_at'      => new sfWidgetFormDateTime(),
      'slug'            => new sfWidgetFormInputText(),
      'categories_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Category')),
      'documents_list'  => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Document')),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'username'        => new sfValidatorString(array('max_length' => 255)),
      'password'        => new sfValidatorString(array('max_length' => 255)),
      'salt'            => new sfValidatorString(array('max_length' => 255)),
      'email'           => new sfValidatorString(array('max_length' => 255)),
      'created_at'      => new sfValidatorDateTime(),
      'updated_at'      => new sfValidatorDateTime(),
      'slug'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'categories_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Category', 'required' => false)),
      'documents_list'  => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Document', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'User', 'column' => array('slug')))
    );

    $this->widgetSchema->setNameFormat('user[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'User';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['categories_list']))
    {
      $this->setDefault('categories_list', $this->object->Categories->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['documents_list']))
    {
      $this->setDefault('documents_list', $this->object->Documents->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveCategoriesList($con);
    $this->saveDocumentsList($con);

    parent::doSave($con);
  }

  public function saveCategoriesList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['categories_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Categories->getPrimaryKeys();
    $values = $this->getValue('categories_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Categories', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Categories', array_values($link));
    }
  }

  public function saveDocumentsList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['documents_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Documents->getPrimaryKeys();
    $values = $this->getValue('documents_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Documents', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Documents', array_values($link));
    }
  }

}

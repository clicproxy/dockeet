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

  /**
   * Updates and saves the current object.
   *
   * If you want to add some logic before saving or save other associated
   * objects, this is the method to override.
   *
   * @param mixed $con An optional connection object
   */
  protected function doSave($con = null)
  {
    $file = $this->getValue('file');
    if (null !== $file)
    {
      $filename =  sha1(date('U') . $file->getOriginalName()) . $file->getExtension($file->getOriginalExtension());

      $this->values['file'] = $filename;

      if ($this->getObject()->isNew() || in_array($this->values['title'], array(null, ''), true))
      {
        $this->values['title'] = sfInflector::humanize($file->getOriginalName());
      }
      $this->getObject()->mime_type = $file->getType();
    }
    parent::doSave($con);
    
    if (null !== $file)
    {
      $path = dirname($this->getObject()->getFilePath());
      if (! is_dir($path))
      {
        mkdir($path, 0777, true);
      }
      
      if (! is_writable($path))
      {
        throw new sfException("Write directory access denied");
      }
      
      $file->save($path . '/' . $filename);
    }
  }
}

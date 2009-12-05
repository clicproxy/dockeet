<?php

/**
 * Document form.
 *
 * @package    dockeet
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class DocumentForm extends BaseDocumentForm
{
  public function configure()
  {
    $this->useFields(array('title', 'description', 'file', 'public'));
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
      $this->getObject()->size = $file->getSize(); 
      
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
      
      if (in_array($file->getType(), array('image/jpeg', 'image/png', 'image/gif')))
      {
        if (!is_dir($this->getObject()->getThumbnailDirectory()))
        {
          mkdir($this->getObject()->getThumbnailDirectory(), 0777, true);
        }
        
        if (! is_writable($path))
        {
          throw new sfException("Write directory access denied");
        }
        
        $thumbnail = new sfThumbnail(125, 125);
        $thumbnail->loadFile($path . '/' . $filename);
        $thumbnail->save($this->getObject()->getThumbnailDirectory() . '125x125_' . $filename);
      }
    }
  }
}

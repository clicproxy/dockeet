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

      if ($this->getObject()->isNew() || !array_key_exists('title', $this->values) || in_array($this->values['title'], array(null, ''), true))
      {
        $title = substr($file->getOriginalName(), 0, strrpos($file->getOriginalName(), '.'));
        $this->values['title'] = $title;
        if (0 !== Doctrine::getTable('Document')->createQuery('d')->where('d.title = ?', $this->values['title'])->count())
        {
          $document = Doctrine::getTable('Document')->createQuery('d')->where('d.title = ?', $this->values['title'])->fetchOne();
          $this->values['id'] = $document->id;
        }
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

      if (in_array($file->getType(), array('image/jpeg', 'image/png', 'image/gif', 'application/pdf')))
      {
        if (!is_dir($this->getObject()->getThumbnailDirectory()))
        {
          mkdir($this->getObject()->getThumbnailDirectory(), 0777, true);
        }

        if (! is_writable($path))
        {
          throw new sfException("Write directory access denied");
        }

        $adapterOptions = array();
        if (in_array($file->getType(), array('application/pdf')))
        {
          $adapterOptions['extract'] = 1;
        }
        //$maxWidth = null, $maxHeight = null, $scale = true, $inflate = true, $quality = 75, $adapterClass = null, $adapterOptions = array()
        $thumbnail = new sfThumbnail(125, 125, true, true, 75, 'sfImageMagickAdapter', $adapterOptions);

        $thumbnail->loadFile($path . '/' . $filename);
        $thumbnail->save(sfConfig::get('sf_web_dir') . $this->getObject()->getThumbnailUrl(125, 125, true), 'image/png');
      }
    }
  }
}

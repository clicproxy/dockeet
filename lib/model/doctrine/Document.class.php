<?php

/**
 * Document
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 *
 * @package    dockeet
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6508 2009-10-14 06:28:49Z jwage $
 */
class Document extends BaseDocument
{
	/**
	 * Path where files are saved
   * @param integer $version_id
	 * @return string
	 */
	public function getFilePath($version_id = null)
	{
	  $file_path = sfConfig::get('sf_upload_dir') . '/documents/' . substr(str_pad($this->id, 2, '0', STR_PAD_LEFT), -2) . '/';
	  if (null === $version_id)
	  {
	    $file_path .= $this->file;
	  }
	  else
	  {
	    $version = Doctrine::getTable('DocumentVersion')->find($version_id);
	    $file_path .= $version->file;
	  }
    return $file_path;
	}
	
	/**
	 * Get the mime type of the file
   * @param integer $version_id
	 * @return string
	 * @todo plan tu use finfo for next PHP versions
	 */
	public function getMimeType($version_id = null)
	{
	  return mime_content_type($this->getFilePath($version_id));
	}
	
	/**
	 * Delete document and files
	 * @param unknown_type $event
	 */
  public function postDelete($event)
  {
    if (file_exists($this->getFilePath()))
    {
      unlink($this->getFilePath());
    }
  }
  
  /**
   * Save old file
   * @param unknown_type $event
   */
  public function preSave($event)
  {
    if (in_array('file', $this->_modified, true))
    {
      $this->Versions[]->file = $this->file;  
    }
  }
	
}

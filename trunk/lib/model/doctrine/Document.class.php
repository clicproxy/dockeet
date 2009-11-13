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
	 * @return string
	 */
	public function getFilePath()
	{
    return sfConfig::get('sf_upload_dir') . '/documents/' . substr(str_pad($this->id, 2, '0', STR_PAD_LEFT), -2) . '/' . $this->file;
	}
	
	/**
	 * Retourne le type mime du fichier
	 * @return string
	 */
	public function getMimeType()
	{
		$finfo = new finfo();
		
		if (!$finfo)
		{
			throw new sfException("Opening fileinfo database failed");
		}
		
		return $finfo->file($this->getFilePath());
	}
}

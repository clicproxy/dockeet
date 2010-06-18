<?php

/**
 * Library form.
 *
 * @package    dockeet
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class LibraryForm extends BaseLibraryForm
{
  public function configure()
  {
  	$this->useFields(array('name', 'host', 'prefix'));
  }
}

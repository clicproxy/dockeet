<?php

/**
 * Category form.
 *
 * @package    dockeet
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class CategoryFrontendForm extends CategoryForm
{
  public function configure()
  {
  	$this->useFields(array('title', 'description'));
  }
}

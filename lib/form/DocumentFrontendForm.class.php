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
  	$this->useFields(array('title', 'description', 'public'));
  }
}

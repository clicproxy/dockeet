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
}

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
    unset($this->widgetSchema['slug'], $this->validatorSchema['slug']);
    unset($this->widgetSchema['version'], $this->validatorSchema['version']);
  }
}

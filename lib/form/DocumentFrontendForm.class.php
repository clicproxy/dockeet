
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
    unset($this->widgetSchema['file'], $this->validatorSchema['file']);
    parent::configure();
  }
}

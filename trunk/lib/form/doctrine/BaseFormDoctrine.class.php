<?php

/**
 * Project form base class.
 *
 * @package    dockeet
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
abstract class BaseFormDoctrine extends sfFormDoctrine
{
  public function setup()
  {
  	unset($this->widgetSchema['created_at'], $this->validatorSchema['created_at']);
  	unset($this->widgetSchema['updated_at'], $this->validatorSchema['updated_at']);
  }
}

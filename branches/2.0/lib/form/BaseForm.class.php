<?php

/**
 * Base project form.
 * 
 * @package    dockeet
 * @subpackage form
 * @author     Your name here 
 * @version    SVN: $Id: BaseForm.class.php 20147 2009-07-13 11:46:57Z FabianLange $
 */
class BaseForm extends sfFormSymfony
{
  /**
   * Sets the widgets associated with this form.
   *
   * @param array $widgets An array of named widgets
   *
   * @return sfForm The current form instance
   */
  public function setWidgets(array $widgets)
  {
    parent::setWidgets($widgets);

    if (in_array($this->getName(), array('', null, '[%s]', false), true))
    {
      $this->widgetSchema->setNameFormat(sfInflector::underscore(get_class($this)) . '[%s]');
    }

    return $this;
  }
}
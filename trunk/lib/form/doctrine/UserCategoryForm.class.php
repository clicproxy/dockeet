<?php

/**
 * UserCategory form.
 *
 * @package    dockeet
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class UserCategoryForm extends BaseUserCategoryForm
{
  public function configure()
  {
    $this->useFields(array('user_id', 'category_id'));
    $this->widgetSchema['category_id'] = new sfWidgetFormInputHidden();
  }
}

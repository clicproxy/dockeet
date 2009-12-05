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
    
    if ($this->getObject()->Category instanceof Category && !$this->getObject()->Category->isNew())
    {
      $this->widgetSchema['user_id']->setOption('query', Doctrine::getTable('User')->createQuery('u')->where('u.id NOT IN (SELECT uc.user_id FROM UserCategory uc WHERE uc.category_id = ?)', $this->getObject()->Category->id));
    }
  }
}

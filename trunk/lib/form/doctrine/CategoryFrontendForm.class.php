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
    unset($this->widgetSchema['slug'], $this->validatorSchema['slug']);
    unset($this->widgetSchema['users_list'], $this->validatorSchema['users_list']);
    unset($this->widgetSchema['documents_list'], $this->validatorSchema['documents_list']);
  }
}

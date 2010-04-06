<?php

/**
 * DocumentCategory form.
 *
 * @package    dockeet
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class DocumentCategoryForm extends BaseDocumentCategoryForm
{
  public function configure()
  {
    $this->useFields(array('category_id'));
    $this->setWidget('category_id', new sfWidgetFormInputHidden());
  }
}

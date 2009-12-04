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
    $this->useFields(array('document_id'));
    
    if ($this->getObject()->Document instanceof Document)
    {
      $query = Doctrine::getTable('Category')->createQuery('c')->where('c.id NOT IN (SELECT d.category_id FROM DocumentCategory d WHERE d.document_id = ?)', $this->getObject()->Document->id);
      $this->widgetSchema['category_id'] = new sfWidgetFormDoctrineChoice(array('model' => 'Category', 'query' => $query));
      $this->validatorSchema['category_id'] = new sfValidatorDoctrineChoice(array('model' => 'Category', 'query' => $query));
    }
  }
}

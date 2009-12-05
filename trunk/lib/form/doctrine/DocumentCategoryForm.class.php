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
    
    if ($this->getObject()->Document instanceof Document && !$this->getObject()->Document->isNew())
    {
      $this->widgetSchema['category_id']->setOption('query', Doctrine::getTable('Category')->createQuery('c')->where('c.id NOT IN (SELECT d.category_id FROM DocumentCategory d WHERE d.document_id = ?)', $this->getObject()->Document->id));
    }
  }
}

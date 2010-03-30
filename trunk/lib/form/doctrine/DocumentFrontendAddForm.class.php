<?php

/**
 * Document form.
 *
 * @package    dockeet
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class DocumentFrontendAddForm extends DocumentForm
{
  public function configure()
  {
  	$this->useFields(array('file'));

  	$this->widgetSchema['file'] = new sfWidgetFormInputFile();
  	$this->validatorSchema['file'] = new sfValidatorFile();

    $this->embedForm('document_category', $this->getDocumentCategoryForm());
    $this->widgetSchema->setNameFormat('%s');
  }

  /**
   * Return a DocumentCategoryForm with a new DocumentCategory linked with the document
   * @return DocumentCategoryForm
   */
  protected function getDocumentCategoryForm ()
  {
  	$document_category = null;
    if (1 == Doctrine::getTable('DocumentCategory')->createQuery('d')->where('document_id = ?', $this->getObject()->id)->count())
    {
      $document_category = Doctrine::getTable('DocumentCategory')->createQuery('d')->where('document_id = ?', $this->getObject()->id)->fetchOne();
    }
      
    if (!$document_category instanceof DocumentCategory)
    {
      $document_category = new DocumentCategory();
      $document_category->Document = $this->getObject();
    }
    return new DocumentCategoryForm($document_category);
  }
}

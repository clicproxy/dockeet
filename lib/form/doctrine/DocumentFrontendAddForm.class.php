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
    if ($this->getObject()->isNew())
    {
      $document_category = new DocumentCategory();
      $document_category->Document = $this->getObject();
    }
    else
    {
    }
    return new DocumentCategoryForm($document_category);
  }
}

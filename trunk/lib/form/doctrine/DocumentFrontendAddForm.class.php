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
  	
  	//$this->widgetSchema['categories_list'] = new sfWidgetFormDoctrineChoice(array('model' => 'Category'));
  	//$this->validatorSchema['categories_list'] = new sfValidatorDoctrineChoice(array('model' => 'Category', 'required' => true));
    $this->embedForm('document_category', $this->getDocumentCategoryForm());
  }
  
  /**
   * Return a DocumentCategoryForm with a new DocumentCategory linked with the document
   * @return DocumentCategoryForm
   */
  protected function getDocumentCategoryForm ()
  {
    $document_category = new DocumentCategory();
    $document_category->Document = $this->getObject();
    return new DocumentCategoryForm($document_category);
  }
}

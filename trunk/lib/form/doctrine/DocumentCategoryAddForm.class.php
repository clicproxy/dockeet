<?php
class DocumentCategoryAddForm extends DocumentForm 
{
  public function configure()
  {
    $this->useFields();
    
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
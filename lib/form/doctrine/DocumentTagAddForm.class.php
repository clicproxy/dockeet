<?php
class DocumentTagAddForm extends DocumentForm 
{
  public function configure()
  {
    $this->useFields();
    
    $this->embedForm('document_tag', $this->getDocumentTagForm());
  }
  
  /**
   * Return a DocumentTagForm with a new DocumentTag linked with the document
   * @return DocumentTagForm
   */
  protected function getDocumentTagForm ()
  {
    $document_tag = new DocumentTag();
    $document_tag->Document = $this->getObject();
    return new DocumentTagForm($document_tag);
  } 
} 
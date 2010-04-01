<?php
class UserCategoryAddForm extends CategoryForm
{
  public function configure()
  {
    $this->useFields();

    $this->embedForm('user_category', $this->getUserCategoryForm());
  }

  /**
   * Return a UserCategoryForm with a new UserCategory linked with the category
   * @return DocumentCategoryForm
   */
  protected function getUserCategoryForm ()
  {
    $user_category = new UserCategory();
    $user_category->category_id = $this->getObject()->id;
    return new UserCategoryForm($user_category);
  }

}
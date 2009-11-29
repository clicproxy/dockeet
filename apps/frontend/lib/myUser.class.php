<?php

class myUser extends sfBasicSecurityUser
{
  /**
   * Login
   * @param User $user
   */
  public function login (User $user)
  {
    $this->setAttribute('username', $user->username, 'frontend');
    if ($user->admin)
    {
      $this->addCredential('admin');
    }
    $this->setAuthenticated(true);
    return true;
  }
  
  /**
   * Logout
   */
  public function logout ()
  {
    $this->getAttributeHolder()->removeNamespace('frontend');
    $this->removeCredential('admin');
    $this->setAuthenticated(false);
    return true;
  }
  
  /**
   * Get the User Object
   * @return User
   */
  public function getUser()
  {
    return $this->isAuthenticated() ? Doctrine::getTable('User')->findOneBy('username', $this->getAttribute('username', '', 'frontend')) : null;
  }
  
  /**
   * Return viewable document of the user
   * @param $category
   * @return Doctrine_Query
   */
  public function getDocumentsQuery (Category $category = null)
  {
    $user = $this->getUser();
    $documents_query = Doctrine::getTable('Document')->createQuery('d');
    $documents_query->addOrderBy((($this->hasAttribute('order_by', 'document')) ? $this->getAttribute('order_by', 'document') : 'created_at') . ' DESC');
    
    if ($category instanceof Category)
    {
      $documents_query->innerJoin('d.Categories c WITH c.id = ?', $category->id);
      $title = sfContext::getInstance()->getI18N()->__('Category') . ' ' . $category->title;
      if (!$user instanceof User || !$user->admin)
      {
        $documents_query->where('d.public = ?', 1);
      }
      if ($user instanceof User && !$user->admin)
      {
        $documents_query->leftJoin('c.Users u');
        $documents_query->orWhere('u.id = ?', $user->id);
      }
    }
    else
    {
      if (!$user instanceof User || !$user->admin)
      {
        $documents_query->where('d.public = ?', 1);
      }
      if ($user instanceof User && !$user->admin)
      {
        $documents_query->leftJoin('d.Categories c');
        $documents_query->leftJoin('c.Users u');
        $documents_query->orWhere('u.id = ?', $user->id);
      }
    }
    
    return $documents_query;
  }
  
  public function getCategories ()
  {
    $user = $this->getUser();
    $categories_query = Doctrine::getTable('Category')->createQuery('c');
    $categories_query->leftJoin('c.Documents d');
    $categories_query->select('c.slug, count(d.id) AS count_documents');
    $categories_query->addGroupBy('c.id');
    
    if (!$user instanceof User || !$user->admin)
    {
      $categories_query->where('d.public = ?', 1);
    }
    if ($user instanceof User && !$user->admin)
    {
      $categories_query->leftJoin('c.Users u');
      $categories_query->orWhere('u.id = ?', $user->id);
    }
    
    return $categories_query->execute();
  }
}

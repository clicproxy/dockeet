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
    $this->user_connected = Doctrine::getTable('User')->findOneBy('username', $this->getAttribute('username', '', 'frontend'));
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
    $this->user_connected = null;
    return true;
  }

  /**
   *
   * @var unknown_type
   */
  protected $user_connected = null;

  /**
   * Get the User Object
   * @return User
   */
  public function getUser()
  {
  	if (null === $this->user_connected)
  	{
  		$this->user_connected = $this->isAuthenticated() ? Doctrine::getTable('User')->findOneBy('username', $this->getAttribute('username', '', 'frontend')) : null;
  	}
    return $this->user_connected;
  }

  /**
   * Return viewable document of the user
   * @param $query
   * @return Doctrine_Query
   */
  public function getDocumentsQuery ($query = array())
  {
    $user = $this->getUser();
    $documents_query = Doctrine::getTable('Document')->createQuery('d');

    if (isset($query['order_by']))
    {
      $documents_query->addOrderBy($query['order_by']);
    }
    else
    {
      $documents_query->addOrderBy($this->getAttribute('order_by', 'updated_at DESC', 'frontend'));
    }

    if (isset($query['public']) && $query['public'])
    {
      $documents_query->andWhere('d.public = 1');
    }

    if ($query['category'] instanceof Category)
    {
      $documents_query->innerJoin('d.Categories c WITH c.id = ?', $query['category']->id);
    }

    if (! $user instanceof User || !$user->admin) $documents_query->where('d.public = ?', 1);

    if ($user instanceof User && !$user->admin)
    {
      if ($query['category'] instanceof Category)
      {
        $documents_query->leftJoin('c.Users u');
        $documents_query->orWhere('u.id = ?', $user->id);
      }
      else
      {
        $documents_query->leftJoin('d.Categories c');
        $documents_query->orWhereIn('c.id', $user->Categories->getPrimaryKeys());
      }
    }

    if (isset($query['mime_types']) && !empty($query['mime_types']))
    {
      $documents_query->andWhereIn('d.mime_type', $query['mime_types']);
    }

    return $documents_query;
  }

  /**
   *
   * @param unknown_type $root_only
   */
  public function getCategories ($root_only = false, $parent = null)
  {
    $user = $this->getUser();
    $categories_query = Doctrine::getTable('Category')->createQuery('c')
      ->leftJoin('c.Documents d')
      ->select('c.*, count(d.id) AS count_documents')
      ->addGroupBy('c.id');

    if (! $user instanceof User || !$user->admin) $categories_query->where('d.public = ?', 1);
    if ($user instanceof User && !$user->admin) $categories_query->orWhereIn('c.id', $user->Categories->getPrimaryKeys());
    if ($root_only) $categories_query->addWhere("title NOT LIKE ?", '%|%');
    if (null !== $parent && !$root_only) $categories_query->addWhere("title LIKE ?", $parent . '|%');
    return $categories_query->execute();
  }

  /**
   * Test if the User logged has suscribed to the category
   * @param Category $category
   * @return boolean
   */
  public function hasSubscribed ($object)
  {
    if ($object instanceof sfOutputEscaperIteratorDecorator)
    {
      $object = $object->getRawValue();
    }

    $has_subscribed = false;
    if (!$object instanceof Document && !$object instanceof Category)
    {
      throw new sfException("Wrong parameter, Category or Document object expected, " . get_class($object) . " given");
    }

    if ($this->getUser() instanceof User)
    {
      $has_subscribed = $object->hasSubscribed($this->getUser());
    }

    sfConfig::set('sf_web_debug', false);
    return $has_subscribed;
  }
}

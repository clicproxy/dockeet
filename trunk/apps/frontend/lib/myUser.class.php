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
      if(isset($query['deep']) && $query['deep'])
      {
        $documents_query->innerJoin('d.Categories c WITH (c.id = ? OR c.title LIKE ?)', array($query['category']->id, $query['category']->title.'|%'));
      }
      else
      {
        $documents_query->innerJoin('d.Categories c WITH c.id = ?', $query['category']->id);
      }
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
    	foreach ($query['mime_types'] as $index => $mime_type)
    	{
    		if(0 === $index) $documents_query->andWhere('d.mime_type LIKE ?', $mime_type);
    		else $documents_query->orWhere('d.mime_type LIKE ?', $mime_type);
    	}
    }

    if (isset($query['last']) && !empty($query['last']))
    {
    	$documents_query->andWhere('d.updated_at > DATE_SUB(CURDATE(),INTERVAL ? DAY)', $query['last']);
    }

    if (isset($query['updated_after']) && !empty($query['updated_after']))
    {
    	$documents_query->andWhere('d.updated_at > ?', $query['updated_after']);
    }

    if (isset($query['tags']) && !empty($query['tags']))
    {
    	if (0 < explode(',', $query['tags'])) $documents_query->leftJoin('d.Tags t');
    	if (1 === explode(',', $query['tags']))
    	{
    		$documents_query->andWhere('t.title LIKE ?', $query['tags'][0]);
    	}
    	else 
    	{
    		$documents_query->andWhereIn('t.title', $query['tags']);
    	}
    }

    if (isset($query['search']) && !empty($query['search']))
    {
      $documents_query = Doctrine_Core::getTable('Document')->search($query['search'], $documents_query);
    }
    
    return $documents_query;
  }

  /**
   * 
   * @param bool $root_only
   * @param string $parent
   */
  public function getCategories ($root_only = false, $parent = null)
  {
    $user = $this->getUser();
    $categories_query = Doctrine::getTable('Category')->createQuery('c')
      ->leftJoin('c.Documents d')
      ->select('c.*, count(d.id) AS count_documents')
      ->addGroupBy('c.id')
      ->orderBy('c.title');

    if (! $user instanceof User || !$user->admin) $categories_query->where('d.public = ?', 1);
    if ($user instanceof User && !$user->admin) $categories_query->orWhereIn('c.id', $user->Categories->getPrimaryKeys());
    if ($root_only) $categories_query->addWhere("c.title NOT LIKE ?", '%|%');
    if (null !== $parent && !$root_only) $categories_query->addWhere("c.title LIKE ?", $parent . '|%');
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
    return $has_subscribed;
  }
}

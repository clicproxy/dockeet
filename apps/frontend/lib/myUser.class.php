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
    return Doctrine::getTable('User')->findOneBy('username', $this->getAttribute('username', '', 'frontend'));
  }
}

<?php

class myUser extends sfBasicSecurityUser
{
  /**
   * Login the user
   * @return boolean
   */
	public function login ($login)
	{
    $this->setAttribute('login', $login, 'backend');
    $this->setAuthenticated(true);
    return true;
	}
	
	/**
	 * Logout the user
	 * @return boolean
	 */
	public function logout ()
	{
    $this->setAttribute('login', '', 'backend');
    $this->setAuthenticated(false);
    return true;
	}
}

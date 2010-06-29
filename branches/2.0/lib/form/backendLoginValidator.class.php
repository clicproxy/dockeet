<?php

class backendLoginValidator extends sfValidatorBase
{
  protected $options = array('throw_global_error' => true);
  
  /**
   * Check password
   * @param array $values
   * @return array
   */
  protected function doClean($values)
  {
    $login = isset($values['login']) ? $values['login'] : '';
    $password = isset($values['password']) ? $values['password'] : '';
    
    $admin = Doctrine::getTable('Admin')->findOneBy('login', $login);
    
    if ($admin instanceof Admin)
    {
      if ($admin->login($password))
      {
        return $values;
      }
    }

    if ($this->getOption('throw_global_error'))
    {
      throw new sfValidatorError($this, "User unknown or wrong password");
    }

    throw new sfValidatorErrorSchema($this, array('password' => new sfValidatorError($this, "User unknown or wrong password")));
  }
  
}
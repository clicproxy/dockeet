<?php

class UserLoginPostValidator extends sfValidatorBase
{
  protected $options = array('throw_global_error' => true);
  /**
   * Valide la correspondance du mot de passe
   *
   * @param array $values
   * @return array
   */
  protected function doClean($values)
  {
    $login = isset($values['login']) ? $values['login'] : '';
    $password = isset($values['password']) ? $values['password'] : '';
    
    $user = Doctrine::getTable('User')->findOneBy('username', $login);

    if ($user instanceof User)
    {
      if ($user->login($password))
      {
        return array_merge($values, array('user' => $user));
      }
    }

    if ($this->getOption('throw_global_error'))
    {
      throw new sfValidatorError($this, "Username or/and password incorrect");
    }

    throw new sfValidatorErrorSchema($this, array('password' => new sfValidatorError($this, "Username or/and password incorrect")));
  }

}

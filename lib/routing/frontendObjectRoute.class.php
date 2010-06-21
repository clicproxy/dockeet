<?php
class frontendObjectRoute extends sfDoctrineRoute
{
  /**
   * Add the 
   * @param string $url
   * @param array $context
   */
  public function matchesUrl($url, $context = array())
  {
    if (false === $parameters = parent::matchesUrl($url, $context))
    {
      return false;
    }
    
    $base = Doctrine::getTable('Library')->findOneBy('host', $context['host']);
    if (!$base instanceof Base)
    {
      return false;
    }
    
    $manager = Doctrine_Manager::getInstance();
    $manager->setAttribute(Doctrine_Core::ATTR_TBLNAME_FORMAT, $base->prefix . '_%s');
 
    return $parameters;
  }
  
  
}
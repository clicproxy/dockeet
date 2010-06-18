<?php
class documentObjectRoute extends frontendObjectRoute
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
    
    $base = Doctrine::getTable('Base')->findOneBy('host', $context['host']);
    if (!$base instanceof Base)
    {
    	return false;
    }
    
    $manager = Doctrine_Manager::getInstance();
    $manager->setAttribute(Doctrine_Core::ATTR_TBLNAME_FORMAT, $base->prefix . '_%s');
 
    return array_merge(array('base_id' => $base->id), $parameters);
  }
	
	
}
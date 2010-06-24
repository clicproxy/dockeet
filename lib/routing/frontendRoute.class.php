<?php
class frontendRoute extends sfRoute
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
    $library = Doctrine::getTable('Library')->findOneBy('host', $context['host']);
    if (!$library instanceof Library)
    {
      return false;
    }
    
    $manager = Doctrine_Manager::getInstance();
    $manager->setAttribute(Doctrine_Core::ATTR_TBLNAME_FORMAT, $library->prefix . '_%s');
    sfContext::getInstance()->set('library', $library);
 
    return $parameters;
  }
	 
} 
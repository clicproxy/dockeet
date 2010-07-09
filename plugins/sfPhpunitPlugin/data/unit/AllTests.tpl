<?php

require_once 'PHPUnit/Framework.php';
require_once dirname(__FILE__).'/../../config/ProjectConfiguration.class.php';

new ProjectConfiguration();

class AllTests
{
  public static function suite()
  {        
    return sfPhpunitProjectTestLoader::factory()->getSuite();
  }
}
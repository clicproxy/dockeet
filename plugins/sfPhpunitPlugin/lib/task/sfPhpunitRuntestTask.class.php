<?php

require_once 'PHPUnit/Framework.php';
require_once 'PHPUnit/TextUI/TestRunner.php';
require_once 'PHPUnit/TextUI/Command.php';

/**
 * Symfony task that provide more flexable way to run tests.
 *
 * @package    sfPhpunitPlugin
 * @subpackage task

 * @author     Maksim Kotlyar <mkotlar@ukr.net>
 */
class sfPhpunitRuntestTask extends sfBaseTask
{
  protected function configure()
  {
    $this->addArguments(array(
      new sfCommandArgument('path', sfCommandArgument::OPTIONAL, 'Name of test to run', '')));
    
    $this->addOptions(array(
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_OPTIONAL, 'The envirement name', 'test'),
      new sfCommandOption('and-plugins', null, sfCommandOption::PARAMETER_NONE, 'The envirement name')));      
    
    
    $this->namespace        = 'phpunit';
    $this->name             = 'runtest';
    $this->briefDescription = 'Runs PHPUnit tests';
    $this->detailedDescription = <<<EOF
The [phpunit:runtest|INFO] Allow you to run simple test or test from the directory or ofcourse all tests.

  [php symfony phpunit:runtest foo|INFO] - run all test in the phpunit directory and all subdirectories.
  
  [php symfony phpunit:runtest unit |INFO] - run all test in the /phpunit/unit directory.
  
  [php symfony phpunit:runtest unit/* |INFO] - run all test in the /phpunit/unit directory and all subdirectories.
  
  [php symfony phpunit:runtest unit/models/UserTest.php |INFO] - run a single UserTest.php test case.

EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {    
//    $initTask = new sfPhpunitInitTask($this->dispatcher, $this->formatter);
//    $initTask->run();

    chdir(sfConfig::get('sf_root_dir'));
    $this->log(system(ProjectConfiguration::guessRootDir().'/symfony phpunit:init'));
    
    $suite = new sfBasePhpunitTestSuite();
  	
  	$suite->addTestSuite(
  	 sfPhpunitProjectTestLoader::factory($arguments['path'])->suite());
  	
  	if ($options['and-plugins']) {
  	  $pluginsRootPath = $this->configuration->getPluginPaths();
  	  $suite->addTestSuite(
        sfPhpunitPluginTestLoader::factory($pluginsRootPath)->suite());
  	}
  	
  	$runner = new PHPUnit_TextUI_TestRunner();
  	
    $runner->doRun($suite);
  }
}
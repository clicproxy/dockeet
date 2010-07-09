<?php

/**
 * Symfony task that prepare standart dirs and files for phpunit.
 *
 * @package    sfPhpunitPlugin
 * @subpackage task

 * @author     Maksim Kotlyar <mkotlar@ukr.net>
 */
class sfPhpunitInitTask extends sfBasePhpunitCreateTask
{
	public function __construct(sfEventDispatcher $dispatcher = null, sfFormatter $formatter = null)
	{
		is_null($dispatcher) && $dispatcher = new sfEventDispatcher;
		is_null($formatter) && $formatter = new sfFormatter;
		
		return parent::__construct($dispatcher, $formatter);
	}
	
  protected function configure()
  {  	
    $this->namespace        = 'phpunit';
    $this->name             = 'init';
    $this->briefDescription = 'Prepare files and dirs needed for phpunit';
    $this->detailedDescription = <<<EOF
EOF;

    parent::configure();
  }

  protected function execute($arguments = array(), $options = array())
  {
    parent::execute($arguments,$options);
    
  	$this->_initRequiredDirs();
  	$this->_initBaseClasses();
  	$this->_initFixturesDirs();
  }
  
  protected function _initRequiredDirs()
  {
    $phpunit_dir = ProjectConfiguration::guessRootDir().'/test/phpunit';
    
    $this->_createDir($phpunit_dir);
    $this->_createDir($phpunit_dir.'/units');
    $this->_createDir($phpunit_dir.'/functionals');
    $this->_createDir($phpunit_dir.'/models');
    $this->_createDir($phpunit_dir.'/fixtures');
    $this->_createDir($phpunit_dir.'/fixtures/units');
    $this->_createDir($phpunit_dir.'/fixtures/functionals');
    $this->_createDir($phpunit_dir.'/fixtures/models');
  }
  
  protected function _initBaseClasses()
  {
    $this->_createSuiteClass(
      '', 'unit/BasePhpunitTestSuite.tpl', array(
        'className' => 'BasePhpunitTestSuite', 
        'application' => $this->getFirstApplication()));
   
    $this->_createFile('AllTests.php', 'unit/AllTests.tpl');
  }
  
  protected function _initFixturesDirs(PHPUnit_Framework_TestSuite $suite = null)
  {    
    if (null === $suite) $suite = sfPhpunitProjectTestLoader::factory()->suite();
    
    foreach ($suite->tests() as $test) {
      //don't create fixtures directories for default created suite.
      if ('sfBasePhpunitTestSuite' === get_class($test)) {
        $this->_initFixturesDirs($test);
        continue;
      }      
      
      if ($test instanceof sfPhpunitFixtureAggregator) {
        $this->_createDir($test->getCommonFixtureDir());
        $this->_createDir($test->getPackageFixtureDir());
        $this->_createDir($test->getOwnFixtureDir());
      }
      
      if ($test instanceof PHPUnit_Framework_TestSuite) {
        $this->_initFixturesDirs($test);
      }
    }    
  }
}
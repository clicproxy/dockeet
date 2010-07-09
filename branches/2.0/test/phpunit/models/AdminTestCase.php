<?php
class AdminTestCase extends sfBasePhpunitTestCase implements sfPhpunitFixtureDoctrineAggregator
{

  public function testClassExists()
  {
    $this->assertTrue(class_exists('Admin'));
  }
  
  public function testPassword ()
  {
  	$admin = new Admin();
  	$admin->password = 'password';
  	$this->assertEquals(sha1($admin->salt . 'password'), $admin->password);
  }
  
  public function testLogin ()
  {
  	$admin = new Admin();
  	$admin->password = 'password';
  	$this->assertTrue($admin->login('password'));
  	$this->assertFalse($admin->login('Password'));
  }
}
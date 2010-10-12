<?php

class documentCleanVersionTask extends sfBaseTask
{
  protected function configure()
  {
    // // add your own arguments here
    // $this->addArguments(array(
    //   new sfCommandArgument('my_arg', sfCommandArgument::REQUIRED, 'My argument'),
    // ));

    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
      // add your own options here
    ));

    $this->namespace        = 'document';
    $this->name             = 'cleanVersion';
    $this->briefDescription = '';
    $this->detailedDescription = <<<EOF
The [document:cleanVersion|INFO] delete all version where the file doesn't exist.
Call it with:

  [php symfony document:cleanVersion|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'])->getConnection();

    // add your code here
    foreach(Doctrine::getTable('Document')->findAll() as $document)
    {
      foreach($document->Versions as $version)
      {
        if (!file_exists($document->getFilePath($version->id)))
        {
          $version->delete();
        }
      }
    }
  }
  
  
}

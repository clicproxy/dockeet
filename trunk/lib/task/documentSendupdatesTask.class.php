<?php

class documentSendupdatesTask extends sfBaseTask
{
  protected function configure()
  {
    // // add your own arguments here
    $this->addArguments(array(
      new sfCommandArgument('hostname', sfCommandArgument::REQUIRED, 'Hostname of the public site.'),
    ));

    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name', 'frontend'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'prod'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
      // add your own options here
    ));

    $this->namespace        = 'document';
    $this->name             = 'send-updates';
    $this->briefDescription = 'Sends updates informations emails';
    $this->detailedDescription = <<<EOF
The [document:send-updates|INFO] task does things.
Call it with:

  [php symfony document:send-updates|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'] ? $options['connection'] : null)->getConnection();

    // add your code here
    $this->context = sfContext::createInstance($this->configuration);
    $this->context->getConfiguration()->loadHelpers('Partial');
    //print_r($_SERVER);    
    $_SERVER['_'] = '_';
    $_SERVER['PHP_SELF'] = 'PHP_SELF';
    $_SERVER['SERVER_NAME'] = 'SERVER_NAME';
    $_SERVER['SCRIPT_NAME'] = 'SCRIPT_NAME';
    $_SERVER['SCRIPT_FILENAME'] = 'SCRIPT_FILENAME';
    $_SERVER['PATH_TRANSLATED'] = 'PATH_TRANSLATED';
    sfConfig::set('sf_no_script_name',true);
    sfConfig::set('sf_relative_url_root','');
    
    foreach (Doctrine::getTable('User')->findAll() as $user)
    {
      $send_mail = 1 < $user->getDocumentsUpdatesQuery()->count();
      
      if (!$send_mail)
      {
        foreach ($user->Categories as $category)
        {
          $send_mail = 1 < $user->getDocumentsUpdatesQuery($category)->count();
          if ($send_mail) break; 
        }
      }
      
      if ($send_mail)
      {
        $message = $this->getMailer()->compose(
          array('no-reply@no-reply.com' => 'Ressources management'),
          array($user->email => $user->username),
          'Document updates (' . date('d/m/Y') . ')',
          get_partial('user/mail_updates', array('user' => $user))
        );
        $this->getMailer()->send($message);
      }
    }
  }
}

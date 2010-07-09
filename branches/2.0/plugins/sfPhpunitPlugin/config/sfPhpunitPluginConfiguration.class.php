<?php

class sfPhpunitPluginConfiguration extends sfPluginConfiguration
{
  public function initialize()
  {
    $configFiles = $this->configuration->getConfigPaths('config/phpunit.yml');
    $config = sfDefineEnvironmentConfigHandler::getConfiguration($configFiles);
    
    foreach ($config as $name => $value) {
      sfConfig::set("sf_phpunit_{$name}", $value);  
    }
  }
}
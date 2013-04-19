<?php


require_once(dirname(__FILE__).'/config/ProjectConfiguration.class.php');

if(file_exists(dirname(__FILE__) . '/install.php')){ 
  $configuration = ProjectConfiguration::getApplicationConfiguration('install', 'prod', false);
}else{
  $configuration = ProjectConfiguration::getApplicationConfiguration('front', 'dev', true);
}

sfContext::createInstance($configuration)->dispatch();

<?php
ini_set('memory_limit', '256M');

require_once(dirname(__FILE__).'/config/ProjectConfiguration.class.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('front', 'dev', true);
sfContext::createInstance($configuration)->dispatch();

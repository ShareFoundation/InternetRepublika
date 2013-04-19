<?php

if (in_array('mg_page', sfConfig::get('sf_enabled_modules', array()))) {
  $this->dispatcher->connect('routing.load_configuration', array('mgPageRouting', 'listenToRoutingLoadConfigurationEvent'));
}

foreach (array('mg_page_admin', 'mg_page_content') as $module) {
  if (in_array($module, sfConfig::get('sf_enabled_modules'))) {
    $this->dispatcher->connect('routing.load_configuration', array('mgPageRouting', 'addRouteForAdmin_' . $module));
  }
}

// Clear frontend cache
$frontend_cache_dir = sfConfig::get('sf_cache_dir') . DIRECTORY_SEPARATOR . 'frontend' . DIRECTORY_SEPARATOR . sfConfig::get('sf_environment') . DIRECTORY_SEPARATOR . 'config\routing';
$cache = new sfFileCache(array('cache_dir' => $frontend_cache_dir));
$cache->clean();

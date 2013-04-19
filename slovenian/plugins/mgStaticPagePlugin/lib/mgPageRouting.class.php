<?php
class mgPageRouting
{
  public static function listenToRoutingLoadConfigurationEvent(sfEvent $event) {
    $r = $event->getSubject();

    $c = new Criteria();
    $pageList = PagePeer::doSelect($c);
    if (!empty($pageList)) {
      foreach ($pageList as $page) {
        $r->prependRoute($page->getLabel(), new sfRoute($page->getUrl(), array('module' => 'mg_page', 'action' => 'index', 'page' => $page->getLabel())));
      }
    }
  }

  static public function addRouteForAdmin_mg_page_admin(sfEvent $event) {
    $event->getSubject()->prependRoute('mg_page_admin', new sfPropelRouteCollection(array(
        'class' => 'sfPropelRouteCollection',
        'name' => 'mg_page_admin',
        'model' => 'Page',
        'module' => 'mg_page_admin',
        'prefix_path' => 'mg_page_admin',
        'column' => 'id',
        'with_wildcard_routes' => true,
        'requirements' => array(),
    )));
  }

  static public function addRouteForAdmin_mg_content_admin(sfEvent $event) {
    $event->getSubject()->prependRoute('mg_content_admin', new sfPropelRouteCollection(array(
        'class' => 'sfPropelRouteCollection',
        'name' => 'mg_content_admin',
        'model' => 'Content',
        'module' => 'mg_content_admin',
        'prefix_path' => 'mg_content_admin',
        'column' => 'id',
        'with_wildcard_routes' => true,
        'requirements' => array(),
    )));
  }
}
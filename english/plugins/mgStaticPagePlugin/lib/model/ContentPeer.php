<?php


/**
 * Skeleton subclass for performing query and update operations on the 'mg_content' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * 02/07/12 09:45:49
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    plugins.mgStaticPagePlugin.lib.model
 */
class ContentPeer extends BaseContentPeer {
  public static function retrieveByContent($content)
  {
    $c = new Criteria();
    $c->add(ContentPeer::LABEL, $content);
    $c->add(ContentPeer::IS_PUBLISHED, true);
    return ContentPeer::doSelectOne($c);
  }
} // ContentPeer

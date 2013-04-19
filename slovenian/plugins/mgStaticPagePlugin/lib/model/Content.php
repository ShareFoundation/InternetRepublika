<?php

class Content extends BaseContent {

  public static function ShowContent($content) {
    $c = new Criteria();
    $c->add(ContentPeer::LABEL, $content, Criteria::EQUAL);
    $content = ContentPeer::doSelectOne($c);
    if (empty($content)) {
      return "This content does not exist.";
    }
    echo strip_tags($content->getText());
  }

}
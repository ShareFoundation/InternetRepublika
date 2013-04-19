<?php

class Badge extends BaseBadge {

  public function getPostBadgeCount($postId) {
    $c = new Criteria();
    $c->add(PostBadgePeer::POST_ID, $postId);
    $c->add(PostBadgePeer::BADGE_ID, $this->getId());
    return PostBadgePeer::doCount($c);
  }

  public function getImageUrl() {
    return sfConfig::get('badge_image_url') . '/' . $this->getImage();
  }

  public function getImageLink($label) {
    if ($this->getImage() == '') {
      return 'There is no image.';
    } else {
      sfContext::getInstance()->getConfiguration()->loadHelpers(array('Tag', 'Url'));
      return link_to($label, $this->getImageUrl(), array('target' => '_blank'));
    }
  }

}
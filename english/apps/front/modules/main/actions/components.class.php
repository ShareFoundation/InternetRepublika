<?php

class mainComponents extends sfComponents {

    public function executeBadges(sfWebRequest $request) {
        $this->badge1 = BadgePeer::getBadgesByType(1);
        $this->badge2 = BadgePeer::getBadgesByType(2);
        $this->badge4 = BadgePeer::getBadgesByType(4);
    }

    public function executePost_fb_meta(sfWebRequest $request) {
        $this->post = PostPeer::retrieveByUrl($request->getParameter('url'));
    }

    public function executeParty_fb_meta(sfWebRequest $request) {
        $this->party = PartiePeer::retrieveByUrl($request->getParameter('url'));
    }

}
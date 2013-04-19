<?php

class sfGuardUserProfile extends BasesfGuardUserProfile {

    public function getFullName() {
        return $this->getFirstName() . ' ' . $this->getLastName();
    }

    public function getProfileImageUrl() {
        $image = null;

        if ($this->getImageUrl() != '' && file_exists(sfConfig::get('profile_image_path') . DIRECTORY_SEPARATOR . $this->getUserId() . DIRECTORY_SEPARATOR . $this->getImageUrl())) {
            $image = sfConfig::get('profile_image_url') . '/' . $this->getUserId() . '/' . $this->getImageUrl();
        }
        return $image;
    }

    public function getParty() {
        $c = new Criteria();
        $c->add(PartiePeer::USER_ID, $this->getUserId());
        $party = PartiePeer::doSelectOne($c);
        if (!empty($party)) {
            return $party;
        }
        return null;
    }

    public function isUserPost($post) {
        $party = $this->getParty();
        if ($party != null) {
            if ($party->getId() == $post->getPartieId()) {
                return true;
            }
        }
        return false;
    }

}
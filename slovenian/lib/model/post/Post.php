<?php

class Post extends BasePost {

    public function __construct() {
        parent::__construct();
    }

    public function storeReplicaPost() {
        $user = sfContext::getInstance()->getUser();
        if ($user->getAttribute('replicaPost') != null) {
            $this->setReplicaPostId($user->getAttribute('replicaPost')->getId());
            $this->save();
        }
    }

    public function storeBadgeByType($typeId) {
        $badge = $this->getBadgeByType($typeId);
        if ($badge->getId() != null && $badge->getId() != '') {
            if ($typeId == 1) {
                $this->setBestBadge1($badge->getId());
            } else {
                $this->setBestBadge2($badge->getId());
            }
            $this->save();
        }
    }

    public function getBadge1() {
        return BadgePeer::retrieveByPK($this->getBestBadge1()) == null ? new Badge() : BadgePeer::retrieveByPK($this->getBestBadge1());
    }

    public function getBadge2() {
        return BadgePeer::retrieveByPK($this->getBestBadge2()) == null ? new Badge() : BadgePeer::retrieveByPK($this->getBestBadge2());
    }

    public function getBadgeByType($typeId) {
        if ($typeId == 1) {
            $list = BadgePeer::getBadgesByType(1);
            $output = array();
            $max = 1;
            foreach ($list as $val) {
                $count = $val->getPostBadgeCount($this->getId());
                if ($count >= $max) {
                    $max = $count;
                }
                $output[$val->getId()] = $count;
            }
            $maxOutput = array();
            foreach ($output as $key1 => $val1) {
                if ($val1 == $max) {
                    $maxOutput[] = $key1;
                }
            }
            if (count($maxOutput) > 1) {
                $badge = BadgePeer::retrieveByPK(13);
                return $badge;
            } else if (count($maxOutput) == 0) {
                return new Badge();
            } else if (count($maxOutput == 1)) {
                return BadgePeer::retrieveByPK($maxOutput[0]);
            }
        } else {
            return $this->getAverageBadgeType2();
        }
    }

    public function getAverageBadgeType2() {
        $c = new Criteria();
        $c->add(PostBadgePeer::POST_ID, $this->getId());
        $c->add(PostBadgePeer::TYPE_ID, 2);
        $list = PostBadgePeer::doSelect($c);
        if (!empty($list)) {
            $output = array();
            foreach ($list as $val) {
                if (!key_exists($val->getBadge()->getOrder(), $output)) {
                    $output[$val->getBadge()->getOrder()] = 1;
                } else {
                    $output[$val->getBadge()->getOrder()] = $output[$val->getBadge()->getOrder()] + 1;
                }
            }

            $sum = 0;
            foreach ($output as $key1 => $val1) {
                $sum = $sum + $val1 * $key1;
            }

            $average = round($sum / array_sum($output));
            $c = new Criteria();
            $c->add(BadgePeer::TYPE_ID, 2);
            $c->add(BadgePeer::ORDER, $average);
            if (BadgePeer::doCount($c) > 0) {
                return BadgePeer::doSelectOne($c);
            }
        }
        return new Badge();
    }

    public function addBadge($badge, $user) {
        $c = new Criteria();
        $c->add(PostBadgePeer::POST_ID, $this->getId());
        $c->add(PostBadgePeer::USER_ID, $user->getId());
        $c->add(PostBadgePeer::TYPE_ID, $badge->getTypeId());
        $userBadge = PostBadgePeer::doSelectOne($c);
        if (!empty($userBadge)) {
            $userBadge->setBadgeId($badge->getId());
            $userBadge->save();
        } else {
            $userBadge = new PostBadge();
            $userBadge->setUserId($user->getId());
            $userBadge->setPostId($this->getId());
            $userBadge->setBadgeId($badge->getId());
            $userBadge->setTypeId($badge->getTypeId());
            $userBadge->save();
        }
        $this->storeBadgeByType(1);
        $this->storeBadgeByType(2);
    }

    public function getUrl() {
        if ($this->getId()) {
            $url = parent::getUrl();
            if ($url == '') {
                // Generate new url
                $name = strtolower($this->getTitle());

                $name = str_replace("ć", "c", $name);
                $name = str_replace("č", "c", $name);
                $name = str_replace("ž", "z", $name);
                $name = str_replace("đ", "d", $name);
                $name = str_replace("š", "s", $name);

                $url = ltrim(rtrim(preg_replace("/[^A-Za-z0-9-]/", "-", $name), "-"), "-");
                $c = new Criteria();
                $c->add(PostPeer::URL, $url);
                if (PostPeer::doCount($c) > 0) {
                    $url .= '-' . $this->getId();
                }
                $this->setUrl($url);
                $this->save();
            }
            return $url;
        }
        return '';
    }

    public function getLink() {
        return sfContext::getInstance()->getController()->genUrl('@post_view?url=' . $this->getUrl(), true);
    }

    public function getPrintText($count = 250) {
        $text = strip_tags($this->getText());
        if (strlen($text) > $count) {
            $text = substr($text, 0, $count) . '...';
        }
        return $text;
    }

    public function getPrintTitle($count = 250) {
        $text = $this->getTitle();
        if (strlen($text) > $count) {
            $text = substr($text, 0, $count) . '...';
        }
        return strip_tags($text);
    }

    public function getLinkImageUrl() {
        return sfConfig::get('post_photo_url') . '/' . $this->getLinkImage();
    }

    public function getPhotoImageUrl() {
        if ($this->getPhotoFile() != '' && file_exists(sfConfig::get('post_photo_path') . '/' . $this->getPhotoFile())) {
            return sfConfig::get('post_photo_url') . '/' . $this->getPhotoFile();
        }
        return '';
    }

    public function getCommentsCount() {
      $c = new Criteria();
      $c->add(CommentPeer::ITEM_ID, $this->getId());
      $c->add(CommentPeer::ITEM_TYPE, 1);
      return CommentPeer::doCount($c);
    }

    public function getCommentsCountText() {
        $output = $this->getCommentsCount() . ' ';
        if (in_array($this->getCommentsCount(), array(1))) {
            $output .= 'Komentar';
        } else {
            $output .= 'Komentara';
        }
    }

    public function getReplicaCount() {
        $c = new Criteria();
        $c->add(PostPeer::REPLICA_POST_ID, $this->getId());
        return PostPeer::doCount($c);
    }

    public function getAnswers() {
        $c = new Criteria();
        $c->add(PostPollAnswerPeer::POST_ID, $this->getId());
        $c->addAscendingOrderByColumn(PostPollAnswerPeer::ID);
        return PostPollAnswerPeer::doSelect($c);
    }

    public function getIndexOfSupport() {
        return $this->getTotalIndex();
    }

    public function getTypePopularPosts($limit = 0, $offset = 0, $sort = PostPeer::TOTAL_INDEX) {
        $c = new Criteria();
        $c->add(PostPeer::TYPE, $this->getType());
        if ($limit > 0) {
            $c->setLimit($limit);
        }
        if ($offset > 0) {
            $c->setOffset($offset);
        }
        $c->addDescendingOrderByColumn($sort);
        $c->addGroupByColumn(PostPeer::ID);
        return PostPeer::doSelect($c);
    }

    public function getReplicaPosts($limit = 0, $offset = 0, $sort = PostPeer::TOTAL_INDEX) {
        $c = new Criteria();
        $c->add(PostPeer::REPLICA_POST_ID, $this->getId());
        if ($limit > 0) {
            $c->setLimit($limit);
        }
        if ($offset > 0) {
            $c->setOffset($offset);
        }
        $c->addDescendingOrderByColumn($sort);
        $c->addGroupByColumn(PostPeer::ID);
        return PostPeer::doSelect($c);
    }

    public function getTypeName() {
        switch ($this->getType()) {
            case PostPeer::TYPE_TEXT:
                return PostPeer::TYPE_TEXT_NAME;
                break;
            case PostPeer::TYPE_PHOTO:
                return PostPeer::TYPE_PHOTO_NAME;
                break;
            case PostPeer::TYPE_VIDEO:
                return PostPeer::TYPE_VIDEO_NAME;
                break;
            case PostPeer::TYPE_QUOTE:
                return PostPeer::TYPE_QUOTE_NAME;
                break;
            case PostPeer::TYPE_LINK:
                return PostPeer::TYPE_LINK_NAME;
                break;
            case PostPeer::TYPE_POLL:
                return PostPeer::TYPE_POLL_NAME;
                break;
            default:
                return '';
        }
    }

    public function getRealTypeName() {
        switch ($this->getType()) {
            case PostPeer::TYPE_TEXT:
                return 'text';
                break;
            case PostPeer::TYPE_PHOTO:
                return 'photo';
                break;
            case PostPeer::TYPE_VIDEO:
                return 'video';
                break;
            case PostPeer::TYPE_QUOTE:
                return 'quote';
                break;
            case PostPeer::TYPE_LINK:
                return 'link';
                break;
            case PostPeer::TYPE_POLL:
                return 'poll';
                break;
            default:
                return '';
        }
    }

    public function getPastComments() {
        $c = new Criteria();
        $c->add(PostDailyStatsPeer::POST_ID, $this->getId());
        $c->add(PostDailyStatsPeer::CREATED_AT, date('Y-m-d 00:00:00'), Criteria::LESS_THAN);
        $count = 0;
        $list = PostDailyStatsPeer::doSelect($c);
        if (!empty($list)) {
            foreach ($list as $val) {
                $count = $count + $val->getComment();
            }
        }

        return $count;
    }

    public function getPastBadges() {
        $c = new Criteria();
        $c->add(PostDailyStatsPeer::POST_ID, $this->getId());
        $c->add(PostDailyStatsPeer::CREATED_AT, date('Y-m-d 00:00:00'), Criteria::LESS_THAN);
        $count = 0;
        $list = PostDailyStatsPeer::doSelect($c);
        if (!empty($list)) {
            foreach ($list as $val) {
                $count = $count + $val->getBadge();
            }
        }

        return $count;
    }

    public function getDailyVisitCount() {
        $c = new Criteria();
        $c->add(PostVisitsPeer::POST_ID, $this->getId());
        $c->add(PostVisitsPeer::CREATED_AT, date('Y-m-d'));
        return PostVisitsPeer::doCount($c);
    }

    public function getTodayStats() {
        $c = new Criteria();
        $c->add(PostDailyStatsPeer::POST_ID, $this->getId());
        $c->add(PostDailyStatsPeer::CREATED_AT, date('Y-m-d'));
        $stat = PostDailyStatsPeer::doSelectOne($c);
        if (empty($stat)) {
            $pds = new PostDailyStats();
            $pds->setPostId($this->getId());
            $pds->setCreatedAt(date('Y-m-d'));
            $pds->setTwitt(0);
            $pds->setLike(0);
            $pds->setComment(0);
            $pds->save();
            return $pds;
        }
        return $stat;
    }

    public function storeView() {
        $user = sfContext::getInstance()->getUser();
        if ($user->isAuthenticated()) {
            $c = new Criteria();
            $c->add(PostVisitsPeer::USER_ID, $user->getGuardUser()->getId());
            $c->add(PostVisitsPeer::POST_ID, $this->getId());
            $c->add(PostVisitsPeer::CREATED_AT, date('Y-m-d'));
            if (PostVisitsPeer::doCount($c) == 0) {
                $pv = new PostVisits();
                $pv->setUserId($user->getGuardUser()->getId());
                $pv->setPostId($this->getId());
                $pv->setCreatedAt(date('Y-m-d'));
                $pv->save();
            }
        } else {
            if (isset($_COOKIE['nizbpv']) && $_COOKIE['nizbpv'] != '') {
                $c = new Criteria();
                $c->add(PostVisitsPeer::COOKIE_ID, $_COOKIE['nizbpv']);
                $c->add(PostVisitsPeer::POST_ID, $this->getId());
                $c->add(PostVisitsPeer::CREATED_AT, date('Y-m-d'));
            } else {
                $cid = md5(time() . rand(1000, 9999));
                setcookie('nizbpv', $cid, time() + 60 * 60 * 24 * 600);
                $pv = new PostVisits();
                $pv->setCookieId($cid);
                $pv->setPostId($this->getId());
                $pv->setCreatedAt(date('Y-m-d'));
                $pv->save();
            }
        }
    }

    public function getBadgesCount($byDate = true) {
        $c = new Criteria();
        $c->add(PostBadgePeer::POST_ID, $this->getId());
        /* if($byDate){
          $c->addAnd(PostBadgePeer::CREATED_AT, date('Y-m-d 00:00:00'), Criteria::GREATER_EQUAL);
          $c->addAnd(PostBadgePeer::CREATED_AT, date('Y-m-d 23:59:59'), Criteria::LESS_EQUAL);
          } */
        return PostBadgePeer::doCount($c);
    }

    public function calculateIndexes() {
        $totalIndex = 0;
        $weeklyIndex = 0;
        $dailyIndex = 0;

        // Calculate total index
        $c = new Criteria();
        $c->add(PostDailyStatsPeer::POST_ID, $this->getId());
        $list = PostDailyStatsPeer::doSelect($c);
        if (!empty($list)) {
            foreach ($list as $val) {
                $totalIndex = $totalIndex + $val->getCurrentIndex();
            }
        }

        // Calculate daily index
        $c = new Criteria();
        $c->add(PostDailyStatsPeer::POST_ID, $this->getId());
        $c->add(PostDailyStatsPeer::CREATED_AT, date('Y-m-d'));
        $list = PostDailyStatsPeer::doSelect($c);
        if (!empty($list)) {
            foreach ($list as $val) {
                $dailyIndex = $dailyIndex + $val->getCurrentIndex();
            }
        }

        // Calculate weekly index
        $c = new Criteria();
        $c->add(PostDailyStatsPeer::POST_ID, $this->getId());
        $c->add(PostDailyStatsPeer::CREATED_AT, date('Y-m-d 00:00:00', strtotime('this week', time())), Criteria::GREATER_EQUAL);
        $c->add(PostDailyStatsPeer::CREATED_AT, date('Y-m-d 23:59:59', strtotime('next sunday', time())), Criteria::LESS_EQUAL);
        $list = PostDailyStatsPeer::doSelect($c);
        if (!empty($list)) {
            foreach ($list as $val) {
                $weeklyIndex = $weeklyIndex + $val->getCurrentIndex();
            }
        }

        $this->storeIndex($dailyIndex, $weeklyIndex, $totalIndex);
    }

    public function storeIndex($daily = 0, $weekly = 0, $total = 0) {
        $c = new Criteria();
        $c->add(PostIndexPeer::POST_ID, $this->getId());
        $index = PostIndexPeer::doSelectOne($c);
        if (empty($index)) {
            $index = new PostIndex();
            $index->setPostId($this->getId());
        }
        $index->setDaily($daily);
        $index->setWeekly($weekly);
        $index->setTotal($total);
        $index->save();

        $this->setTotalIndex($total);
        $this->save();
    }

    public function __toString() {
        return $this->getTitle();
    }

    public function deleteReplicas() {
        $c = new Criteria();
        $c->add(PostPeer::REPLICA_POST_ID, $this->getId());
        $list = PostPeer::doSelect($c);
        if (!empty($list)) {
            foreach ($list as $val) {
                $val->setReplicaPostId(null);
                $val->save();
            }
        }
    }

}

sfPropelBehavior::add('Post', array('sfPropelActAsTaggableBehavior'));
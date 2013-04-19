<?php

class Partie extends BasePartie {

  public function __construct() {
    parent::__construct();
  }

  public function __toString() {
    return $this->getName();
  }

  public function getUrl() {
    if ($this->getId()) {
      $url = parent::getUrl();
      if ($url == '') {
        // Generate new url
        $name = strtolower($this->getName());

        $name = str_replace("ć", "c", $name);
        $name = str_replace("č", "c", $name);
        $name = str_replace("ž", "z", $name);
        $name = str_replace("đ", "d", $name);
        $name = str_replace("š", "s", $name);

        $url = ltrim(rtrim(preg_replace("/[^A-Za-z0-9-]/", "-", $name), "-"), "-");
        $c = new Criteria();
        $c->add(PartiePeer::URL, $url);
        if (PartiePeer::doCount($c) > 0) {
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
    return sfContext::getInstance()->getController()->genUrl('@party_view?url=' . $this->getUrl(), true);
  }

  public function getImageRealUrl() {
    return sfConfig::get('party_logo_url') . '/' . $this->getLogo();
  }

  public function getPartyPosts($limit = 0, $offset = 0, $sort = PostPeer::TOTAL_INDEX) {
    $c = new Criteria();
    $c->add(PostPeer::PARTIE_ID, $this->getId());
    if ($limit > 0) {
      $c->setLimit($limit);
    }
    if ($offset > 0) {
      $c->setOffset($offset);
    }
    $c->addDescendingOrderByColumn($sort);
    return PostPeer::doSelect($c);
  }

  public function getRang() {
    return $this->getTotalIndex();
  }

  public function getRealRang() {
    $c = new Criteria();
    $c->add(PartiePeer::IS_PUBLISHED, true);
    $c->addDescendingOrderByColumn(PartiePeer::TOTAL_INDEX);
    $list = PartiePeer::doSelect($c);
    $i = 0;
    foreach ($list as $val) {
      $i++;
      if ($val->getId() == $this->getId()) {
        break;
      }
    }
    return $i;
  }

  public function getOrientationBadge() {
    $c = new Criteria();
    $c->addJoin(PostBadgePeer::POST_ID, PostPeer::ID);
    $c->add(PostPeer::PARTIE_ID, $this->getId());
    $c->add(PostBadgePeer::TYPE_ID, 1);
    $c->addAsColumn('count', 'COUNT(' . PostBadgePeer::BADGE_ID . ')');
    $c->addAsColumn('id', PostBadgePeer::BADGE_ID);
    $c->addDescendingOrderByColumn('count');
    $c->addGroupByColumn(PostBadgePeer::BADGE_ID);
    $rs = PostBadgePeer::doSelectStmt($c);
    $max = 0;
    $current_id = 0;
    $results = $rs->fetchAll();
    if (count($results) > 0) {
      foreach ($results as $val) {
        $count = $val['count'];
        $id = $val['id'];
        if ($max == 0 || $max == $count) {
          $current_id = $id;
          $max = $count;
        }
      }
      return BadgePeer::retrieveByPK($current_id);
    } else {
      return BadgePeer::getBadgesByTypeOne(3);
    }
  }

  public function getOrintationGraphData() {
    $c = new Criteria();
    $c->addJoin(PostBadgePeer::POST_ID, PostPeer::ID);
    $c->addJoin(PostBadgePeer::BADGE_ID, BadgePeer::ID);
    $c->add(PostPeer::PARTIE_ID, $this->getId());
    $c->add(PostBadgePeer::TYPE_ID, 1);
    $c->addAsColumn('count', 'COUNT(' . PostBadgePeer::BADGE_ID . ')');
    $c->addAsColumn('max', ' (SELECT COUNT(*) as count FROM post_badge pb LEFT JOIN post p ON pb.post_id = p.id WHERE p.partie_id = ' . $this->getId() . ' AND pb.type_id = 1)');
    $c->addAsColumn('id', PostBadgePeer::BADGE_ID);
    $c->addAsColumn('name', BadgePeer::NAME);
    $c->addDescendingOrderByColumn('count');
    $c->addGroupByColumn(PostBadgePeer::BADGE_ID);
    $rs = PostBadgePeer::doSelectStmt($c);
    $max = 0;
    $current_id = 0;
    $results = $rs->fetchAll();
    if (count($results) > 0) {
      foreach ($results as &$val) {
        $val['percent'] = round(($val['count'] / $val['max']) * 100, 2);
      }
      return $results;
    }
    return array();
  }

  public function getBioLimited() {
    if (strlen($this->getBio()) > 250) {
      return substr($this->getBio(), 0, 250) . '...';
    }
    return $this->getBio();
  }

  public function getCommentsCount() {
    $c = new Criteria();
    $c->add(CommentPeer::ITEM_ID, $this->getId());
    $c->add(CommentPeer::ITEM_TYPE, 2);
    return CommentPeer::doCount($c);
  }

  public function getPastComments() {
    $c = new Criteria();
    $c->add(PartieDailyStatsPeer::PARTIE_ID, $this->getId());
    $c->add(PartieDailyStatsPeer::CREATED_AT, date('Y-m-d 00:00:00'), Criteria::LESS_THAN);
    $count = 0;
    $list = PartieDailyStatsPeer::doSelect($c);
    if (!empty($list)) {
      foreach ($list as $val) {
        $count = $count + $val->getComment();
      }
    }

    return $count;
  }

  public function getDailyVisitCount() {
    $c = new Criteria();
    $c->add(PartieVisitsPeer::PARTIE_ID, $this->getId());
    $c->add(PartieVisitsPeer::CREATED_AT, date('Y-m-d'));
    return PartieVisitsPeer::doCount($c);
  }

  public function getTodayStats() {
    $c = new Criteria();
    $c->add(PartieDailyStatsPeer::PARTIE_ID, $this->getId());
    $c->add(PartieDailyStatsPeer::CREATED_AT, date('Y-m-d'));
    $stat = PartieDailyStatsPeer::doSelectOne($c);
    if (empty($stat)) {
      $pds = new PartieDailyStats();
      $pds->setPartieId($this->getId());
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
      $c->add(PartieVisitsPeer::USER_ID, $user->getGuardUser()->getId());
      $c->add(PartieVisitsPeer::PARTIE_ID, $this->getId());
      $c->add(PartieVisitsPeer::CREATED_AT, date('Y-m-d'));
      if (PartieVisitsPeer::doCount($c) == 0) {
        $pv = new PartieVisits();
        $pv->setUserId($user->getGuardUser()->getId());
        $pv->setPartieId($this->getId());
        $pv->setCreatedAt(date('Y-m-d'));
        $pv->save();
      }
    } else {
      if (isset($_COOKIE['nizbpv']) && $_COOKIE['nizbpv'] != '') {
        $c = new Criteria();
        $c->add(PartieVisitsPeer::COOKIE_ID, $_COOKIE['nizbpv']);
        $c->add(PartieVisitsPeer::PARTIE_ID, $this->getId());
        $c->add(PartieVisitsPeer::CREATED_AT, date('Y-m-d'));
      } else {
        $cid = md5(time() . rand(1000, 9999));
        setcookie('nizbpv', $cid, time() + 60 * 60 * 24 * 600);
        $pv = new PartieVisits();
        $pv->setCookieId($cid);
        $pv->setPartieId($this->getId());
        $pv->setCreatedAt(date('Y-m-d'));
        $pv->save();
      }
    }
  }

  public function calculateIndexes() {
    $totalIndex = 0;
    $weeklyIndex = 0;
    $dailyIndex = 0;

    $party = PartiePeer::retrieveByPK($this->getId());
    $topParties = $party->getPartyPosts(10);
    $postIndex = 0;
    if (!empty($topParties)) {
      foreach ($topParties as $post) {
        $postIndex = $postIndex + $post->getTotalIndex();
      }
    }

    // Calculate total index
    $c = new Criteria();
    $c->add(PartieDailyStatsPeer::PARTIE_ID, $this->getId());
    $list = PartieDailyStatsPeer::doSelect($c);
    if (!empty($list)) {
      foreach ($list as $val) {
        $totalIndex = $totalIndex + $val->getCurrentIndex();
      }
    }

    // Calculate daily index
    $c = new Criteria();
    $c->add(PartieDailyStatsPeer::PARTIE_ID, $this->getId());
    $c->add(PartieDailyStatsPeer::CREATED_AT, date('Y-m-d'));
    $list = PartieDailyStatsPeer::doSelect($c);
    if (!empty($list)) {
      foreach ($list as $val) {
        $dailyIndex = $dailyIndex + $val->getCurrentIndex();
      }
    }

    // Calculate weekly index
    $c = new Criteria();
    $c->add(PartieDailyStatsPeer::PARTIE_ID, $this->getId());
    $c->add(PartieDailyStatsPeer::CREATED_AT, date('Y-m-d 00:00:00', strtotime('this week', time())), Criteria::GREATER_EQUAL);
    $c->add(PartieDailyStatsPeer::CREATED_AT, date('Y-m-d 23:59:59', strtotime('next sunday', time())), Criteria::LESS_EQUAL);
    $list = PartieDailyStatsPeer::doSelect($c);
    if (!empty($list)) {
      foreach ($list as $val) {
        $weeklyIndex = $weeklyIndex + $val->getCurrentIndex();
      }
    }

    $this->storeIndex($dailyIndex + $postIndex + $this->getCustomIndex(), $weeklyIndex + $postIndex + $this->getCustomIndex(), $totalIndex + $postIndex + $this->getCustomIndex());
  }

  public function storeIndex($daily = 0, $weekly = 0, $total = 0) {
    $c = new Criteria();
    $c->add(PartieIndexPeer::PARTIE_ID, $this->getId());
    $index = PartieIndexPeer::doSelectOne($c);
    if (empty($index)) {
      $index = new PartieIndex();
      $index->setPartieId($this->getId());
    }
    $index->setDaily($daily);
    $index->setWeekly($weekly);
    $index->setTotal($total);
    $index->save();

    $this->setTotalIndex($total);
    $this->save();
  }

  public function getPartieCustomPointsLog() {
    $c = new Criteria();
    $c->add(PartieCustomPointsPeer::PARTIE_ID, $this->getId());
    $c->addDescendingOrderByColumn(PartieCustomPointsPeer::CREATED_AT);
    return PartieCustomPointsPeer::doSelect($c);
  }

  public function getCustomIndex() {
    $index = 0;
    $list = $this->getPartieCustomPointsLog();
    if (!empty($list) && count($list) > 0) {
      $index = $list[0]->getPoints();
    }
    return $index;
  }

  public function getTags() {
    $posts = $this->getPosts();
    $ids = array();
    if (!empty($posts)) {
      foreach ($posts as $post) {
        $ids[] = $post->getId();
      }
    }

    $c = new Criteria();
    $c->addJoin(TagPeer::ID, TaggingPeer::TAG_ID);
    $c->addAnd(TaggingPeer::TAGGABLE_ID, $ids, Criteria::IN);
    $c->addAnd(TaggingPeer::TAGGABLE_MODEL, 'Post');
    $c->addGroupByColumn(TagPeer::ID);
    $c->addAscendingOrderByColumn(TagPeer::NAME);
    return TagPeer::doSelect($c);
  }

}
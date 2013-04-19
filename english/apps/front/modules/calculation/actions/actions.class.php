<?php
sfContext::getInstance()->getConfiguration()->loadHelpers('mgUrlContent');
/**
 * calculation actions.
 *
 * @package    netizbori
 * @subpackage calculation
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class calculationActions extends sfActions
{
  public function preExecute() {
    parent::preExecute();
    /*$security = $this->getRequest()->getParameter('uid', null);
    if(md5('postsystem') != $security){
      $this->forward404('Illegal access');
    }*/
  }
  
  public function executeIndex(sfWebRequest $request)
  {
    $c = new Criteria();
    $postsList = PostPeer::doSelect($c);
    echo date('Y-m-d H:i:s'); echo '<br/>';
    if(!empty($postsList)){
      foreach($postsList as $post){
        $stats = $post->getTodayStats();
        $stats->setLike(0);
        $stats->setComment($post->getCommentsCount());
        $stats->setViews($post->getDailyVisitCount());
        $stats->setBadge($post->getBadgesCount(true) - $post->getPastBadges());
        $stats->setTwitt(0);
        $stats->save();
        $stats->calculateDailyIndex();
        $post->calculateIndexes();
      }
    }
    echo date('Y-m-d H:i:s'); echo '<br/>';

    $c = new Criteria();
    $partiesList = PartiePeer::doSelect($c);
    echo date('Y-m-d H:i:s'); echo '<br/>';
    if(!empty($partiesList)){
      foreach($partiesList as $party){
        $stats = $party->getTodayStats();
        $stats->setLike(0);
        $stats->setComment($party->getCommentsCount());
        $stats->setViews($party->getDailyVisitCount());
        $stats->setBadge(0);
        $stats->setTwitt(0);
        $stats->save();
        $stats->calculateDailyIndex();
        $party->calculateIndexes();
      }
    }
    echo date('Y-m-d H:i:s'); echo '<br/>';
    echo 'Parties indexes successully claculated.';    
    
    exit;
  }
}

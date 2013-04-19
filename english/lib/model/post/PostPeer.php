<?php
class PostPeer extends BasePostPeer {
  
  const TYPE_TEXT = 1;
  const TYPE_PHOTO = 2;
  const TYPE_VIDEO = 3;
  const TYPE_QUOTE = 4;
  const TYPE_LINK = 5;
  const TYPE_POLL = 6;
  
  const TYPE_TEXT_NAME = 'Text';
  const TYPE_PHOTO_NAME = 'Photo';
  const TYPE_VIDEO_NAME = 'Video';
  const TYPE_QUOTE_NAME = 'Quote';
  const TYPE_LINK_NAME = 'Link';
  const TYPE_POLL_NAME = 'Poll';
  
  public static function retrieveByUrl($url)
  {
    $c = new Criteria();
    $c->add(self::URL, $url);
    return self::doSelectOne($c);
  }
  
  public static function getPosts($offset = 0, $limit = 0, $criteria = null, $sort = self::CREATED_AT)
  {
    if($criteria == null){
      $c = new Criteria();
    }else{
      $c = $criteria;
    }
    //$c->add(self::IS_PUBLISHED, true);
    //$c->addDescendingOrderByColumn($sort);
    if($limit > 0)
      $c->setLimit($limit);
    $c->setOffset($offset);
    return self::doSelect($c);
  }
  
  public static function getFeaturedPost(){
    $c = new Criteria();
    $c->add(PostPeer::IS_FEATURED, true);
    return PostPeer::doSelectOne($c);
  }
}

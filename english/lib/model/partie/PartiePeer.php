<?php
class PartiePeer extends BasePartiePeer {
  public static function retrieveByUrl($url)
  {
    $c = new Criteria();
    $c->add(self::URL, $url);
    return self::doSelectOne($c);
  }
  
  public static function getTopParties($limit = 0, $offset = 0, $query = null)
  {
    $c = new Criteria();
    $c->addDescendingOrderByColumn(self::TOTAL_INDEX);
    
    if($query != null){
      $c->add(self::NAME, '%' . $query . '%', Criteria::LIKE);
    }
    
    if($limit > 0)
      $c->setLimit($limit);
    
    if($offset > 0)
      $c->setOffset($offset);
    
    return self::doSelect($c);
  }
}

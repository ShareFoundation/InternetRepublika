<?php
class newsComponents extends sfComponents
{
  public function executeNews_list(sfWebRequest $request)
  {
    if(!$request->isXmlHttpRequest())
    {
      $this->getUser()->setAttribute('news_count', 0);
    }
    else
    {
      $this->getUser()->setAttribute('news_count', $this->getUser()->getAttribute('news_count') + 5);
    }
    $this->newsList = NewsPeer::getNewsList(5, $this->getUser()->getAttribute('news_count'));
  }
}
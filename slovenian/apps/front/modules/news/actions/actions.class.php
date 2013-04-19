<?php
class newsActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->title = __('News');
    $this->getResponse()->setTitle($this->title);

    $c = new Criteria();
    $c->add(NewsPeer::IS_PUBLISHED, true);
    $this->newsList = NewsPeer::doSelect($c);
  }
  
  public function executeView(sfWebRequest $request)
  {
    $this->forward404Unless($this->news = NewsPeer::retrieveByUrl($request->getParameter('url')));
    $this->title = __('News') . ':' . $this->news->getTitle();
    $this->getResponse()->setTitle($this->title);
  }
}
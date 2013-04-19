<?php
class mg_pageActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
		$page = $request->getParameter('page');
  	$c = new Criteria();
  	$c->add(PagePeer::LABEL, $page, Criteria::EQUAL);
  	$this->forward404Unless($this->page = PagePeer::doSelectOne($c));
  	$response = $this->getResponse();
  	$response->setTitle($this->page->getMetaTitle());  	
    $response->addMeta('keywords', $this->page->getMetaKeywords());
    $response->addMeta('description', $this->page->getMetaDescription());
  }
}

<?php

class partiesActions extends sfActions
{
  public function preExecute() {
    parent::preExecute();
    sfApplicationConfiguration::getActive()->loadHelpers(array('I18N'));
  }
  
  public function executeIndex(sfWebRequest $request)
  {
    $this->getResponse()->setTitle(__('Parties'));
    $this->type = $request->getParameter('type', 'grid');
  }
  
  public function executeSearch(sfWebRequest $request)
  {
    $this->getResponse()->setTitle(__('Search Parties'));
    $this->type = $request->getParameter('type', 'grid');
  }
  
  
  public function executeView(sfWebRequest $request)
  {
    $this->forward404Unless($this->party = PartiePeer::retrieveByUrl($request->getParameter('url')));
    $this->title = __('Party') . ': ' . $this->party->getName();
    $this->getResponse()->setTitle($this->title);
    
    $this->party->storeView();
  }
}

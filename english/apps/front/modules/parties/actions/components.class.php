<?php
class partiesComponents extends sfComponents
{
  
  public function __construct($context, $moduleName, $actionName) {
    parent::__construct($context, $moduleName, $actionName);
    sfApplicationConfiguration::getActive()->loadHelpers(array('mgUrlContent', 'mgSimpleHtmlDom'));
    sfApplicationConfiguration::getActive()->loadHelpers(array('I18N'));
  }
  
  public function executeOrientation(sfWebRequest $request)
  {
  }
  
  public function executeParty_list(sfWebRequest $request)
  {
    if(!$request->isXmlHttpRequest())
    {
      $this->getUser()->setAttribute('party_count', 0);
    }
    else
    {
      $this->getUser()->setAttribute('party_count', $this->getUser()->getAttribute('party_count') + 8);
    }
    $c = new Criteria();
    if(isset($this->party))
    {
      $c->add(PostPeer::PARTIE_ID, $this->party->getId());
    }
    
    $query = $request->getParameter('query', null);
    
    $this->partyList = PartiePeer::getTopParties(8, $this->getUser()->getAttribute('party_count'), $query);   
  }
  
  public function executeParty_clasic_list(sfWebRequest $request)
  {
    if(!$request->isXmlHttpRequest())
    {
      $this->getUser()->setAttribute('party_count', 0);
    }
    else
    {
      $this->getUser()->setAttribute('party_count', $this->getUser()->getAttribute('party_count') + 50);
    }
    $c = new Criteria();
    if(isset($this->party))
    {
      $c->add(PostPeer::PARTIE_ID, $this->party->getId());
    }
    
    $query = $request->getParameter('query', null);
    
    $this->partyList = PartiePeer::getTopParties(50, $this->getUser()->getAttribute('party_count'), $query);   
  }
  
  public function executeDelete_partie(sfWebRequest $request) {
    if (!mgAjax::isAjax()) {
      echo mgAjax::ajaxOutput('error', __('Connection error'));
      exit;
    }
    if (!$this->getUser()->isAuthenticated()) {
      echo mgAjax::ajaxOutput('error', __('You need to be logged in'));
      exit;
    }

    $user = $this->getUser()->getGuardUser();
    $profile = $user->getProfile();
    $partie = $profile->getParty();
    
    if($partie != null){
      foreach($partie->getPartyPosts() as $post)
      {
        $post->deleteReplicas();
      }
      $partie->delete();
    }
    echo mgAjax::ajaxOutput('success', __('Party has been successfully deleted.'));
    exit;
  }
}
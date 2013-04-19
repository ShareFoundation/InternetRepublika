<?php
class userComponents extends sfComponents
{
  public function executeMy_profile(sfWebRequest $request)
  {
    if(!mgAjax::isAjax()){ echo mgAjax::ajaxOutput('error', __('Connection error')); exit; }
    if(!$this->getUser()->isAuthenticated()){ echo mgAjax::ajaxOutput('error', __('You need to be logged in.')); exit; }
    
    $user = $this->getUser()->getGuardUser();
    $profile = $user->getProfile();
    
    $data = array(
        'first_name'  => $profile->getFirstName(),
        'last_name'   => $profile->getLastName(),
        'email'       => $profile->getEmail(),
        'username'    => $user->getUsername()
    );
    
    $this->form = new ProfileForm($data);
    $values = $request->getParameter($this->form->getName());
    if($values['submited'])
    {
      $values['username'] = $user->getUsername();
      $this->form->bind($values);
      if($this->form->isValid())
      {
        $profile->setFirstName($values['first_name']);
        $profile->setLastName($values['last_name']);
        $profile->setEmail($values['email']);
        $profile->save();
        
        if($values['password'] != '')
        {
          $user->setPassword($values['password']);
          $user->save();
        }
        $this->getUser()->setFlash('notice', __('You have successfully changed your profile.'));
      }
    }
  }
  
  public function executeProfile_image(sfWebRequest $request)
  {
  }
  
  public function executeCreate_party(sfWebRequest $request)
  {
    if(!mgAjax::isAjax()){ echo mgAjax::ajaxOutput('error', __('Connection error')); exit; }
    if(!$this->getUser()->isAuthenticated()){ echo mgAjax::ajaxOutput('error', __('You need to be logged in.')); exit; }
    
    $user = $this->getUser()->getGuardUser();
    $profile = $user->getProfile();
    
    $party = $profile->getParty();
    $this->party = $party;
    if($party == null){
      $this->form = new PartieForm();
    }else{
      $this->form = new PartieEditForm($party);
    }
    $values = $request->getParameter($this->form->getName());
    if($values['submited'])
    {
      if($party == null){
        $values['user_id'] = $profile->getUserId();
      }
      if(isset($values['remove_logo']) && !empty($values['remove_logo'])){
        $values['logo'] = '';
      }
      $this->form->bind($values);
      if($this->form->isValid())
      {
        $party1 = $this->form->save();
        if($party == null){
          echo mgAjax::ajaxOutput('success', __('You have successfully created party.'), array('url' => $party1->getLink())); exit;  
        }else{
          echo mgAjax::ajaxOutput('success', __('You have successfully edit party.'), array('url' => $party1->getLink())); exit;
        }
      }
    }
  }
  
  public function executeDelete_user(sfWebRequest $request) {
    if (!mgAjax::isAjax()) {
      echo mgAjax::ajaxOutput('error', __('Connection error'));
      exit;
    }
    if (!$this->getUser()->isAuthenticated()) {
      echo mgAjax::ajaxOutput('error', __('You need to be logged in.'));
      exit;
    }
    
    $user = $this->getUser()->getGuardUser();
    $party = $user->getProfile()->getParty();
    
    if($party != null){
      foreach($party->getPartyPosts() as $post)
      {
        $post->deleteReplicas();
      }
    }
    $user->delete();
    echo mgAjax::ajaxOutput('success', __('Thank you for useing our site.'));
    exit;
  } 
}
<?php
class authComponents extends sfComponents
{
  public function __construct($context, $moduleName, $actionName) {
    parent::__construct($context, $moduleName, $actionName);
    sfApplicationConfiguration::getActive()->loadHelpers(array('I18N'));
  }
  
  public function executeLogin(sfWebRequest $request)
  {
    if(!mgAjax::isAjax()){ echo mgAjax::ajaxOutput('error', __('Connection error')); exit; }
    
    $this->form = new sfGuardFormSignin();
    $values = $request->getParameter($this->form->getName());
    if($values['submited'])
    {
      $this->form->bind($values);
      if($this->form->isValid())
      {
        $values = $this->form->getValues();
        $remeberMe = false;
        if(isset($values['remember']) && !empty($values['remember'])){
          $remeberMe = true;
        }
        
        $this->getUser()->signin($values['user'], $remeberMe);
        echo mgAjax::ajaxOutput('success', __('You have successfully logged in.')); exit;
      }
    }
  }
  
  public function executeIs_logged_in(sfWebRequest $request)
  {
    if(!mgAjax::isAjax()){ echo mgAjax::ajaxOutput('error', __('Connection error')); exit; }
    if(!$this->getUser()->isAuthenticated()){
      echo '1';
    }
    exit;
  }
  
  public function executeLogout(sfWebRequest $request)
  {
    if(!mgAjax::isAjax()){ echo mgAjax::ajaxOutput('error', __('Connection error')); exit; }

    if($this->getUser()->isAuthenticated())
    {
      $this->getUser()->signout();
    }
    echo mgAjax::ajaxOutput('success', __('You have successfully logged out.')); exit;
    exit;
  }
  
  public function executeRegister(sfWebRequest $request)
  {
    if(!mgAjax::isAjax()){  }
    
    $this->form = new RegisterForm();
    $values = $request->getParameter($this->form->getName());
    if($values['submited'])
    {
      $this->form->bind($values);
      if($this->form->isValid())
      {
        sfGuardUserProfilePeer::registerUser($values);
        
        $remeberMe = true;
        $this->getUser()->signin(sfGuardUserPeer::retrieveByUsername($values['username']), $remeberMe);
        echo mgAjax::ajaxOutput('success', __('You have successfully registered.')); exit;
      }
    }
  }
  
  public function executeIndex(sfWebRequest $request)
  {
    if(!mgAjax::isAjax()){ echo mgAjax::ajaxOutput('error', __('Connection error')); exit; }
  }
  
  public function executeForgot_password(sfWebRequest $request)
  {
    if(!mgAjax::isAjax()){ echo mgAjax::ajaxOutput('error', __('Connection error')); exit; }
    
    $this->form = new ForgotPasswordForm();
    $values = $request->getParameter($this->form->getName());
    if($values['submited'])
    {
      $this->form->bind($values);
      if($this->form->isValid())
      {
        $values = $this->form->getValues();
     
        $password = substr(md5(time() . rand(1000, 9999) . rand(1000, 9999)), 0, 6);
        
        $user = sfGuardUserPeer::retrieveByUsername($values['email']);
        $user->setPassword($password);
        $user->save();
        
        sfGuardUserProfilePeer::sendForgotPasswordEmail($values['email'], $password);
        echo mgAjax::ajaxOutput('success', __('Your new password has been sent to') . $values['email'] . '.'); exit;
      }
    }
  }
  
  public function executeRegister_success(sfWebRequest $request)
  {
    if(!mgAjax::isAjax()){ echo mgAjax::ajaxOutput('error', __('Connection error')); exit; }
    if(!$this->getUser()->isAuthenticated()) { echo mgAjax::ajaxOutput('error', __('Connection error')); exit; }
    
    $this->user = $this->getUser()->getGuardUser();
    
    if($request->getParameter('sent', 0) == 1){
      $this->user->getProfile()->setIsFirstLogin(false);
      $this->user->getProfile()->save();
    }
  }
}
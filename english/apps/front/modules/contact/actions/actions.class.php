<?php
class contactActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->title = __('Contact');
    $response = $this->getResponse();
    $response->setTitle($this->title);

    // Create form object
    $this->form = new ContactForm();

    // Process posted values
    if ($request->isMethod('post'))
    {
      $values = $request->getParameter('contact');

      $this->form->bind($values);

      if ($this->form->isValid())
      {
        sfGuardUserProfilePeer::sendContactEmail($values);
        
        $this->redirect('@contact_success');
      }
    }
  }
  
  public function executeSuccess(sfWebRequest $request)
  {
    $this->title = __('Contact');
    $response = $this->getResponse();
    $response->setTitle($this->title);
  }
}

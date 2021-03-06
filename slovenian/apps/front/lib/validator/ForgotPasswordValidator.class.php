<?php
class ForgotPasswordValidator extends sfValidatorBase
{
  public function configure($options = array(), $messages = array())
  {
    $this->addOption('email', 'email');
    $this->setMessage('invalid', __('User with that email address not exists.'));
  }

  protected function doClean($values)
  {
    // only validate if username and password are both present
    if (isset($values[$this->getOption('email')]))
    {
      $email = $values[$this->getOption('email')];
      if (!($user = sfGuardUserPeer::retrieveByUsername($email)))
      {
        throw new sfValidatorError($this, 'invalid');
        return $values;
      }
    }
    return $values;
  }
}

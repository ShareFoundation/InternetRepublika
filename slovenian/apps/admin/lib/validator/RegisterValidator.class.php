<?php
class RegisterValidator extends sfValidatorBase
{
  public function configure($options = array(), $messages = array())
  {
    $this->addOption('username', 'username');
    $this->addOption('id', 'id');
    $this->setMessage('invalid', 'User with that email allready exists.');
  }

  protected function doClean($values)
  {
    // only validate if username and password are both present
    if (isset($values[$this->getOption('username')]))
    {
      $email = $values[$this->getOption('username')];
      if ($email != '' && $user = sfGuardUserPeer::retrieveByUsername($email))
      {
        if(!empty($values[$this->getOption('id')]) && $values[$this->getOption('id')] == $user->getId()){
          return $values;
        }else{
          throw new sfValidatorError($this, 'invalid');
          return $values;
        }
      }
    }
    return $values;
  }
}

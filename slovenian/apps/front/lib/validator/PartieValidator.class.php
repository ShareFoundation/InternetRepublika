<?php
class PartieValidator extends sfValidatorBase
{
  public function configure($options = array(), $messages = array())
  {
    $this->addOption('name', 'name');
    $this->addOption('id', 'id');
    $this->setMessage('invalid', __('Party with that name already exists.'));
  }

  protected function doClean($values)
  {
    $id = $values[$this->getOption('id')];
    // only validate if username and password are both present
    if (isset($values[$this->getOption('name')]))
    {
      $allParties = PartiePeer::doSelect(new Criteria());
      if(!empty($allParties)){
        foreach($allParties as $party){
          if(trim(strtolower(utf8_decode($values[$this->getOption('name')]))) == trim(strtolower(utf8_decode($party->getName())))){
            if($id != '' & $id == $party->getId()){
            }else{
              throw new sfValidatorError($this, 'invalid');
              return $values;
            }
          }
        }
      }
    }
    return $values;
  }
}

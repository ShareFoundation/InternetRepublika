<?php

/**
 * Menu form.
 *
 * @package    netizbori
 * @subpackage form
 * @author     Your name here
 */
class MenuForm extends BaseMenuForm
{
  public function configure()
  {
    unset($this['language'], $this['created_at'], $this['updated_at']);
    
    $this->validatorSchema['order_position'] = new sfValidatorInteger(array('min' => 0, 'max' => 1000, 'required' => false));
    
    $parentList[NULL] = 'None';
    $parentList = $parentList + MenuPeer::getMenuTree();
    if(!$this->getObject()->isNew()){
      if(isset($parentList[$this->getObject()->getId()])){
        unset($parentList[$this->getObject()->getId()]);
      }
    }
    $this->widgetSchema['parent_id'] = new sfWidgetFormChoice(array('choices' => $parentList));
    $this->validatorSchema['parent_id'] = new sfValidatorChoice(array('multiple' => false, 'choices' => array_keys($parentList), 'required' => false)); //new sfValidatorPropelChoice(array('model' => 'Category', 'required' => false));
  }
}

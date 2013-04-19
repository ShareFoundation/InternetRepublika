<?php

/**
 * Menu filter form.
 *
 * @package    netizbori
 * @subpackage filter
 * @author     Your name here
 */
class MenuFormFilter extends BaseMenuFormFilter
{
  public function configure() {
    unset($this['created_at'], $this['is_target_blank'], $this['updated_at'], $this['order_position'], $this['parent_id'], $this['language'], $this['link']);

    $this->widgetSchema['is_enabled'] = new sfWidgetFormChoice(array('choices' => array('' => 'All', 1 => 'Yes', 0 => 'No')));
    $this->validatorSchema['is_enabled'] = new sfValidatorPass(array('required' => false));
  }

}

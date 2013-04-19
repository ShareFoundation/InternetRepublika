<?php

/**
 * Menu form base class.
 *
 * @method Menu getObject() Returns the current form's model object
 *
 * @package    netizbori
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseMenuForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'title'           => new sfWidgetFormInputText(),
      'link'            => new sfWidgetFormInputText(),
      'order_position'  => new sfWidgetFormInputText(),
      'is_enabled'      => new sfWidgetFormInputCheckbox(),
      'is_target_blank' => new sfWidgetFormInputCheckbox(),
      'parent_id'       => new sfWidgetFormInputText(),
      'language'        => new sfWidgetFormInputText(),
      'created_at'      => new sfWidgetFormDateTime(),
      'updated_at'      => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'title'           => new sfValidatorString(array('max_length' => 255)),
      'link'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'order_position'  => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'is_enabled'      => new sfValidatorBoolean(array('required' => false)),
      'is_target_blank' => new sfValidatorBoolean(array('required' => false)),
      'parent_id'       => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'language'        => new sfValidatorString(array('max_length' => 255)),
      'created_at'      => new sfValidatorDateTime(array('required' => false)),
      'updated_at'      => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('menu[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Menu';
  }


}

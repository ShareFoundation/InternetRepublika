<?php

/**
 * Partie form base class.
 *
 * @method Partie getObject() Returns the current form's model object
 *
 * @package    netizbori
 * @subpackage form
 * @author     Your name here
 */
abstract class BasePartieForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'user_id'        => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => false)),
      'name'           => new sfWidgetFormInputText(),
      'bio'            => new sfWidgetFormTextarea(),
      'logo'           => new sfWidgetFormInputText(),
      'url'            => new sfWidgetFormInputText(),
      'facebook_page'  => new sfWidgetFormTextarea(),
      'total_index'    => new sfWidgetFormInputText(),
      'is_published'   => new sfWidgetFormInputCheckbox(),
      'comments_count' => new sfWidgetFormInputText(),
      'created_at'     => new sfWidgetFormDateTime(),
      'updated_at'     => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'user_id'        => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id')),
      'name'           => new sfValidatorString(array('max_length' => 255)),
      'bio'            => new sfValidatorString(array('max_length' => 1000)),
      'logo'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'url'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'facebook_page'  => new sfValidatorString(array('required' => false)),
      'total_index'    => new sfValidatorNumber(),
      'is_published'   => new sfValidatorBoolean(),
      'comments_count' => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'created_at'     => new sfValidatorDateTime(array('required' => false)),
      'updated_at'     => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('partie[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Partie';
  }


}

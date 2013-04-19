<?php

/**
 * sfGuardUserProfile form base class.
 *
 * @method sfGuardUserProfile getObject() Returns the current form's model object
 *
 * @package    netizbori
 * @subpackage form
 * @author     Your name here
 */
abstract class BasesfGuardUserProfileForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'user_id'            => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => false)),
      'email'              => new sfWidgetFormInputText(),
      'email_hash'         => new sfWidgetFormInputText(),
      'first_name'         => new sfWidgetFormInputText(),
      'last_name'          => new sfWidgetFormInputText(),
      'image_url'          => new sfWidgetFormInputText(),
      'is_email_comfirmed' => new sfWidgetFormInputCheckbox(),
      'last_ip'            => new sfWidgetFormInputText(),
      'is_first_login'     => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'user_id'            => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id')),
      'email'              => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'email_hash'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'first_name'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'last_name'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'image_url'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'is_email_comfirmed' => new sfValidatorBoolean(),
      'last_ip'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'is_first_login'     => new sfValidatorBoolean(),
    ));

    $this->widgetSchema->setNameFormat('sf_guard_user_profile[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfGuardUserProfile';
  }


}

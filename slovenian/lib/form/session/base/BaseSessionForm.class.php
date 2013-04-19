<?php

/**
 * Session form base class.
 *
 * @method Session getObject() Returns the current form's model object
 *
 * @package    netizbori
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseSessionForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'sess_id'   => new sfWidgetFormInputHidden(),
      'sess_data' => new sfWidgetFormTextarea(),
      'sess_time' => new sfWidgetFormInputText(),
      'sess_user' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'sess_id'   => new sfValidatorChoice(array('choices' => array($this->getObject()->getSessId()), 'empty_value' => $this->getObject()->getSessId(), 'required' => false)),
      'sess_data' => new sfValidatorString(array('required' => false)),
      'sess_time' => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'sess_user' => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('session[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Session';
  }


}

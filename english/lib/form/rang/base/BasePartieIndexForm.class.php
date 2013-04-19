<?php

/**
 * PartieIndex form base class.
 *
 * @method PartieIndex getObject() Returns the current form's model object
 *
 * @package    netizbori
 * @subpackage form
 * @author     Your name here
 */
abstract class BasePartieIndexForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'        => new sfWidgetFormInputHidden(),
      'partie_id' => new sfWidgetFormPropelChoice(array('model' => 'Partie', 'add_empty' => false)),
      'daily'     => new sfWidgetFormInputText(),
      'weekly'    => new sfWidgetFormInputText(),
      'total'     => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'        => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'partie_id' => new sfValidatorPropelChoice(array('model' => 'Partie', 'column' => 'id')),
      'daily'     => new sfValidatorNumber(),
      'weekly'    => new sfValidatorNumber(),
      'total'     => new sfValidatorNumber(),
    ));

    $this->widgetSchema->setNameFormat('partie_index[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'PartieIndex';
  }


}

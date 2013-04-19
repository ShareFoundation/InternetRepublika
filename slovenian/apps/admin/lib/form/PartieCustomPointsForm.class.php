<?php

/**
 * PartieCustomPoints form.
 *
 * @package    netizbori
 * @subpackage form
 * @author     Your name here
 */
class PartieCustomPointsForm extends BasePartieCustomPointsForm
{
  public function configure()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'partie_id'  => new sfWidgetFormInputHidden(),
      'user_id'    => new sfWidgetFormInputHidden(),
      'points'     => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'partie_id'  => new sfValidatorPropelChoice(array('model' => 'Partie', 'column' => 'id')),
      'user_id'    => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id')),
      'points'     => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => true)),
    ));
    
    $this->getWidget('points')->setLabel('Add points');

    $this->widgetSchema->setNameFormat('partie_custom_points[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
  }
}

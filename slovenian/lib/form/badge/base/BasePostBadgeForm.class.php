<?php

/**
 * PostBadge form base class.
 *
 * @method PostBadge getObject() Returns the current form's model object
 *
 * @package    netizbori
 * @subpackage form
 * @author     Your name here
 */
abstract class BasePostBadgeForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'       => new sfWidgetFormInputHidden(),
      'badge_id' => new sfWidgetFormPropelChoice(array('model' => 'Badge', 'add_empty' => false)),
      'post_id'  => new sfWidgetFormPropelChoice(array('model' => 'Post', 'add_empty' => false)),
      'user_id'  => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => false)),
      'type_id'  => new sfWidgetFormPropelChoice(array('model' => 'BadgeType', 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'       => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'badge_id' => new sfValidatorPropelChoice(array('model' => 'Badge', 'column' => 'id')),
      'post_id'  => new sfValidatorPropelChoice(array('model' => 'Post', 'column' => 'id')),
      'user_id'  => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id')),
      'type_id'  => new sfValidatorPropelChoice(array('model' => 'BadgeType', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('post_badge[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'PostBadge';
  }


}

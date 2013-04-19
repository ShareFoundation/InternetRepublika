<?php

/**
 * PostBadge filter form base class.
 *
 * @package    netizbori
 * @subpackage filter
 * @author     Your name here
 */
abstract class BasePostBadgeFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'badge_id' => new sfWidgetFormPropelChoice(array('model' => 'Badge', 'add_empty' => true)),
      'post_id'  => new sfWidgetFormPropelChoice(array('model' => 'Post', 'add_empty' => true)),
      'user_id'  => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'type_id'  => new sfWidgetFormPropelChoice(array('model' => 'BadgeType', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'badge_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Badge', 'column' => 'id')),
      'post_id'  => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Post', 'column' => 'id')),
      'user_id'  => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
      'type_id'  => new sfValidatorPropelChoice(array('required' => false, 'model' => 'BadgeType', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('post_badge_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'PostBadge';
  }

  public function getFields()
  {
    return array(
      'id'       => 'Number',
      'badge_id' => 'ForeignKey',
      'post_id'  => 'ForeignKey',
      'user_id'  => 'ForeignKey',
      'type_id'  => 'ForeignKey',
    );
  }
}

<?php

/**
 * Badge filter form.
 *
 * @package    netizbori
 * @subpackage filter
 * @author     Your name here
 */
class BadgeFormFilter extends BaseBadgeFormFilter
{
  public function configure()
  {
    $this->setWidgets(array(
      'type_id'     => new sfWidgetFormPropelChoice(array('model' => 'BadgeType', 'add_empty' => 'All')),
      'name'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'type_id'     => new sfValidatorPropelChoice(array('required' => false, 'model' => 'BadgeType', 'column' => 'id')),
      'name'        => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('badge_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
  }
}

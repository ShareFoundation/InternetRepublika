<?php

/**
 * Badge filter form base class.
 *
 * @package    netizbori
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseBadgeFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'type_id'     => new sfWidgetFormPropelChoice(array('model' => 'BadgeType', 'add_empty' => true)),
      'name'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'description' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'place_count' => new sfWidgetFormFilterInput(),
      'image'       => new sfWidgetFormFilterInput(),
      'style'       => new sfWidgetFormFilterInput(),
      'order'       => new sfWidgetFormFilterInput(),
      'created_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'type_id'     => new sfValidatorPropelChoice(array('required' => false, 'model' => 'BadgeType', 'column' => 'id')),
      'name'        => new sfValidatorPass(array('required' => false)),
      'description' => new sfValidatorPass(array('required' => false)),
      'place_count' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'image'       => new sfValidatorPass(array('required' => false)),
      'style'       => new sfValidatorPass(array('required' => false)),
      'order'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('badge_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Badge';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'type_id'     => 'ForeignKey',
      'name'        => 'Text',
      'description' => 'Text',
      'place_count' => 'Number',
      'image'       => 'Text',
      'style'       => 'Text',
      'order'       => 'Number',
      'created_at'  => 'Date',
      'updated_at'  => 'Date',
    );
  }
}

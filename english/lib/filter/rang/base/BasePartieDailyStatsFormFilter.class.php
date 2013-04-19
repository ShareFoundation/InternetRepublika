<?php

/**
 * PartieDailyStats filter form base class.
 *
 * @package    netizbori
 * @subpackage filter
 * @author     Your name here
 */
abstract class BasePartieDailyStatsFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'partie_id'     => new sfWidgetFormPropelChoice(array('model' => 'Partie', 'add_empty' => true)),
      'like'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'twitt'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'comment'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'badge'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'views'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'current_index' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'partie_id'     => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Partie', 'column' => 'id')),
      'like'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'twitt'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'comment'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'badge'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'views'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'current_index' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'created_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('partie_daily_stats_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'PartieDailyStats';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'partie_id'     => 'ForeignKey',
      'like'          => 'Number',
      'twitt'         => 'Number',
      'comment'       => 'Number',
      'badge'         => 'Number',
      'views'         => 'Number',
      'current_index' => 'Number',
      'created_at'    => 'Date',
    );
  }
}

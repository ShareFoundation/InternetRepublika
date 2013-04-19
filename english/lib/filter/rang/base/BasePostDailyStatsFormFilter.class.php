<?php

/**
 * PostDailyStats filter form base class.
 *
 * @package    netizbori
 * @subpackage filter
 * @author     Your name here
 */
abstract class BasePostDailyStatsFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'post_id'       => new sfWidgetFormPropelChoice(array('model' => 'Post', 'add_empty' => true)),
      'like'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'twitt'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'comment'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'badge'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'views'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'current_index' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'post_id'       => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Post', 'column' => 'id')),
      'like'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'twitt'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'comment'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'badge'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'views'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'current_index' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'created_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('post_daily_stats_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'PostDailyStats';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'post_id'       => 'ForeignKey',
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

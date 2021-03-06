<?php

/**
 * PostPollVote filter form base class.
 *
 * @package    netizbori
 * @subpackage filter
 * @author     Your name here
 */
abstract class BasePostPollVoteFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'post_id'    => new sfWidgetFormPropelChoice(array('model' => 'Post', 'add_empty' => true)),
      'user_id'    => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'answer_id'  => new sfWidgetFormPropelChoice(array('model' => 'PostPollAnswer', 'add_empty' => true)),
      'created_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'post_id'    => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Post', 'column' => 'id')),
      'user_id'    => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
      'answer_id'  => new sfValidatorPropelChoice(array('required' => false, 'model' => 'PostPollAnswer', 'column' => 'id')),
      'created_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('post_poll_vote_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'PostPollVote';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'post_id'    => 'ForeignKey',
      'user_id'    => 'ForeignKey',
      'answer_id'  => 'ForeignKey',
      'created_at' => 'Date',
      'updated_at' => 'Date',
    );
  }
}

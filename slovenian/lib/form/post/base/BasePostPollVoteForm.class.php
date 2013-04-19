<?php

/**
 * PostPollVote form base class.
 *
 * @method PostPollVote getObject() Returns the current form's model object
 *
 * @package    netizbori
 * @subpackage form
 * @author     Your name here
 */
abstract class BasePostPollVoteForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'post_id'    => new sfWidgetFormPropelChoice(array('model' => 'Post', 'add_empty' => false)),
      'user_id'    => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => false)),
      'answer_id'  => new sfWidgetFormPropelChoice(array('model' => 'PostPollAnswer', 'add_empty' => false)),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'post_id'    => new sfValidatorPropelChoice(array('model' => 'Post', 'column' => 'id')),
      'user_id'    => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id')),
      'answer_id'  => new sfValidatorPropelChoice(array('model' => 'PostPollAnswer', 'column' => 'id')),
      'created_at' => new sfValidatorDateTime(array('required' => false)),
      'updated_at' => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('post_poll_vote[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'PostPollVote';
  }


}

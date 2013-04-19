<?php

/**
 * PostPollAnswer filter form base class.
 *
 * @package    netizbori
 * @subpackage filter
 * @author     Your name here
 */
abstract class BasePostPollAnswerFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'post_id' => new sfWidgetFormPropelChoice(array('model' => 'Post', 'add_empty' => true)),
      'answer'  => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'post_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Post', 'column' => 'id')),
      'answer'  => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('post_poll_answer_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'PostPollAnswer';
  }

  public function getFields()
  {
    return array(
      'id'      => 'Number',
      'post_id' => 'ForeignKey',
      'answer'  => 'Text',
    );
  }
}

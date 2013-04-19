<?php

/**
 * PostPollAnswer form base class.
 *
 * @method PostPollAnswer getObject() Returns the current form's model object
 *
 * @package    netizbori
 * @subpackage form
 * @author     Your name here
 */
abstract class BasePostPollAnswerForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'      => new sfWidgetFormInputHidden(),
      'post_id' => new sfWidgetFormPropelChoice(array('model' => 'Post', 'add_empty' => false)),
      'answer'  => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'      => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'post_id' => new sfValidatorPropelChoice(array('model' => 'Post', 'column' => 'id')),
      'answer'  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('post_poll_answer[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'PostPollAnswer';
  }


}

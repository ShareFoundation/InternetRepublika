<?php

/**
 * PostDailyStats form base class.
 *
 * @method PostDailyStats getObject() Returns the current form's model object
 *
 * @package    netizbori
 * @subpackage form
 * @author     Your name here
 */
abstract class BasePostDailyStatsForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'post_id'       => new sfWidgetFormPropelChoice(array('model' => 'Post', 'add_empty' => false)),
      'like'          => new sfWidgetFormInputText(),
      'twitt'         => new sfWidgetFormInputText(),
      'comment'       => new sfWidgetFormInputText(),
      'badge'         => new sfWidgetFormInputText(),
      'views'         => new sfWidgetFormInputText(),
      'current_index' => new sfWidgetFormInputText(),
      'created_at'    => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'post_id'       => new sfValidatorPropelChoice(array('model' => 'Post', 'column' => 'id')),
      'like'          => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'twitt'         => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'comment'       => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'badge'         => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'views'         => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'current_index' => new sfValidatorNumber(),
      'created_at'    => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('post_daily_stats[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'PostDailyStats';
  }


}

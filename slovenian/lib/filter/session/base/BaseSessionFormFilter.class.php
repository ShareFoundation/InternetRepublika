<?php

/**
 * Session filter form base class.
 *
 * @package    netizbori
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseSessionFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'sess_data' => new sfWidgetFormFilterInput(),
      'sess_time' => new sfWidgetFormFilterInput(),
      'sess_user' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'sess_data' => new sfValidatorPass(array('required' => false)),
      'sess_time' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'sess_user' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('session_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Session';
  }

  public function getFields()
  {
    return array(
      'sess_id'   => 'Text',
      'sess_data' => 'Text',
      'sess_time' => 'Number',
      'sess_user' => 'Number',
    );
  }
}

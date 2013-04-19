<?php

/**
 * sfGuardUserProfile filter form base class.
 *
 * @package    netizbori
 * @subpackage filter
 * @author     Your name here
 */
abstract class BasesfGuardUserProfileFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'            => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'email'              => new sfWidgetFormFilterInput(),
      'email_hash'         => new sfWidgetFormFilterInput(),
      'first_name'         => new sfWidgetFormFilterInput(),
      'last_name'          => new sfWidgetFormFilterInput(),
      'image_url'          => new sfWidgetFormFilterInput(),
      'is_email_comfirmed' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'last_ip'            => new sfWidgetFormFilterInput(),
      'is_first_login'     => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'user_id'            => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
      'email'              => new sfValidatorPass(array('required' => false)),
      'email_hash'         => new sfValidatorPass(array('required' => false)),
      'first_name'         => new sfValidatorPass(array('required' => false)),
      'last_name'          => new sfValidatorPass(array('required' => false)),
      'image_url'          => new sfValidatorPass(array('required' => false)),
      'is_email_comfirmed' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'last_ip'            => new sfValidatorPass(array('required' => false)),
      'is_first_login'     => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('sf_guard_user_profile_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfGuardUserProfile';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'user_id'            => 'ForeignKey',
      'email'              => 'Text',
      'email_hash'         => 'Text',
      'first_name'         => 'Text',
      'last_name'          => 'Text',
      'image_url'          => 'Text',
      'is_email_comfirmed' => 'Boolean',
      'last_ip'            => 'Text',
      'is_first_login'     => 'Boolean',
    );
  }
}

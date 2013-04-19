<?php

/**
 * PostIndex filter form base class.
 *
 * @package    netizbori
 * @subpackage filter
 * @author     Your name here
 */
abstract class BasePostIndexFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'post_id' => new sfWidgetFormPropelChoice(array('model' => 'Post', 'add_empty' => true)),
      'daily'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'weekly'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'total'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'post_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Post', 'column' => 'id')),
      'daily'   => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'weekly'  => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'total'   => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('post_index_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'PostIndex';
  }

  public function getFields()
  {
    return array(
      'id'      => 'Number',
      'post_id' => 'ForeignKey',
      'daily'   => 'Number',
      'weekly'  => 'Number',
      'total'   => 'Number',
    );
  }
}

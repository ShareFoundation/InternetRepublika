<?php

/**
 * PartieIndex filter form base class.
 *
 * @package    netizbori
 * @subpackage filter
 * @author     Your name here
 */
abstract class BasePartieIndexFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'partie_id' => new sfWidgetFormPropelChoice(array('model' => 'Partie', 'add_empty' => true)),
      'daily'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'weekly'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'total'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'partie_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Partie', 'column' => 'id')),
      'daily'     => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'weekly'    => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'total'     => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('partie_index_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'PartieIndex';
  }

  public function getFields()
  {
    return array(
      'id'        => 'Number',
      'partie_id' => 'ForeignKey',
      'daily'     => 'Number',
      'weekly'    => 'Number',
      'total'     => 'Number',
    );
  }
}

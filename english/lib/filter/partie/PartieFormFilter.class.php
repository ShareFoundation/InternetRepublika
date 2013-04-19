<?php

/**
 * Partie filter form.
 *
 * @package    netizbori
 * @subpackage filter
 * @author     Your name here
 */
class PartieFormFilter extends BasePartieFormFilter
{
  public function configure()
  {
    $this->setWidgets(array(
      'name'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'bio'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'name'         => new sfValidatorPass(array('required' => false)),
      'bio'          => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('partie_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
  }
}

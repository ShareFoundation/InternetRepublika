<?php

/**
 * Inappropriate form.
 *
 * @package    netizbori
 * @subpackage form
 * @author     Your name here
 */
class InappropriateForm extends BaseInappropriateForm {

  public function configure() {
    $this->setWidgets(array(
        'submited' => new sfWidgetFormInputHidden(),
        'id' => new sfWidgetFormInputHidden(),
        'post_id' => new sfWidgetFormInputHidden(),
        'user_id' => new sfWidgetFormInputHidden(),
        'message' => new sfWidgetFormTextarea(),
        'type' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
        'submited' => new sfValidatorPass(),
        'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
        'post_id' => new sfValidatorPropelChoice(array('model' => 'Post', 'column' => 'id')),
        'user_id' => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id')),
        'message' => new sfValidatorString(array('required' => true, 'max_length' => 500)),
        'type'    => new sfValidatorPass(),
    ));

    $this->widgetSchema->setNameFormat('inappropriate[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->getWidget('submited')->setDefault(1);

    $this->getWidgetSchema()->setLabels(array('message' => __('Poruka')));

    $this->widgetSchema->setFormFormatterName('list');
    $this->widgetSchema->setNameFormat('report[%s]');
    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
  }

}

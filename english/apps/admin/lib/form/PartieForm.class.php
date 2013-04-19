<?php

/**
 * Partie form.
 *
 * @package    netizbori
 * @subpackage form
 * @author     Your name here
 */
class PartieForm extends BasePartieForm {

  public function configure() {
    $this->setWidgets(array(
        'id' => new sfWidgetFormInputHidden(),
        'user_id' => new sfWidgetFormInputHidden(),
        'name' => new sfWidgetFormInputText(),
        'bio' => new sfWidgetFormTextarea(),
        'is_published' => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
        'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
        'user_id' => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id')),
        'name' => new sfValidatorString(array('max_length' => 255)),
        'bio' => new sfValidatorString(array('max_length' => 1000)),
        'is_published' => new sfValidatorBoolean(),
    ));

    $this->widgetSchema->setNameFormat('partie[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
  }

}

<?php

/**
 * PostIndex form base class.
 *
 * @method PostIndex getObject() Returns the current form's model object
 *
 * @package    netizbori
 * @subpackage form
 * @author     Your name here
 */
abstract class BasePostIndexForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'      => new sfWidgetFormInputHidden(),
      'post_id' => new sfWidgetFormPropelChoice(array('model' => 'Post', 'add_empty' => false)),
      'daily'   => new sfWidgetFormInputText(),
      'weekly'  => new sfWidgetFormInputText(),
      'total'   => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'      => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'post_id' => new sfValidatorPropelChoice(array('model' => 'Post', 'column' => 'id')),
      'daily'   => new sfValidatorNumber(),
      'weekly'  => new sfValidatorNumber(),
      'total'   => new sfValidatorNumber(),
    ));

    $this->widgetSchema->setNameFormat('post_index[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'PostIndex';
  }


}

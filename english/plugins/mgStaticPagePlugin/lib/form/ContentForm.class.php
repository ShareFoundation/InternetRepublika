<?php

/**
 * Content form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 */
class ContentForm extends BaseContentForm
{
  public function configure()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'label'        => new sfWidgetFormInputText(),
      'title'        => new sfWidgetFormInputText(),
      'text'         => new sfWidgetFormFCKEditor(array('width' => 760, 'height' => 400)),
      'is_published' => new sfWidgetFormInputCheckbox(),
      'created_at'   => new sfWidgetFormDateTime(),
      'updated_at'   => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'label'        => new sfValidatorString(array('max_length' => 255)),
      'title'        => new sfValidatorString(array('max_length' => 255)),
      'text'         => new sfValidatorString(array('required' => false)),
      'is_published' => new sfValidatorBoolean(array('required' => false)),
      'created_at'   => new sfValidatorDateTime(array('required' => false)),
      'updated_at'   => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'Content', 'column' => array('label')))
    );

    $this->widgetSchema->setNameFormat('content[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
  }
}

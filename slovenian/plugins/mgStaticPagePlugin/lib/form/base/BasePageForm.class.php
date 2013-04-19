<?php

/**
 * Page form base class.
 *
 * @method Page getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 */
abstract class BasePageForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'label'            => new sfWidgetFormInputText(),
      'url'              => new sfWidgetFormInputText(),
      'title'            => new sfWidgetFormInputText(),
      'meta_title'       => new sfWidgetFormInputText(),
      'meta_description' => new sfWidgetFormTextarea(),
      'meta_keywords'    => new sfWidgetFormTextarea(),
      'text'             => new sfWidgetFormTextarea(),
      'is_published'     => new sfWidgetFormInputCheckbox(),
      'created_at'       => new sfWidgetFormDateTime(),
      'updated_at'       => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'label'            => new sfValidatorString(array('max_length' => 255)),
      'url'              => new sfValidatorString(array('max_length' => 255)),
      'title'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'meta_title'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'meta_description' => new sfValidatorString(array('required' => false)),
      'meta_keywords'    => new sfValidatorString(array('required' => false)),
      'text'             => new sfValidatorString(array('required' => false)),
      'is_published'     => new sfValidatorBoolean(array('required' => false)),
      'created_at'       => new sfValidatorDateTime(array('required' => false)),
      'updated_at'       => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorAnd(array(
        new sfValidatorPropelUnique(array('model' => 'Page', 'column' => array('label'))),
        new sfValidatorPropelUnique(array('model' => 'Page', 'column' => array('url'))),
      ))
    );

    $this->widgetSchema->setNameFormat('page[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Page';
  }


}

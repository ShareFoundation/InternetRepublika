<?php

/**
 * News form.
 *
 * @package    netizbori
 * @subpackage form
 * @author     Your name here
 */
class NewsForm extends BaseNewsForm
{
  public function configure()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'title'        => new sfWidgetFormInputText(),
      'text'         => new sfWidgetFormFCKEditor(array('width' => 760, 'height' => 400)),
      'is_published' => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'title'        => new sfValidatorString(array('max_length' => 255)),
      'text'         => new sfValidatorString(),
      'is_published' => new sfValidatorBoolean(),
    ));

    $this->widgetSchema->setNameFormat('news[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
  }
}

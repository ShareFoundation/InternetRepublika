<?php
class PartieForm extends BasePartieForm
{
  public function configure()
  {
    $this->setWidgets(array(
      'submited'    => new sfWidgetFormInputHidden(),
      'id'          => new sfWidgetFormInputHidden(),
      'user_id'     => new sfWidgetFormInputHidden(),
      'name'        => new sfWidgetFormInputText(),
      'bio'         => new sfWidgetFormTextarea(),
      'facebook_page' => new sfWidgetFormInputText(),
      'logo'        => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'submited'    => new sfValidatorPass(),
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'user_id'     => new sfValidatorString(),
      'name'        => new sfValidatorString(array('max_length' => 255)),
      'bio'         => new sfValidatorString(array('max_length' => 1000)),
      'facebook_page'        => new sfValidatorUrl(array('required' => false)),
      'logo'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));
    
    $this->getWidgetSchema()->setLabels(array(
        'name' => __('Name'),
        'bio' => __('Biography'),
        'facebook_page' => __('Enter Facebook fun page URL of your party')
    ));
    
    $this->getWidget('submited')->setDefault(1);
    
    $this->mergePostValidator(new PartieValidator());

    $this->widgetSchema->setNameFormat('partie[%s]');
    
    $this->widgetSchema->setFormFormatterName('list');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
  }
}

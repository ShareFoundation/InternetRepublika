<?php

/**
 * News form.
 *
 * @package    netizbori
 * @subpackage form
 * @author     Your name here
 */
class SettingsSocialNetworksForm extends BaseForm {

  public function setup() {
    $this->setWidgets(array(
        'facebook' => new sfWidgetFormInputText(),
        'twitter' => new sfWidgetFormInputText(),
        'hashtag' => new sfWidgetFormInputText(),
        'youtube' => new sfWidgetFormInputText(),
        'linkedin' => new sfWidgetFormInputText(),
        'instagram' => new sfWidgetFormInputText(),
        'pinterest' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
        'facebook' => new sfValidatorPass(),
        'twitter' => new sfValidatorPass(),
        'hashtag' => new sfValidatorPass(),
        'youtube' => new sfValidatorPass(),
        'linkedin' => new sfValidatorPass(),
        'instagram' => new sfValidatorPass(),
        'pinterest' => new sfValidatorPass(),
    ));

    $this->widgetSchema->setNameFormat('settings_social_networks[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

}

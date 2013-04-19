<?php

/**
 * Install form.
 */
class InstallForm extends BaseForm {

  public function configure() {

    $this->setWidgets(array(
        'site_name' => new sfWidgetFormInput(),
        'email' => new sfWidgetFormInput(),
        'admin' => new sfWidgetFormInput(),
        'password' => new sfWidgetFormInputPassword(array(), array('autocomplete' => 'off')),
    ));

    $this->setValidators(array(
        'site_name' => new sfValidatorString(array('max_length' => 100, 'required' => true)),
        'email' => new sfValidatorEmail(array('max_length' => 255, 'required' => true)),
        'admin' => new sfValidatorString(array('max_length' => 255, 'required' => true)),
        'password' => new sfValidatorString(array('max_length' => 20, 'required' => true)),
    ));

    $this->widgetSchema->setLabels(array(
        'site_name' => 'Site Name',
        'email' => 'Email',
        'admin' => 'Admin',
        'password' => 'Password',
    ));

    $this->widgetSchema->setNameFormat('contact[%s]');
    $this->widgetSchema->setFormFormatterName('list');
  }

}

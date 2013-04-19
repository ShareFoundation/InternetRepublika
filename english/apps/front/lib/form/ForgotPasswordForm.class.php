<?php

class ForgotPasswordForm extends BaseForm {

  public function configure() {
    $this->setWidgets(array(
        'submited'          => new sfWidgetFormInputHidden(),
        'email'             => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
        'submited'          => new sfValidatorPass(),
        'email'             => new sfValidatorEmail(array(), array('invalid' => __('Email address is not valid.'))),
    ));

    $this->getWidgetSchema()->setLabels(array(
        'email'               => __('Email'),
    ));

    $this->getWidget('submited')->setDefault(1);
    
    $this->mergePostValidator(new ForgotPasswordValidator());
    
    $this->widgetSchema->setFormFormatterName('list');
    $this->widgetSchema->setNameFormat('forgot_password[%s]');
  }

}

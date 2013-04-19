<?php

class ProfileForm extends BaseForm {

  public function configure() {
    $this->setWidgets(array(
        'submited'          => new sfWidgetFormInputHidden(),
        'first_name'        => new sfWidgetFormInput(),
        'last_name'         => new sfWidgetFormInput(),
        'username'          => new sfWidgetFormInput(array(), array('readonly' => 'readonly', 'disabled' => 'disabled')),
        'email'             => new sfWidgetFormInput(),
        'password'          => new sfWidgetFormInput(array('type' => 'password')),
        'confirm_password'  => new sfWidgetFormInput(array('type' => 'password')),
    ));

    $this->setValidators(array(
        'submited'          => new sfValidatorPass(),
        'first_name'        => new sfValidatorString(array('required' => false)),
        'last_name'         => new sfValidatorString(array('required' => false)),
        'username'          => new sfValidatorString(),
        'email'             => new sfValidatorEmail(array(), array('invalid' => 'Email adresa nije ispravna.')),
        'password'          => new sfValidatorString(array('required' => false)),
        'confirm_password'  => new sfValidatorString(array('required' => false)),
    ));

    
    $this->getWidgetSchema()->setLabels(array(
        'first_name'          => __('First Name'),
        'last_name'           => __('Last Name'),
        'username'            => __('Username'),
        'email'               => __('Email'),
        'password'            => __('Password'),
        'confirm_password'    => __('Confirm Password'),
        'remember'            => __('Remember me')
    ));

    $this->getWidget('submited')->setDefault(1);
    
    $this->validatorSchema->setPostValidator(new sfValidatorSchemaCompare('password', sfValidatorSchemaCompare::EQUAL, 'confirm_password', array(), array('invalid' => __('Passwords did not match.'))));
    
    $this->widgetSchema->setFormFormatterName('list');
    $this->widgetSchema->setNameFormat('profile[%s]');
  }
}
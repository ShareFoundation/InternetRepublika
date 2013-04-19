<?php

class RegisterForm extends BaseForm {

    public function configure() {
        $this->setWidgets(array(
            'submited' => new sfWidgetFormInputHidden(),
            'username' => new sfWidgetFormInput(),
            'password' => new sfWidgetFormInput(array('type' => 'password')),
            'confirm_password' => new sfWidgetFormInput(array('type' => 'password')),
        ));

        $this->setValidators(array(
            'submited' => new sfValidatorPass(),
            'username' => new sfValidatorString(),
            'password' => new sfValidatorString(),
            'confirm_password' => new sfValidatorString(),
        ));

        $this->getWidgetSchema()->setLabels(array(
            'username' => __('Username'),
            'password' => __('Password'),
            'confirm_password' => __('Confirm Password'),
            'remember' => __('Remember me')
        ));

        $this->getWidget('submited')->setDefault(1);

        $this->validatorSchema->setPostValidator(new sfValidatorSchemaCompare('password', sfValidatorSchemaCompare::EQUAL, 'confirm_password', array(), array('invalid' => __('Passwords did not match.'))));
        $this->mergePostValidator(new RegisterValidator());

        $this->widgetSchema->setFormFormatterName('list');
        $this->widgetSchema->setNameFormat('signin[%s]');
    }

}

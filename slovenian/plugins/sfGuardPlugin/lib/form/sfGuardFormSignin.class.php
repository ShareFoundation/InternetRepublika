<?php

class sfGuardFormSignin extends BasesfGuardFormSignin
{
  public function configure()
  {
    $this->setWidgets(array(
      'submited' => new sfWidgetFormInputHidden(),
      'username' => new sfWidgetFormInput(),
      'password' => new sfWidgetFormInput(array('type' => 'password')),
      'remember' => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'submited' => new sfValidatorPass(),
      'username' => new sfValidatorString(),
      'password' => new sfValidatorString(),
      'remember' => new sfValidatorBoolean(),
    ));
    
    $this->getWidgetSchema()->setLabels(array(
        'username'    => __('Username'),
        'password'    => __('Password'),
        'remember'    => __('Remember me')
    ));
    
    $this->getWidget('submited')->setDefault(1);

    $this->widgetSchema->setFormFormatterName('list');
    
    $this->validatorSchema->setPostValidator(new sfGuardValidatorUser());

    $this->widgetSchema->setNameFormat('signin[%s]');
  }
}

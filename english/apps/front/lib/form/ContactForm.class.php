<?php

/**
 * Contact form.
 */
class ContactForm extends BaseForm
{

  public function configure()
  {

    $this->setWidgets(array(
      'name'        => new sfWidgetFormInput(),
      'email'       => new sfWidgetFormInput(),
      'subject'     => new sfWidgetFormInput(),
      'message'     => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'name'        => new sfValidatorString(array('max_length' => 100, 'required' => true)),
      'email'       => new sfValidatorEmail(array('max_length' => 255, 'required' => true)),
      'subject'     => new sfValidatorString(array('max_length' => 255, 'required' => true)),
      'message'     => new sfValidatorString(array('max_length' => 1000, 'required' => true)),
    ));

    $this->widgetSchema->setLabels(array(
      'name'        => __('Name'),
      'email'       => __('Email'),
      'subject'     => __('Subject'),
      'message'     => __('Message'),
    ));

    $this->widgetSchema->setNameFormat('contact[%s]');
    $this->widgetSchema->setFormFormatterName('list');
  }
}

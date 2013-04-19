<?php

/**
 * Newsletter form.
 *
 * @package    netizbori
 * @subpackage form
 * @author     Your name here
 */
class NewsletterForm extends BaseNewsletterForm
{
  public function configure()
  {
    $this->setWidgets(array(
      'email'         => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'email'         => new sfValidatorEmail(array('max_length' => 255)),
    ));

    $this->widgetSchema->setNameFormat('newsletter[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
  }
}

<?php

/**
 * Project form base class.
 *
 * @package    netizbori
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseFormPropel extends sfFormPropel {

  public function setup() {
    sfValidatorBase::setDefaultMessage('required', __('This field is required.'));
    sfValidatorBase::setDefaultMessage('invalid', __('Field is invalid.'));
    sfValidatorBase::setDefaultMessage('max_length', __('Max length %max_length%'));
    sfValidatorBase::setDefaultMessage('min_length', __('Min length %max_length%'));
  }

}

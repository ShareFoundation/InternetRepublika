<?php

/**
 * Base project form.
 * 
 * @package    netizbori
 * @subpackage form
 * @author     Your name here 
 * @version    SVN: $Id: BaseForm.class.php 20147 2009-07-13 11:46:57Z FabianLange $
 */
sfApplicationConfiguration::getActive()->loadHelpers(array('I18N'));

class BaseForm extends sfFormSymfony {

  public function setup() {
    sfValidatorBase::setDefaultMessage('required', __('This field is required.'));
    sfValidatorBase::setDefaultMessage('invalid', __('Field is invalid.'));
    sfValidatorBase::setDefaultMessage('max_length', __('Max length %max_length%'));
    sfValidatorBase::setDefaultMessage('min_length', __('Min length %max_length%'));
  }

}

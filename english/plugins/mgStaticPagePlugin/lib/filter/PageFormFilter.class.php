<?php

/**
 * Page filter form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage filter
 * @author     ##AUTHOR_NAME##
 */
class PageFormFilter extends BasePageFormFilter
{
  public function configure()
  {
    $this->setWidgets(array(
      'label'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'url'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'title'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'is_published'     => new sfWidgetFormChoice(array('choices' => array('' => 'All', 1 => 'Yes', 0 => 'No'))),
    ));

    $this->setValidators(array(
      'label'            => new sfValidatorPass(array('required' => false)),
      'url'              => new sfValidatorPass(array('required' => false)),
      'title'            => new sfValidatorPass(array('required' => false)),
      'text'             => new sfValidatorPass(array('required' => false)),
      'is_published'     => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('page_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
  }
}

<?php

/**
 * sfGuardUser filter form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage filter
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfGuardUserFormFilter.class.php 12896 2008-11-10 19:02:34Z fabien $
 */
class sfGuardUserFormFilter extends BasesfGuardUserFormFilter
{
  public function configure()
  {
    $this->setWidgets(array(
      'username'                      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'first_name'                      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'last_name'                      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'is_active'                     => new sfWidgetFormChoice(array('choices' => array('' => 'All', 1 => 'Yes', 0 => 'No'))),
      'is_super_admin'                => new sfWidgetFormChoice(array('choices' => array('' => 'All', 1 => 'Yes', 0 => 'No'))),
    ));

    $this->setValidators(array(
      'username'                      => new sfValidatorPass(array('required' => false)),
      'first_name'                    => new sfValidatorPass(array('required' => false)),
      'last_name'                     => new sfValidatorPass(array('required' => false)),  
      'is_active'                     => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'is_super_admin'                => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('sf_guard_user_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
  }
  
  public function addFirstNameColumnCriteria(Criteria $c, $values, $value)
  {
    $c->addJoin(sfGuardUserPeer::ID, sfGuardUserProfilePeer::USER_ID, Criteria::LEFT_JOIN);
    $c->add(sfGuardUserProfilePeer::FIRST_NAME, '%' . $value['text'] . '%', Criteria::LIKE);
    return $c;
  }
  public function addLastNameColumnCriteria(Criteria $c, $values, $value)
  {
    $c->addJoin(sfGuardUserPeer::ID, sfGuardUserProfilePeer::USER_ID, Criteria::LEFT_JOIN);
    $c->add(sfGuardUserProfilePeer::LAST_NAME, '%' . $value['text']. '%', Criteria::LIKE);
    return $c;
  }

}

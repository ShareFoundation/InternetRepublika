<?php

/**
 * Inappropriate filter form.
 *
 * @package    netizbori
 * @subpackage filter
 * @author     Your name here
 */
class InappropriateFormFilter extends BaseInappropriateFormFilter
{
  public function configure()
  {
    $this->setWidgets(array(
      'post_name'    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'post_name'    => new sfValidatorPass(),
    ));
    $this->widgetSchema->setNameFormat('inappropriate_filters[%s]');
    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
  }
  
  public function addPostNameColumnCriteria($criteria, $field, $value){
    $val = '';
    if(isset($value['text']) && !empty($value['text'])){
      $criteria->addJoin(InappropriatePeer::POST_ID, PostPeer::ID);
      $criteria->addAnd(PostPeer::TITLE, '%' . $value['text'] . '%', Criteria::LIKE);
    }
    return $criteria;
  }
}

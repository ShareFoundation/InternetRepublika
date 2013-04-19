<?php

require_once dirname(__FILE__).'/../lib/flagGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/flagGeneratorHelper.class.php';

/**
 * flag actions.
 *
 * @package    netizbori
 * @subpackage flag
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class flagActions extends autoFlagActions
{
  protected function buildCriteria()
  {
    if (null === $this->filters)
    {
      $this->filters = $this->configuration->getFilterForm($this->getFilters());
    }

    $criteria = $this->filters->buildCriteria($this->getFilters());

    $this->addSortCriteria($criteria);

    $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_criteria'), $criteria);
    $criteria = $event->getReturnValue();
    $c = new Criteria();
    
    $criteria->addGroupByColumn(InappropriatePeer::POST_ID);

    return $criteria;
  }
  
  public function executeView(sfWebRequest $request)
  {
    $flag = InappropriatePeer::retrieveByPK($request->getParameter('id'));
    $this->redirect('flag_view/index?post_id=' . $flag->getPostId());
  }
}

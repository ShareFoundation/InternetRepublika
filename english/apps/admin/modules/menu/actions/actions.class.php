<?php

require_once dirname(__FILE__).'/../lib/menuGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/menuGeneratorHelper.class.php';

/**
 * menu actions.
 *
 * @package    netizbori
 * @subpackage menu
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class menuActions extends autoMenuActions
{
  protected function buildCriteria()
  {
    if (null === $this->filters)
    {
      $this->filters = $this->configuration->getFilterForm($this->getFilters());
    }
    
    $criteria = $this->filters->buildCriteria($this->getFilters());
    
    $parent = $this->getRequest()->getParameter('parent_id', 'not');
    
    if($parent != 'not'){
      $this->getUser()->setAttribute('filter_parent', $parent);
    }else{
      $parent = $this->getUser()->getAttribute('filter_parent', null);
    }
    
    if($parent){
      $criteria->add(MenuPeer::PARENT_ID, $parent);
    }else{
      $criteria->add(MenuPeer::PARENT_ID, NULL);
    }

    $this->addSortCriteria($criteria);

    $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_criteria'), $criteria);
    $criteria = $event->getReturnValue();

    return $criteria;
  }
}

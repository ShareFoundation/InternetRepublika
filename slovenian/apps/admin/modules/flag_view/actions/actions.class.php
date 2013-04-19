<?php

require_once dirname(__FILE__).'/../lib/flag_viewGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/flag_viewGeneratorHelper.class.php';

/**
 * flag_view actions.
 *
 * @package    netizbori
 * @subpackage flag_view
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class flag_viewActions extends autoFlag_viewActions
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
    
    $postId = $this->getRequest()->getParameter('post_id', null);
    if($postId == null && $this->getUser()->getAttribute('postId', null) == null){
      $this->redirect('flag/index');
    }else{
      if($postId != null){
        $this->getUser()->setAttribute('postId', $postId); 
      }
      $criteria->add(InappropriatePeer::POST_ID, $this->getUser()->getAttribute('postId', null));  
    }
    return $criteria;
  }
  
  public function executeBack(sfWebRequest $request)
  {
    $flag = InappropriatePeer::retrieveByPK($request->getParameter('id'));
    $this->redirect('flag/index');
  }
  
  public function executeView(sfWebRequest $request)
  {
    $flag = InappropriatePeer::retrieveByPK($request->getParameter('id'));
    $this->redirect('/stav/' . $flag->getPost()->getUrl());
  }
}

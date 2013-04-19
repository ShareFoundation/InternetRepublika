<?php

require_once dirname(__FILE__).'/../lib/partyGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/partyGeneratorHelper.class.php';

/**
 * party actions.
 *
 * @package    netizbori
 * @subpackage party
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class partyActions extends autoPartyActions
{
  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));

    $partie = $this->getRoute()->getObject();
    foreach($partie->getPartyPosts() as $post)
    {
      $post->deleteReplicas();
    }
    $partie->delete();
    

    $this->getUser()->setFlash('notice', 'The item was deleted successfully.');

    $this->redirect('@partie');
  }
  
  protected function executeBatchDelete(sfWebRequest $request)
  {
    $ids = $request->getParameter('ids');

    $count = 0;
    foreach (PartiePeer::retrieveByPks($ids) as $object)
    {
      $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $object)));

        $partie = $object;
        foreach($partie->getPartyPosts() as $post)
        {
          $post->deleteReplicas();
        }
        $partie->delete();
      if ($object->isDeleted())
      {
        $count++;
      }
    }

    if ($count >= count($ids))
    {
      $this->getUser()->setFlash('notice', 'The selected items have been deleted successfully.');
    }
    else
    {
      $this->getUser()->setFlash('error', 'A problem occurs when deleting the selected items.');
    }

    $this->redirect('@partie');
  }
  
  public function executeCustom_points(sfWebRequest $request)
  {
    $this->forward404Unless($this->party = PartiePeer::retrieveByPK($request->getParameter('id')));
    $this->logList = $this->party->getPartieCustomPointsLog();
    $this->form = new PartieCustomPointsForm();
    
    if($request->isMethod('post')){
      $values = $request->getParameter($this->form->getName());
      $this->form->bind($values);
      if($this->form->isValid()){
        $this->form->save();
        $this->party->calculateIndexes();
        $this->getUser()->setFlash('notice', 'You have successfully added points to party.');
        $this->redirect('party/custom_points?id=' . $this->party->getId());
      }
    }else{
      $this->form->setDefault('partie_id', $this->party->getId());
      $this->form->setDefault('user_id', $this->getUser()->getGuardUser()->getId());
      $this->form->setDefault('points', '');
    }
  }
}

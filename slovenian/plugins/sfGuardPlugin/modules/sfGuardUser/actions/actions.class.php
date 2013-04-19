<?php

require_once dirname(__FILE__) . '/../lib/BasesfGuardUserActions.class.php';

/**
 * sfGuardUser actions.
 *
 * @package    sfGuardPlugin
 * @subpackage sfGuardUser
 * @author     Fabien Potencier
 * @version    SVN: $Id: actions.class.php 12965 2008-11-13 06:02:38Z fabien $
 */
class sfGuardUserActions extends basesfGuardUserActions {

  public function executeIndex(sfWebRequest $request) {
    // sorting
    //if ($request->getParameter('sort') && $this->isValidSortColumn($request->getParameter('sort')))
    //{
    $this->setSort(array($request->getParameter('sort'), $request->getParameter('sort_type')));
    //}
    // pager
    if ($request->getParameter('page')) {
      $this->setPage($request->getParameter('page'));
    }

    $this->pager = $this->getPager();
    $this->sort = $this->getSort();
  }

  protected function addSortCriteria($criteria) {
    $criteria->addJoin(sfGuardUserPeer::ID, sfGuardUserProfilePeer::USER_ID, Criteria::LEFT_JOIN);

    if (array(null, null) == ($sort = $this->getSort())) {
      return;
    }

    $column = $sort[0]; //sfGuardUserPeer::translateFieldName($sort[0], BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_COLNAME);
    $criteria->addSelectColumn('sf_guard_user.*');
    $criteria->addSelectColumn('sf_guard_user_profile.*');
    if ($sort[0] == 'register_type') {
      $criteria->addAsColumn('register_type_main', 'IF(sf_guard_user_profile.facebook_id IS NOT NULL AND sf_guard_user_profile.facebook_id <> "", 1,  IF(sf_guard_user_profile.twitter_id IS NOT NULL AND sf_guard_user_profile.twitter_id <> "", 2, 3))');
      $column = 'register_type_main';
    }
    if ('asc' == $sort[1]) {
      $criteria->addAscendingOrderByColumn($column);
    } else {
      $criteria->addDescendingOrderByColumn($column);
    }
  }

  public function executeDelete(sfWebRequest $request) {
    $request->checkCSRFProtection();

    $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));

    $user = $this->getRoute()->getObject();
    $party = $user->getProfile()->getParty();
    if ($party != null) {
      foreach ($party->getPartyPosts() as $post) {
        $post->deleteReplicas();
      }
    }
    $user->delete();

    $this->getUser()->setFlash('notice', 'The item was deleted successfully.');

    $this->redirect('@sf_guard_user');
  }

  protected function executeBatchDelete(sfWebRequest $request) {
    $ids = $request->getParameter('ids');

    $count = 0;
    foreach (sfGuardUserPeer::retrieveByPks($ids) as $object) {
      $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $object)));

      $user = $object;
      $party = $user->getProfile()->getParty();
      if ($party != null) {
        foreach ($party->getPartyPosts() as $post) {
          $post->deleteReplicas();
        }
      }
      $user->delete();

      if ($object->isDeleted()) {
        $count++;
      }
    }

    if ($count >= count($ids)) {
      $this->getUser()->setFlash('notice', 'The selected items have been deleted successfully.');
    } else {
      $this->getUser()->setFlash('error', 'A problem occurs when deleting the selected items.');
    }

    $this->redirect('@sf_guard_user');
  }

}

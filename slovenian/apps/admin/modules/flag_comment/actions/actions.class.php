<?php

require_once dirname(__FILE__) . '/../lib/flag_commentGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/flag_commentGeneratorHelper.class.php';

/**
 * flag_comment actions.
 *
 * @package    netizbori
 * @subpackage flag_comment
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class flag_commentActions extends autoFlag_commentActions {

  protected function isValidSortColumn($column) {
    return parent::isValidSortColumn($column) || $column == 'comment' || $column == 'count';
  }

  protected function addSortCriteria($criteria) {
    if (array(null, null) == ($sort = $this->getSort())) {
      return;
    }

    switch ($sort[0]) {
      case 'comment':
        $column = CommentPeer::TEXT;
        break;
      
      case 'count':
        $column = 'total_count';
        
        
        $criteria = new Criteria();
        $criteria->addAsColumn('total_count', 'SUM(' . InappropriateCommentPeer::COMMENT_ID . ')');
        //$criteria->addSelectColumn('1 as total_count');
        
        
        break;

      default:
        $column = InappropriateCommentPeer::translateFieldName($sort[0], BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_COLNAME);
        break;
    }
    if ('asc' == $sort[1]) {
      $criteria->addAscendingOrderByColumn($column);
    } else {
      $criteria->addDescendingOrderByColumn($column);
    }
  }

  protected function buildCriteria() {
    if (null === $this->filters) {
      $this->filters = $this->configuration->getFilterForm($this->getFilters());
    }

    $criteria = $this->filters->buildCriteria($this->getFilters());

    $this->addSortCriteria($criteria);

    $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_criteria'), $criteria);
    $criteria = $event->getReturnValue();

    $criteria->addGroupByColumn(InappropriateCommentPeer::COMMENT_ID);

    return $criteria;
  }
  
  public function executeListDelete(sfWebRequest $request){
    $this->forward404Unless($comment = CommentPeer::retrieveByPK($request->getParameter('id', null)));
    $comment->delete();
    $this->redirect('flag_comment/index');
  }
  

}

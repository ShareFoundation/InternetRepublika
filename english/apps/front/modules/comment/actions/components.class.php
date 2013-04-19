<?php

/**
 * comment actions.
 *
 * @package    netizbori
 * @subpackage comment
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class commentComponents extends sfComponents
{
  
  public function executeComment(sfWebRequest $request){
    
  }
  
  public function executeComment_list(sfWebRequest $request){
    $this->id = $request->getParameter('id', $this->id);
    $this->type = $request->getParameter('type', $this->type);
    $this->commentsList = CommentPeer::getComments($this->id, $this->type);
  }
  
  public function executeAdd_comment(sfWebRequest $request){
    $this->id = $request->getParameter('id', $this->id);
    $this->type = $request->getParameter('type', $this->type);
    $this->name = $request->getParameter('name','');
    $this->comment = $request->getParameter('comment','');
    $this->parentId = $request->getParameter('parent_id', null);
    
    if(empty($this->comment)){
      echo 'error';
      exit;
    }else{
      CommentPeer::addComment($this->id, $this->type, $this->comment, $this->name, $this->parentId);
      echo 'success';
      exit;
    }
    
  }
  
  public function executeFlag_comment(sfWebRequest $request){
    $this->id = $request->getParameter('id', $this->id);

    if(empty($this->id)){
      echo 'error';
      exit;
    }else{
      $flag = new InappropriateComment();
      $flag->setCommentId($this->id);
      $flag->setUserId($this->getUser()->getGuardUser()->getId());
      $flag->save();
      echo 'success';
      exit;
    }
  }
  
  public function executeDelete_comment(sfWebRequest $request){
    $this->id = $request->getParameter('id', $this->id);

    if(empty($this->id)){
      echo 'error';
      exit;
    }else{
      $comment = CommentPeer::retrieveByPK($this->id);
      $comment->delete();
      echo 'success';
      exit;
    }
  }
  
}

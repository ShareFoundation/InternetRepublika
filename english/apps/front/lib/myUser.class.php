<?php
class myUser extends sfGuardSecurityUser
{
  public function canEditParty($partyUserId)
  {
    if($this->isAuthenticated() && $this->getGuardUser()->getId() == $partyUserId)
    {
      return true;
    }
    return false;
  }
  
  public function canVoteOnPoll($pollId)
  {
    if($this->isAuthenticated()) {
      $c = new Criteria();
      $c->add(PostPollVotePeer::USER_ID, $this->getGuardUser()->getId());
      $c->add(PostPollVotePeer::POST_ID, $pollId);
      return !(bool)PostPollVotePeer::doCount($c);
    }
    return false;
  }
}

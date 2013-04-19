<?php
class postsActions extends sfActions
{
  public function preExecute() {
    parent::preExecute();
    sfApplicationConfiguration::getActive()->loadHelpers(array('I18N'));
  }
  
  public function executeIndex(sfWebRequest $request)
  {
    $this->title = ConfigurationPeer::get('site_name');
    $this->getResponse()->setTitle($this->title);
    
    // Setup products filter
    $filters = array(
        'categories' => array(),  // all categories
        'badge'      => array(),  // all badges
        'type'       => array(),  // text, photo, video, quote, link, poll
        'interval'   => array(3)  // daily, weekly, all_time
    );
    
    $sorts = array('sort' => 'popular');
    
    
    $this->getUser()->setAttribute('filters', $filters);
    $this->getUser()->setAttribute('sorts', $sorts);
  }
  
  public function executeView(sfWebRequest $request)
  {
    $this->forward404Unless($this->post = PostPeer::retrieveByUrl($request->getParameter('url')));
    $this->title = __('Post') . ': ' . $this->post->getTitle();
    $this->getResponse()->setTitle($this->title);
    $this->post->storeView();
  }
}
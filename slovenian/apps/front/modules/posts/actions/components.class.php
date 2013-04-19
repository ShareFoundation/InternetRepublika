<?php

class postsComponents extends sfComponents {
  
  public function __construct($context, $moduleName, $actionName) {
    parent::__construct($context, $moduleName, $actionName);
    sfApplicationConfiguration::getActive()->loadHelpers(array('mgUrlContent', 'mgSimpleHtmlDom'));
    sfApplicationConfiguration::getActive()->loadHelpers(array('I18N'));
  }
  
  public function executeCreate_post_index(sfWebRequest $request) {
    $replicaPost = PostPeer::retrieveByPK($request->getParameter('replica_id', null));
    if (!empty($replicaPost)) {
      $this->getUser()->setAttribute('replicaPost', $replicaPost);
    } else {
      $this->getUser()->setAttribute('replicaPost', null);
    }

    $this->editPost = PostPeer::retrieveByPK($request->getParameter('post_id', null));
    if (!empty($this->editPost)) {
      $this->getUser()->setAttribute('editPost', $this->editPost);
    } else {
      $this->getUser()->setAttribute('editPost', null);
    }
  }

  public function executeCreate_post_text(sfWebRequest $request) {
    if (!mgAjax::isAjax()) {
      echo mgAjax::ajaxOutput('error', __('Connection error'));
      exit;
    }
    if (!$this->getUser()->isAuthenticated()) {
      echo mgAjax::ajaxOutput('error', __('You need to be logged in.'));
      exit;
    }

    $post = $this->getUser()->getAttribute('editPost', null);
    if ($post != null) {
      $party = $this->getUser()->getGuardUser()->getProfile()->getParty();
      if (($party != null && $post->getPartieId() == $party->getId()) || $this->getUser()->getGuardUser()->getIsSuperAdmin()) {
        $this->form = new PostTextForm($post);
      } else {
        echo '<h1>' . __('Connection error') . '</h1>';
        exit;
      }
    } else {
      $this->form = new PostTextForm();
    }

    $values = $request->getParameter($this->form->getName());
    if ($values['submited']) {
      $user = $this->getUser()->getGuardUser();
      $profile = $user->getProfile();

      if (!$profile->getParty() && !$this->getUser()->getGuardUser()->getIsSuperAdmin()) {
        echo mgAjax::ajaxOutput('error', __('You need to be logged in.'));
        exit;
      }

      if(!(isset($values['partie_id']) && !empty($values['partie_id']))){
        $values['partie_id'] = $profile->getParty()->getId();
      }
      $values['type'] = PostPeer::TYPE_TEXT;
      $this->form->bind($values);
      if ($this->form->isValid()) {
        $values = $this->form->getValues();

        $this->post = $this->form->save();

        if ($this->getUser()->getAttribute('editPost', null) == null) {
          $this->post->storeReplicaPost();
        }

        echo mgAjax::ajaxOutput('success', __('You have successfully ') . ($this->getUser()->getAttribute('editPost', null) == null ? __('created new') : __('edited')) . ' ' . __('post') . '.', array('url' => $this->post->getLink()));
        exit;
      }
    }
  }

  public function executeCreate_post_photo(sfWebRequest $request) {
    if (!mgAjax::isAjax()) {
      echo mgAjax::ajaxOutput('error', __('Connection error'));
      exit;
    }
    if (!$this->getUser()->isAuthenticated()) {
      echo mgAjax::ajaxOutput('error', __('You need to be logged in.'));
      exit;
    }

    $post = $this->getUser()->getAttribute('editPost', null);
    if ($post != null) {
      $party = $this->getUser()->getGuardUser()->getProfile()->getParty();
      if (($party != null && $post->getPartieId() == $party->getId()) || $this->getUser()->getGuardUser()->getIsSuperAdmin()) {
        $this->form = new PostPhotoForm($post);
      } else {
        echo '<h1>' . __('Connection error') . '</h1>';
        exit;
      }
    } else {
      $this->form = new PostPhotoForm();
    }

    $values = $request->getParameter($this->form->getName());
    if ($values['submited']) {
      $user = $this->getUser()->getGuardUser();
      $profile = $user->getProfile();

      if (!$profile->getParty() && !$this->getUser()->getGuardUser()->getIsSuperAdmin()) {
        echo mgAjax::ajaxOutput('error', __('You need to be logged in.'));
        exit;
      }

      if(!(isset($values['partie_id']) && !empty($values['partie_id']))){
        $values['partie_id'] = $profile->getParty()->getId();
      }
      $values['type'] = PostPeer::TYPE_PHOTO;
      $this->form->bind($values);
      if ($this->form->isValid()) {
        $values = $this->form->getValues();
        $this->post = $this->form->save();

        if ($this->getUser()->getAttribute('editPost', null) == null) {
          $this->post->storeReplicaPost();
        }

        echo mgAjax::ajaxOutput('success', __('You have successfully ') . ($this->getUser()->getAttribute('editPost', null) == null ? __('created new') : __('edited')) . ' ' . __('post') . '.', array('url' => $this->post->getLink()));
        exit;
      }
    }
  }

  public function executeCreate_post_quote(sfWebRequest $request) {
    if (!mgAjax::isAjax()) {
      echo mgAjax::ajaxOutput('error', __('Connection error'));
      exit;
    }
    if (!$this->getUser()->isAuthenticated()) {
      echo mgAjax::ajaxOutput('error', __('You need to be logged in.'));
      exit;
    }

    $post = $this->getUser()->getAttribute('editPost', null);
    if ($post != null) {
      $party = $this->getUser()->getGuardUser()->getProfile()->getParty();
      if (($party != null && $post->getPartieId() == $party->getId()) || $this->getUser()->getGuardUser()->getIsSuperAdmin()) {
        $this->form = new PostQuoteForm($post);
      } else {
        echo '<h1>' . __('Connection error') . '</h1>';
        exit;
      }
    } else {
      $this->form = new PostQuoteForm();
    }

    $values = $request->getParameter($this->form->getName());
    if ($values['submited']) {
      $user = $this->getUser()->getGuardUser();
      $profile = $user->getProfile();

      if (!$profile->getParty() && !$this->getUser()->getGuardUser()->getIsSuperAdmin()) {
        echo mgAjax::ajaxOutput('error', __('You need to be logged in.'));
        exit;
      }
      
      if(!(isset($values['partie_id']) && !empty($values['partie_id']))){
        $values['partie_id'] = $profile->getParty()->getId();
      }
      
      $values['type'] = PostPeer::TYPE_QUOTE;
      $this->form->bind($values);
      if ($this->form->isValid()) {
        $values = $this->form->getValues();
        $this->post = $this->form->save();

        if ($this->getUser()->getAttribute('editPost', null) == null) {
          $this->post->storeReplicaPost();
        }

        echo mgAjax::ajaxOutput('success', __('You have successfully ') . ($this->getUser()->getAttribute('editPost', null) == null ? __('created new') : __('edited')) . ' ' . __('post') . '.', array('url' => $this->post->getLink()));
        exit;
      }
    }
  }

  public function executeCreate_post_link(sfWebRequest $request) {
    if (!mgAjax::isAjax()) {
      echo mgAjax::ajaxOutput('error', __('Connection error'));
      exit;
    }
    if (!$this->getUser()->isAuthenticated()) {
      echo mgAjax::ajaxOutput('error', __('You need to be logged in.'));
      exit;
    }

    $post = $this->getUser()->getAttribute('editPost', null);
    if ($post != null) {
      $party = $this->getUser()->getGuardUser()->getProfile()->getParty();
      if (($party != null && $post->getPartieId() == $party->getId()) || $this->getUser()->getGuardUser()->getIsSuperAdmin()) {
        $this->form = new PostLinkForm($post);
      } else {
        echo '<h1>' . __('Connection error') . '</h1>';
        exit;
      }
    } else {
      $this->form = new PostLinkForm();
    }

    $values = $request->getParameter($this->form->getName());
    if ($values['submited']) {
      $user = $this->getUser()->getGuardUser();
      $profile = $user->getProfile();

      if (!$profile->getParty() && !$this->getUser()->getGuardUser()->getIsSuperAdmin()) {
        echo mgAjax::ajaxOutput('error', __('You need to be logged in.'));
        exit;
      }

      if(!(isset($values['partie_id']) && !empty($values['partie_id']))){
        $values['partie_id'] = $profile->getParty()->getId();
      }
      $values['type'] = PostPeer::TYPE_LINK;
      $this->form->bind($values);
      if ($this->form->isValid()) {
        $values = $this->form->getValues();

        if ($this->getUser()->getAttribute('editPost', null) == null) {
          $imageUrl = $values['link_image'];
          $newImage = $this->storeImage($imageUrl);
        }

        $this->post = $this->form->save();

        if ($this->getUser()->getAttribute('editPost', null) == null) {
          $this->post->storeReplicaPost();
        }

        if ($newImage != false) {
          $this->post->setLinkImage($newImage);
        }
        echo mgAjax::ajaxOutput('success', __('You have successfully ') . ($this->getUser()->getAttribute('editPost', null) == null ? __('created new') : __('edited')) . ' ' . __('post') . '.', array('url' => $this->post->getLink()));
        exit;
      }
    }
  }

  public function executeCreate_post_video(sfWebRequest $request) {
    if (!mgAjax::isAjax()) {
      echo mgAjax::ajaxOutput('error', __('Connection error'));
      exit;
    }
    if (!$this->getUser()->isAuthenticated()) {
      echo mgAjax::ajaxOutput('error', __('You need to be logged in.'));
      exit;
    }

    $post = $this->getUser()->getAttribute('editPost', null);
    if ($post != null) {
      $party = $this->getUser()->getGuardUser()->getProfile()->getParty();
      if (($party != null && $post->getPartieId() == $party->getId()) || $this->getUser()->getGuardUser()->getIsSuperAdmin()) {
        $this->form = new PostVideoForm($post);
      } else {
        echo '<h1>' . __('Connection error') . '</h1>';
        exit;
      }
    } else {
      $this->form = new PostVideoForm();
    }

    $values = $request->getParameter($this->form->getName());
    if ($values['submited']) {
      $user = $this->getUser()->getGuardUser();
      $profile = $user->getProfile();

      if (!$profile->getParty() && !$this->getUser()->getGuardUser()->getIsSuperAdmin()) {
        echo mgAjax::ajaxOutput('error', __('You need to be logged in.'));
        exit;
      }

      if(!(isset($values['partie_id']) && !empty($values['partie_id']))){
        $values['partie_id'] = $profile->getParty()->getId();
      }
      $values['type'] = PostPeer::TYPE_VIDEO;
      $this->form->bind($values);
      if ($this->form->isValid()) {
        $values = $this->form->getValues();
        $this->post = $this->form->save();

        if ($this->getUser()->getAttribute('editPost', null) == null) {
          $this->post->storeReplicaPost();
        }
        echo mgAjax::ajaxOutput('success', __('You have successfully ') . ($this->getUser()->getAttribute('editPost', null) == null ? __('created new') : __('edited')) . ' ' . __('post') . '.', array('url' => $this->post->getLink()));
        exit;
      }
    }
  }

  public function executeCreate_post_poll(sfWebRequest $request) {
    if (!mgAjax::isAjax()) {
      echo mgAjax::ajaxOutput('error', __('Connection error'));
      exit;
    }
    if (!$this->getUser()->isAuthenticated()) {
      echo mgAjax::ajaxOutput('error', __('You need to be logged in.'));
      exit;
    }

    $post = $this->getUser()->getAttribute('editPost', null);
    if ($post != null) {
      $party = $this->getUser()->getGuardUser()->getProfile()->getParty();
      if (($party != null && $post->getPartieId() == $party->getId()) || $this->getUser()->getGuardUser()->getIsSuperAdmin()) {
        $this->form = new PostPollForm($post);
      } else {

        echo '<h1>' . __('Connection error') . '</h1>';
        exit;
      }
    } else {
      $this->form = new PostPollForm();
    }

    $values = $request->getParameter($this->form->getName());
    if ($values['submited']) {
      $user = $this->getUser()->getGuardUser();
      $profile = $user->getProfile();

      if (!$profile->getParty() && !$this->getUser()->getGuardUser()->getIsSuperAdmin()) {
        echo mgAjax::ajaxOutput('error', __('You need to be logged in.'));
        exit;
      }

      if(!(isset($values['partie_id']) && !empty($values['partie_id']))){
        $values['partie_id'] = $profile->getParty()->getId();
      }
      $values['type'] = PostPeer::TYPE_POLL;
      $this->form->bind($values);
      if ($this->form->isValid()) {
        $values = $this->form->getValues();
        $isNew = $this->form->getObject()->isNew();
        $this->post = $this->form->save();

        if ($isNew) {
          for ($i = 1; $i <= 5; $i++) {
            if ($values['answer_' . $i] != '') {
              $answer = new PostPollAnswer();
              $answer->setPostId($this->post->getId());
              $answer->setAnswer($values['answer_' . $i]);
              $answer->save();
            }
          }
        }

        if ($this->getUser()->getAttribute('editPost', null) == null) {
          $this->post->storeReplicaPost();
        }

        echo mgAjax::ajaxOutput('success', __('You have successfully ') . ($this->getUser()->getAttribute('editPost', null) == null ? __('created new') : __('edited')) . ' ' . __('post') . '.', array('url' => $this->post->getLink()));
        exit;
      }
    }
  }

  public function executeLink_data(sfWebRequest $request) {
    error_reporting(E_ALL ^ E_WARNING);

    $output = array('title' => '', 'description' => '', 'images' => array());
    $url = $request->getParameter('link', null);

    if ($url == null || $url == "") {
      echo json_encode($output);
      exit;
    }
    try {
      $content = file_get_html($url);
    } catch (Exception $e) {
      echo json_encode($output);
    }
    if ($content == "") {
      echo json_encode($output);
      exit;
    }

    if ($v = isYoutubeUrl($url)) {
      $outputImages = array();
      $outputImages[] = getYoutubeThumbnailPhoto($v);
    } else {
      $images = array();
      require_once sfConfig::get('sf_root_dir') . DIRECTORY_SEPARATOR . 'lib/vendor/absoluteUrl/url_to_absolute.php';
      $i = 0;
      foreach ($content->find('img') as $element) {
        $images[] = url_to_absolute($url, $element->src);
      }
      $outputImages = array();
      if (!empty($images)) {
        $outputImages = array();
        foreach ($images as $image) {
          if (!in_array($image, $outputImages)) {
            $outputImages[] = $image;
          }
        }
      }
    }

    $tags = mgGetDataFromHtml($content);
    $output['title'] = trim($tags['title']);
    $output['description'] = trim($tags['description']);
    $output['images'] = $outputImages;

    echo json_encode($output);
    exit;
  }

  protected function storeImage($url) {
    try {
      list($width, $height, $type, $attr) = getimagesize($url);
    } catch (Exception $e) {
      return false;
    }
    $imageName = md5(time() . rand(1000, 9999)) . '.jpg';
    $download = sfConfig::get('post_photo_path') . DIRECTORY_SEPARATOR . $imageName;
    $this->saveRemoteImage($url, $download);
    try {
      $img = new sfImage($download, 'image/jpeg');
      return $imageName;
    } catch (Exception $e) {
      return false;
    }
    return false;
  }

  protected function saveRemoteImage($img, $fullpath) {
    $ch = curl_init($img);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
    $rawdata = curl_exec($ch);
    curl_close($ch);
    if (file_exists($fullpath)) {
      unlink($fullpath);
    }
    $fp = fopen($fullpath, 'x');
    fwrite($fp, $rawdata);
    fclose($fp);
  }

  public function executePost_list(sfWebRequest $request) {
    
    if (!$request->isXmlHttpRequest()) {
      $this->getUser()->setAttribute('posts_count', 0);
      $this->getUser()->setAttribute('party', null);
      $this->getUser()->setAttribute('filter_type', array());
      $this->getUser()->setAttribute('filter_tags', null);
      $this->getUser()->setAttribute('filter_badges1', array());
      $this->getUser()->setAttribute('filter_badges2', array());
      $this->getUser()->setAttribute('filter_interval', 3);
      $this->getUser()->setAttribute('filter_sort', 5);
    } else {
      $this->getUser()->setAttribute('posts_count', $this->getUser()->getAttribute('posts_count') + 9);
    }
    $c = new Criteria();
    if (isset($this->party)) {
      $c->add(PostPeer::PARTIE_ID, $this->party->getId());
      $this->getUser()->setAttribute('party', $this->party);
    } else {
      if ($this->getUser()->getAttribute('party', null) != null) {
        $this->party = $this->getUser()->getAttribute('party', null);
        $c->add(PostPeer::PARTIE_ID, $this->party->getId());
      }
    }

    if ($request->getParameter('filter') == 1) {
      $this->resetCounter();
      $this->getUser()->setAttribute('filter_tags', $request->getParameter('tag_search', null));
      $this->getUser()->setAttribute('filter_type', $request->getParameter('type', null));
      $this->getUser()->setAttribute('filter_badges1', $request->getParameter('badges1', null));
      $this->getUser()->setAttribute('filter_badges2', $request->getParameter('badges2', null));
      $this->getUser()->setAttribute('filter_interval', $request->getParameter('interval', 3));
      $this->getUser()->setAttribute('filter_sort', $request->getParameter('rang_sort', 5));
    }

    // Filter functionality (only on homepage)
    // Filter by tags
    $tags = $this->getUser()->getAttribute('filter_tags');
    if ($tags != null) {
      $c->addJoin(PostPeer::ID, TaggingPeer::TAGGABLE_ID, Criteria::LEFT_JOIN);
      $c->addJoin(TaggingPeer::TAG_ID, TagPeer::ID, Criteria::LEFT_JOIN);
      $c->addAnd(TaggingPeer::TAGGABLE_MODEL, 'Post');
      $c1 = $c->getNewCriterion(TagPeer::NAME, '%' . $tags . '%', Criteria::LIKE);
      $c->addOr($c1);
      $c->addGroupByColumn(PostPeer::ID);
    }
    // Filter by type
    $types = $this->getUser()->getAttribute('filter_type');
    if ($types != null) {
      $c->add(PostPeer::TYPE, $types, Criteria::IN);
    }
    // Filter by badges
    $badges1 = $this->getUser()->getAttribute('filter_badges1');
    if ($badges1 != null) {
      $c->add(PostPeer::BEST_BADGE_1, $badges1, Criteria::IN);
    }
    $badges2 = $this->getUser()->getAttribute('filter_badges2');
    if ($badges2 != null) {
      $c->add(PostPeer::BEST_BADGE_2, $badges2, Criteria::IN);
    }
    // Filter by interval
    $interval = $this->getUser()->getAttribute('filter_interval');
    if ($interval != null) {
      if ($interval == 1) {
        $c->addAnd(PostPeer::CREATED_AT, date('Y-m-d 00:00:00'), Criteria::GREATER_EQUAL);
        $c->addAnd(PostPeer::CREATED_AT, date('Y-m-d 23:59:59'), Criteria::LESS_EQUAL);
      } else if ($interval == 2) {
        $c->addAnd(PostPeer::CREATED_AT, date('Y-m-d 00:00:00', strtotime('previous monday', time())), Criteria::GREATER_EQUAL);
        $c->addAnd(PostPeer::CREATED_AT, date('Y-m-d 23:59:59', strtotime('next sunday', time())), Criteria::LESS_EQUAL);
      }
    }
    
    $rang_sort = $this->getUser()->getAttribute('filter_sort');
    if ($rang_sort != null) {
      switch ($rang_sort) {
        case 1:
          $c->addJoin(PostPeer::ID, PostIndexPeer::POST_ID);
          $c->addDescendingOrderByColumn(PostIndexPeer::DAILY);
          $c->add(PostPeer::TOTAL_INDEX, ConfigurationPeer::get('index_boundary', 0), Criteria::GREATER_EQUAL);
          break;

        case 2:
          $c->addJoin(PostPeer::ID, PostIndexPeer::POST_ID);
          $c->addDescendingOrderByColumn(PostIndexPeer::WEEKLY);
          $c->add(PostPeer::TOTAL_INDEX, ConfigurationPeer::get('index_boundary', 0), Criteria::GREATER_EQUAL);
          break;

        case 3:
          $c->addDescendingOrderByColumn(PostPeer::TOTAL_INDEX);
          $c->add(PostPeer::TOTAL_INDEX, ConfigurationPeer::get('index_boundary', 0), Criteria::GREATER_EQUAL);
          break;

        case 4:
          $c->addDescendingOrderByColumn(PostPeer::CREATED_AT);
          break;

        case 5:
          if (!isset($this->party)) {
            $c->add(PostPeer::TOTAL_INDEX, ConfigurationPeer::get('index_boundary', 0), Criteria::GREATER_EQUAL);
            $c->addDescendingOrderByColumn(PostPeer::CREATED_AT);
          } else {
            $c->addDescendingOrderByColumn(PostPeer::TOTAL_INDEX);
          }
          break;

        default:
          break;
      }
    }

    $c->add(PostPeer::IS_FEATURED, false);
    $c->addGroupByColumn(PostPeer::ID);

    $this->postList = PostPeer::getPosts($this->getUser()->getAttribute('posts_count'), 9, $c);
  }

  protected function resetCounter() {
    $this->getUser()->setAttribute('posts_count', 0);
  }

  protected function getPostCriteria($criteria) {
    if ($this->getUser()->getAttribute('sort', null) == 'popular') {
      $criteria->addDescendingOrderByColumn(PostPeer::CREATED_AT);
      $criteria->add(PostPeer::TOTAL_INDEX, 3.5, Criteria::GREATER_THAN);
    } else {
      $criteria->addDescendingOrderByColumn($this->getUser()->getAttribute('sort'));
    }
    return $criteria;
  }

  public function executePoll_answers(sfWebRequest $request) {
    if (!mgAjax::isAjax()) {
      echo mgAjax::ajaxOutput('error', __('Connection error'));
      exit;
    }
    $this->post = PostPeer::retrieveByPK($request->getParameter('poll_id'));
  }

  public function executePoll_results(sfWebRequest $request) {
    if (!mgAjax::isAjax()) {
      echo mgAjax::ajaxOutput('error', __('Connection error'));
      exit;
    }
    $this->post = PostPeer::retrieveByPK($request->getParameter('poll_id'));
  }

  public function executePoll_vote(sfWebRequest $request) {
    if (!mgAjax::isAjax()) {
      echo mgAjax::ajaxOutput('error', __('Connection error'));
      exit;
    }
    if (!$this->getUser()->isAuthenticated()) {
      echo mgAjax::ajaxOutput('error', 'login');
      exit;
    }

    $this->post = PostPeer::retrieveByPK($request->getParameter('poll_id'));
    $this->selectedId = $request->getParameter('poll' . $this->post->getId(), null);
    if ($this->selectedId == null) {
      echo mgAjax::ajaxOutput('error', __('You need to be logged in.'));
      exit;
    } else {
      $pv = new PostPollVote();
      $pv->setPostId($this->post->getId());
      $pv->setUserId($this->getUser()->getGuardUser()->getId());
      $pv->setAnswerId($this->selectedId[0]);
      $pv->save();
      echo mgAjax::ajaxOutput('success', __('Thank you for vote.'));
    }
    exit;
  }

  public function executeAdd_badge(sfWebRequest $request) {
    if (!mgAjax::isAjax()) {
      echo mgAjax::ajaxOutput('error', __('Error in system, please refresh page.'));
      exit;
    }

    if (!$this->getUser()->isAuthenticated()) {

      $user = sfGuardUserProfilePeer::createVirtualUser();

      if(!empty($user)){
        $this->post = PostPeer::retrieveByPK($request->getParameter('post_id'));
        $this->badge = BadgePeer::retrieveByPK($request->getParameter('badge_id'));
        $this->post->addbadge($this->badge, $user);
      }
      echo mgAjax::ajaxOutput('success', __('You have successfully added badge.'), array('badge1' => $this->post->getBadge1()->getImageUrl(), 'badge2' => $this->post->getBadge2()->getStyle()));
      exit;
    } else {
      $this->post = PostPeer::retrieveByPK($request->getParameter('post_id'));
      $this->badge = BadgePeer::retrieveByPK($request->getParameter('badge_id'));
      $this->post->addbadge($this->badge, $this->getUser()->getGuardUser());
      echo mgAjax::ajaxOutput('success', __('You have successfully added badge.'), array('badge1' => $this->post->getBadge1()->getImageUrl(), 'badge2' => $this->post->getBadge2()->getStyle()));
      exit;
    }
  }

  public function executePost_right_index_support(sfWebRequest $request) {
    if (!isset($this->post)) {
      $this->post = PostPeer::retrieveByPK($request->getParameter('post_id'));
    }
    $this->badge1 = BadgePeer::getBadgesByType(1);
    $this->badge2 = BadgePeer::getBadgesByType(2);
  }

  public function executePost_right_party_posts(sfWebRequest $request) {
    if (!$request->isXmlHttpRequest()) {
      $this->getUser()->setAttribute('party_posts_count_right', 0);
    } else {
      $this->getUser()->setAttribute('party_posts_count_right', $this->getUser()->getAttribute('party_posts_count_right') + 3);
    }
    if (!isset($this->post)) {
      $this->post = PostPeer::retrieveByPK($request->getParameter('post_id'));
    }
    $this->postsList = $this->post->getPartie()->getPartyPosts(3, $this->getUser()->getAttribute('party_posts_count_right'));
  }

  public function executePost_right_category_list(sfWebRequest $request) {
    if (!$request->isXmlHttpRequest()) {
      $this->getUser()->setAttribute('category_posts_count_right', 0);
    } else {
      $this->getUser()->setAttribute('category_posts_count_right', $this->getUser()->getAttribute('category_posts_count_right') + 3);
    }
    if (!isset($this->post)) {
      $this->post = PostPeer::retrieveByPK($request->getParameter('post_id'));
    }
    $this->postsList = $this->post->getCategoryPopularPosts(3, $this->getUser()->getAttribute('category_posts_count_right'));
  }

  public function executePost_right_type_list(sfWebRequest $request) {
    if (!$request->isXmlHttpRequest()) {
      $this->getUser()->setAttribute('type_posts_count_right', 0);
    } else {
      $this->getUser()->setAttribute('type_posts_count_right', $this->getUser()->getAttribute('type_posts_count_right') + 3);
    }
    if (!isset($this->post)) {
      $this->post = PostPeer::retrieveByPK($request->getParameter('post_id'));
    }
    $this->postsList = $this->post->getTypePopularPosts(3, $this->getUser()->getAttribute('type_posts_count_right'));
  }

  public function executePost_right_replicas_list(sfWebRequest $request) {
    if (!$request->isXmlHttpRequest()) {
      $this->getUser()->setAttribute('replica_posts_count_right', 0);
    } else {
      $this->getUser()->setAttribute('replica_posts_count_right', $this->getUser()->getAttribute('replica_posts_count_right') + 3);
    }
    if (!isset($this->post)) {
      $this->post = PostPeer::retrieveByPK($request->getParameter('post_id'));
    }
    $this->postsList = $this->post->getReplicaPosts(3, $this->getUser()->getAttribute('replica_posts_count_right'));
  }

  public function executeNews_post() {
    $this->news = NewsPeer::getNewsList(1);
  }

  public function executeFlag_as_inapropriate_show(sfWebRequest $request) {
    if (!mgAjax::isAjax()) {
      echo mgAjax::ajaxOutput('error', __('Connection error'));
      exit;
    }

    $this->badge = BadgePeer::retrieveByPK($request->getParameter('badge_id'));
    $this->post = PostPeer::retrieveByPK($request->getParameter('post_id'));

    $values = $request->getParameter('report');

    $i = new Inappropriate();
    $i->setPostId($this->post->getId());
    
    if($this->getUser()->isAuthenticated()){
      $user = $this->getUser()->getGuardUser();
    }else{
      $user = sfGuardUserProfilePeer::createVirtualUser();
    }
    $i->setUserId($user->getId());
    $this->form = new InappropriateForm($i);

    if ($this->badge->getId() == 14) {
      $values['type'] = 1;
    } else if ($this->badge->getId() == 15) {
      $values['type'] = 2;
    }

    if (isset($values['submited']) && $values['submited'] == 1) {

      $c = new Criteria();
      $c->add(InappropriatePeer::USER_ID, $user->getId());
      $c->add(InappropriatePeer::POST_ID, $this->post->getId());
      $c->add(InappropriatePeer::TYPE, $values['type']);
      InappropriatePeer::doDelete($c);

      $inp = $this->form->bind($values);

      if ($this->form->isValid()) {
        $values = $this->form->getValues();
        $this->form->save();
        echo mgAjax::ajaxOutput('success', __('Thank you! You have successfully reported post.'));
        exit;
      }
    }
  }

  public function executeDelete_post(sfWebRequest $request) {
    if (!mgAjax::isAjax()) {
      echo mgAjax::ajaxOutput('error', __('Connection error'));
      exit;
    }
    if (!$this->getUser()->isAuthenticated()) {
      echo mgAjax::ajaxOutput('error', __('You need to be logged in.'));
      exit;
    }

    $user = $this->getUser()->getGuardUser();
    $profile = $user->getProfile();
    $post = PostPeer::retrieveByPK($request->getParameter('post_id'));

    if (!empty($post) && (($user->getProfile()->getParty() != null && $user->getProfile()->getParty()->getId() == $post->getPartieId()) || $user->getIsSuperAdmin())) {
      $post->deleteReplicas();
      $post->delete();
      echo mgAjax::ajaxOutput('success', __('Post has been successfullt removed'));
    } else {
      echo mgAjax::ajaxOutput('success', __('There is an error during removing of post.'));
    }
    exit;
  }

  public function executeFeatured(sfWebRequest $request) {
    if (!mgAjax::isAjax()) {
      echo mgAjax::ajaxOutput('error', __('Connection error'));
      exit;
    }
    if (!$this->getUser()->isAuthenticated()) {
      echo mgAjax::ajaxOutput('error', __('You need to be logged in.'));
      exit;
    }

    $post = PostPeer::retrieveByPK($request->getParameter('post_id'));

    if (!empty($post)) {
      if ($post->getIsFeatured()) {
        $post->setIsFeatured(false);
        $post->save();
      } else {
        $c = new Criteria();
        $c->add(PostPeer::IS_FEATURED, true);
        $oldPost = PostPeer::doSelectOne($c);
        if (!empty($oldPost)) {
          $oldPost->setIsFeatured(false);
          $oldPost->save();
        }
        $post->setIsFeatured(true);
        $post->save();
      }
    } else {
      echo mgAjax::ajaxOutput('error', __('Connection error'));
      exit;
    }


    if (empty($post)) {
      echo mgAjax::ajaxOutput('error', __('You need to be logged in.'));
      exit;
    }
    exit;
  }

}
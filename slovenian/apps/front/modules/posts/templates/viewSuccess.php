<div id="leftColumn"> 
 
  <?php include_partial('posts/big_post', array('post' => $post)) ?>
  
  <?php include_component('comment', 'comment', array('type' => 1, 'id' => $post->getId())) ?>
</div>

<div id="rightColumn"> 
  <div id="index">
    <?php include_component('posts', 'post_right_index_support', array('post' => $post)) ?>
  </div>
  
  <?php include_partial('posts/post_right_posts_list', array('post' => $post, 'type' => 'post_replicas', 'title' => __('List of Replicas'))) ?>
  
  <?php include_partial('posts/post_right_posts_list', array('post' => $post, 'type' => 'party_posts_list', 'title' => __('Party Posts'))) ?>
  
  <?php include_partial('posts/post_right_posts_list', array('post' => $post, 'type' => 'most_popular_type', 'title' => __('Most popular') . ' ' . $post->getTypeName())) ?>
</div>
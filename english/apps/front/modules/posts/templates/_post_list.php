<?php $postList = sfOutputEscaperArrayDecorator::unescape($postList) ?>
<?php if (!empty($postList)) { ?>
  <?php $i = 0; ?>
  <?php foreach ($postList as $post) {
    $i++;
  ?>
    <?php if ($sf_user->getAttribute('posts_count') == 0 && $sf_context->getModuleName() != 'parties' && $i == 3) { ?>
      <?php include_component('posts', 'news_post') ?>
    <?php } ?>
    <?php if ($post->getType() == PostPeer::TYPE_TEXT) { ?>
      <?php include_partial('posts/post_text', array('post' => $post)) ?>
    <?php } else if ($post->getType() == PostPeer::TYPE_PHOTO) { ?>
      <?php include_partial('posts/post_photo', array('post' => $post)) ?>
    <?php } else if ($post->getType() == PostPeer::TYPE_VIDEO) { ?>
      <?php include_partial('posts/post_video', array('post' => $post)) ?>
    <?php } else if ($post->getType() == PostPeer::TYPE_QUOTE) { ?>
      <?php include_partial('posts/post_quote', array('post' => $post)) ?>
    <?php } else if ($post->getType() == PostPeer::TYPE_LINK) { ?>
      <?php include_partial('posts/post_link', array('post' => $post)) ?>
    <?php } else if ($post->getType() == PostPeer::TYPE_POLL) { ?>
      <?php include_partial('posts/post_poll', array('post' => $post)) ?>
    <?php } ?>
  <?php } ?>
<?php }else{ ?>
  <?php if(!$sf_request->isXmlHttpRequest()){ ?>
    <div class="no-object">
      <?php echo __('There are no posts') ?>
    </div>
  <?php } ?>
<?php } ?>

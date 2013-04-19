<?php $news = sfOutputEscaperArrayDecorator::unescape($news);
$news = $news[0]; ?>

<?php $featuredPost = PostPeer::getFeaturedPost() ?>
<?php if(!empty($featuredPost)){ ?>
  <?php if ($featuredPost->getType() == PostPeer::TYPE_TEXT) { ?>
    <?php include_partial('posts/post_text', array('post' => $featuredPost)) ?>
  <?php } else if ($featuredPost->getType() == PostPeer::TYPE_PHOTO) { ?>
    <?php include_partial('posts/post_photo', array('post' => $featuredPost)) ?>
  <?php } else if ($featuredPost->getType() == PostPeer::TYPE_VIDEO) { ?>
    <?php include_partial('posts/post_video', array('post' => $featuredPost)) ?>
  <?php } else if ($featuredPost->getType() == PostPeer::TYPE_QUOTE) { ?>
    <?php include_partial('posts/post_quote', array('post' => $featuredPost)) ?>
  <?php } else if ($featuredPost->getType() == PostPeer::TYPE_LINK) { ?>
    <?php include_partial('posts/post_link', array('post' => $featuredPost)) ?>
  <?php } else if ($featuredPost->getType() == PostPeer::TYPE_POLL) { ?>
    <?php include_partial('posts/post_poll', array('post' => $featuredPost)) ?>
  <?php } ?>
<?php } ?>
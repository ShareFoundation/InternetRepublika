<meta property="og:title" content="<?php echo $post->getTitle() ?>" /> 
<?php if($post->getType() == PostPeer::TYPE_PHOTO){ ?>
  <meta property="og:image" content="<?php echo thumbnail_tag($post->getPhotoImageUrl(), 120, 120, array(), true, false, true) ?>" />
<?php } else if($post->getPartie()->getLogo() != '' && $post->getPartie()->getLogo() != null){ ?>
  <meta property="og:image" content="<?php echo thumbnail_tag($post->getPartie()->getImageRealUrl(), 120, 120, array(), true, false, true) ?>" />
<?php } ?>
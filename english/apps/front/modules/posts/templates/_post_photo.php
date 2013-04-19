<div class="postBlock">
  <div class="dropHover"></div>
  <?php include_partial('posts/post_header', array('post' => $post)) ?>
  <div class="postContent smiley-universal" style="border-color: <?php echo $post->getBadge2()->getStyle() ?>">
    <div class="postImg">
      <?php if($post->getPhotoImageUrl() != '') { ?>
        <?php echo include_partial('main/draw_post_photo', array('post' => $post)) ?>
      <?php } ?>
    </div>
    <?php include_partial('posts/post_description', array('post' => $post)) ?>
  </div>
  <?php include_partial('posts/post_footer', array('post' => $post)) ?>
</div>
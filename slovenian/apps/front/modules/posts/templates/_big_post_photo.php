<div class="postImg">
  <?php if ($post->getPhotoImageUrl() != '') { ?>
    <?php echo include_partial('main/draw_post_photo', array('post' => $post, 'width' => 536, 'height' => 536)) ?>
  <?php } ?>
</div>
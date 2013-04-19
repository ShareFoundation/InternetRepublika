<div class="postBlock">
  <div class="dropHover"></div>
  <?php include_partial('posts/post_header', array('post' => $post)) ?>
  <div class="postContent smiley-universal" style="border-color: <?php echo $post->getBadge2()->getStyle() ?>">
    <?php if($youtubeId = isYoutubeUrl($post->getVideoUrl())){ ?>
    <div class="postVideo">
      <iframe width="260" height="206"  wmode="transparent" src="http://www.youtube.com/embed/<?php echo $youtubeId ?>?wmode=transparent&autohide=1" frameborder="0" allowfullscreen=""></iframe>
    </div>
    <?php } ?>
    <?php include_partial('posts/post_description', array('post' => $post)) ?>
  </div>
  <?php include_partial('posts/post_footer', array('post' => $post)) ?>
</div>
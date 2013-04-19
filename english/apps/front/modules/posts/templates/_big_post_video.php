<?php if ($youtubeId = isYoutubeUrl($post->getVideoUrl())) { ?>
  <div class="spostVideo">
    <iframe width="536" height="402" wmode="transparent" src="http://www.youtube.com/embed/<?php echo $youtubeId ?>?wmode=transparent&autohide=1" frameborder="0" allowfullscreen=""></iframe>
  </div>
<?php }else{ ?><br/><?php } ?>

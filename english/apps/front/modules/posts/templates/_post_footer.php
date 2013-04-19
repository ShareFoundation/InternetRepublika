<div class="postSocials">
  <div class="like-share"> 
    <a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo $post->getLink() ?>" data-text="<?php echo $post->getTitle() ?>" data-hashtags="netrepublika">Tweet</a>
  </div>
  <div class="like-share">
    <iframe src="//www.facebook.com/plugins/like.php?href=<?php echo $post->getLink() ?>&amp;send=false&amp;layout=button_count&amp;width=150&amp;show_faces=true&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21&amp;appId=190915007686913" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:90px; height:21px;" allowTransparency="true"></iframe>
  </div>
</div>
<div class="postFooter"><a class="tooltip" title="<?php echo __('Write replica') ?>" href="<?php echo $post->getLink() ?>"><span class="replica"><img src="/images/front/replika.png" /><?php echo $post->getReplicaCount() ?></span></a><a class="tooltip" title="<?php echo __('Comments') ?>" href="<?php echo $post->getLink() ?>"><span class="comment"><img src="/images/front/komentar.png" /><?php echo $post->getCommentsCount() ?></span></a></div>
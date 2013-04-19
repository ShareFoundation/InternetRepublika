<div id="singlePost">
  <div class="dropHover"></div>
  <div class="singlePost">
    <div class="spostTop">
      <div class="spostTitle" post_id="<?php echo $post->getId() ?>">
        <div class="subtitle"> <a href="<?php echo $post->getPartie()->getLink() ?>"><?php echo $post->getPartie()->getName() ?></a> </div>
        <h2><?php echo $post->getTitle() ?></h2>
      </div>
      <?php include_partial('posts/post_actions', array('post' => $post)) ?>
      <div class="spostImage"><a href="<?php echo $post->getPartie()->getLink() ?>"><?php echo include_partial('main/draw_party_logo', array('party' => $post->getPartie())) ?></a></div>
    </div>
    <div class="clear"></div>

    <div class="spostBadge">
      <div class="badge-universal" <?php if($post->getBadge1() != null){ ?>style="background-image: url('<?php echo $post->getBadge1()->getImageUrl() ?>');"<?php } ?>>&nbsp;</div>
    </div>

    <div class="spostContent smiley-universal" style="border-color: <?php echo $post->getBadge2()->getStyle() ?>;">
      <?php if ($post->getType() == PostPeer::TYPE_PHOTO) { ?>
        <?php include_partial('posts/big_post_photo', array('post' => $post)) ?>
      <?php } else if ($post->getType() == PostPeer::TYPE_VIDEO) { ?>
        <?php include_partial('posts/big_post_video', array('post' => $post)) ?>
      <?php } else if ($post->getType() == PostPeer::TYPE_QUOTE) { ?>
        <?php include_partial('posts/big_post_quote', array('post' => $post)) ?>
      <?php } else if ($post->getType() == PostPeer::TYPE_LINK) { ?>
        <?php include_partial('posts/big_post_link', array('post' => $post)) ?>
      <?php } else if ($post->getType() == PostPeer::TYPE_POLL) { ?>
        <?php include_partial('posts/big_post_poll', array('post' => $post)) ?>
      <?php } else if ($post->getType() == PostPeer::TYPE_TEXT) { ?>
        <?php // Only show description ?>
      <?php } ?>

      <?php if (!in_array($post->getType(), array(PostPeer::TYPE_QUOTE, PostPeer::TYPE_LINK, PostPeer::TYPE_POLL))) { ?>
        <div class="spostDescription">
          <div class="text">
            <p>
              <?php echo nl2br(strip_tags($post->getText())) ?>
            </p>
          </div>
        </div>
      <?php } ?>
    </div>

    <div class="spostSocials">
      <h3>
        <?php echo implode(", ", sfOutputEscaper::unescape($post->getTags())) ?>
      </h3>
      <div class="like-share">  
        <a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo $post->getLink() ?>" data-text="<?php echo $post->getTitle() ?>" data-hashtags="netrepublika">Tweet</a>
      </div>
      <div class="like-share">
        <iframe src="//www.facebook.com/plugins/like.php?href=<?php echo $post->getLink() ?>&amp;send=false&amp;layout=button_count&amp;width=150&amp;show_faces=true&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21&amp;appId=190915007686913" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:150px; height:21px;" allowTransparency="true"></iframe>
      </div>
      <?php if ($sf_user->isAuthenticated() && $sf_user->getGuardUser()->getProfile()->getParty() != null) { ?>
        <div class="like-share">
          <a href="javascript: void(0)" onclick="showPostDialog(<?php echo $post->getId() ?>)"><?php echo __('Write Replica') ?></a>
        </div>
      <?php } ?>

      <?php if ($post->getReplicaPostId() != null) { ?>
        <div class="like-share">
          <h3><?php __('This post is replicat to post') ?>: <a href="<?php echo $post->getPostRelatedByReplicaPostId()->getLink() ?>"><?php echo $post->getPostRelatedByReplicaPostId()->getTitle() ?></a></h3>
        </div>
      <?php } ?>
    </div>

  </div>
</div>

<script>
  var isUserLoggedIn = <?php echo ($sf_user->isAuthenticated()) ? 'true' : 'false' ?>;
  jQuery(document).ready(function(){
    drawDropableBig();
  });
</script>
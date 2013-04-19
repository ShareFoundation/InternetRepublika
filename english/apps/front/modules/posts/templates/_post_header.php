<div class="postTitle" post_id="<?php echo $post->getId() ?>">
  <div class="subtitle">
    <?php if($post->getIsFeatured()){ ?>
      <a href="<?php echo url_for('@news_index', true) ?>"><?php echo __('News') ?></a></div>
    <?php }else{ ?>
      <a href="<?php echo $post->getPartie()->getLink() ?>"><?php echo $post->getPartie()->getName() ?></a></div>
    <?php } ?>
  <h2><a href="<?php echo $post->getLink() ?>"><?php echo $post->getTitle() ?></a></h2>
</div>

<?php include_partial('posts/post_actions', array('post' => $post)) ?>


<div class="postImage"><a href="<?php echo $post->getPartie()->getLink() ?>"><?php echo include_partial('main/draw_party_logo', array('party' => $post->getPartie())) ?></a></div>

<div class="postBadge">
  <div class="badge-universal" <?php if($post->getBadge1() != null){ ?>style="background-image: url('<?php echo $post->getBadge1()->getImageUrl() ?>');"<?php } ?>>&nbsp;</div>
</div>
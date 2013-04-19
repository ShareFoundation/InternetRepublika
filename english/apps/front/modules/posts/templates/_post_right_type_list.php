<?php if(!empty($postsList) && count($postsList) > 0){ ?>
  <?php foreach($postsList as $post){ ?>
    <li>
      <div class="replica">
        <h2><a href="<?php echo $post->getLink() ?>"><?php echo $post->getTitle() ?></a></h2>
      </div>
      <div class="replicaComment"><a href="<?php echo $post->getLink() ?>"><?php echo $post->getReplicaCount() ?> <?php echo __('replicas') ?></a><br />
        <a href="<?php echo $post->getLink() ?>"><?php echo $post->getCommentsCount() ?> <?php echo __('Comments') ?></a></div>
    </li>
  <?php } ?>
<?php }else{ ?>
    <?php if(!$sf_request->isXmlHttpRequest()){ ?>
      <li><div class="replica"><h2><?php echo __('There are no posts') ?></h2></div></li>
    <?php } ?>
<?php } ?>

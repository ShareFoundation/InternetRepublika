<div id="blockList">
  <div class="replicaTitle"><?php echo $title ?></div>
  <div class="replicaContent">
    <ul class="ul_<?php echo $type ?>">
      <?php if ($type == 'post_replicas') { ?>
        <?php include_component('posts', 'post_right_replicas_list', array('post' => $post)) ?>
      <?php } else if ($type == 'most_popular_category') { ?>
        <?php include_component('posts', 'post_right_category_list', array('post' => $post)) ?>
      <?php } else if ($type == 'most_popular_type') { ?>
        <?php include_component('posts', 'post_right_type_list', array('post' => $post)) ?>
      <?php } else if ($type == 'party_posts_list') { ?>
        <?php include_component('posts', 'post_right_party_posts', array('post' => $post)) ?>
      <?php } ?>
    </ul>
  </div>

  <?php if ($type == 'post_replicas') { ?>
    <?php if (count($post->getReplicaPosts()) > 3) { ?>
      <div class="showAll">
        <a href="javascript: void(0);" onclick="ajaxRenderComponent('posts', 'post_right_replicas_list', 'post_id=<?php echo $post->getId() ?>', function(data){ 
          jQuery('.loader', jQuery('.ul_<?php echo $type ?>').parent().parent()).remove();
          if(data.trim() != ''){ 
            jQuery('.ul_<?php echo $type ?>').append(data); 
          }else{ 
            jQuery('.showAll', jQuery('.ul_<?php echo $type ?>').parent().parent()).html('<strong><?php echo __('There are no more posts') ?></strong>');
          } 
        }, function(){ jQuery('.showAll', jQuery('.ul_<?php echo $type ?>').parent().parent()).prepend('<img src=<?php echo image_path('front/small-loader.gif') ?> class=loader />');});"><?php echo __('Read More') ?></a>
      </div>
    <?php } ?>
  <?php } else if ($type == 'most_popular_type') { ?>
    <?php if (count($post->getTypePopularPosts()) > 3) { ?>
      <div class="showAll">
        <a href="javascript: void(0);" onclick="ajaxRenderComponent('posts', 'post_right_type_list', 'post_id=<?php echo $post->getId() ?>', function(data){ 
          jQuery('.loader', jQuery('.ul_<?php echo $type ?>').parent().parent()).remove();
          if(data.trim() != ''){ 
            jQuery('.ul_<?php echo $type ?>').append(data); 
          }else{ 
            jQuery('.showAll', jQuery('.ul_<?php echo $type ?>').parent().parent()).html('<strong><?php echo __('There are no more posts') ?></strong>');
          } 
        }, function(){ jQuery('.showAll', jQuery('.ul_<?php echo $type ?>').parent().parent()).prepend('<img src=<?php echo image_path('front/small-loader.gif') ?> class=loader />');});"><?php echo __('Read More') ?></a>
      </div>
    <?php } ?>
  <?php } else if ($type == 'party_posts_list') { ?>
    <?php if (count($post->getPartie()->getPartyPosts()) > 3) { ?>
      <div class="showAll">
        <a href="javascript: void(0);" onclick="ajaxRenderComponent('posts', 'post_right_party_posts', 'post_id=<?php echo $post->getId() ?>', function(data){ 
          jQuery('.loader', jQuery('.ul_<?php echo $type ?>').parent().parent()).remove();
          if(data.trim() != ''){ 
            jQuery('.ul_<?php echo $type ?>').append(data); 
          }else{ 
            jQuery('.showAll', jQuery('.ul_<?php echo $type ?>').parent().parent()).html('<strong><?php echo __('There are no more posts') ?></strong>');
          } 
        }, function(){ jQuery('.showAll', jQuery('.ul_<?php echo $type ?>').parent().parent()).prepend('<img src=<?php echo image_path('front/small-loader.gif') ?> class=loader />');});"><?php echo __('Read More') ?></a>
      </div>
    <?php } ?>
  <?php } ?>
</div>
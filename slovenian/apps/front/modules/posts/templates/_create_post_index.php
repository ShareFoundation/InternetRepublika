<?php if (empty($editPost)) { ?>
  <ul class="create-post-navigation">
    <li><button onclick="ajaxRenderComponent('posts', 'create_post_text', '', function(data){ jQuery('#create-post-main-container').html(data) }, function(data){ jQuery('#create-post-main-container').html('<?php echo __('Loading') . '...' ?>') })"><?php echo __('Text') ?></button></li>
    <li><button onclick="ajaxRenderComponent('posts', 'create_post_photo', '', function(data){ jQuery('#create-post-main-container').html(data) }, function(data){ jQuery('#create-post-main-container').html('<?php echo __('Loading') . '...' ?>') })"><?php echo __('Photo') ?></button></li>
    <li><button onclick="ajaxRenderComponent('posts', 'create_post_video', '', function(data){ jQuery('#create-post-main-container').html(data) }, function(data){ jQuery('#create-post-main-container').html('<?php echo __('Loading') . '...' ?>') })"><?php echo __('Video') ?></button></li>
    <li><button onclick="ajaxRenderComponent('posts', 'create_post_link', '', function(data){ jQuery('#create-post-main-container').html(data) }, function(data){ jQuery('#create-post-main-container').html('<?php echo __('Loading') . '...' ?>') })"><?php echo __('Link') ?></button></li>
    <li><button onclick="ajaxRenderComponent('posts', 'create_post_quote', '', function(data){ jQuery('#create-post-main-container').html(data) }, function(data){ jQuery('#create-post-main-container').html('<?php echo __('Loading') . '...' ?>') })"><?php echo __('Quote') ?></button></li>
    <li><button onclick="ajaxRenderComponent('posts', 'create_post_poll', '', function(data){ jQuery('#create-post-main-container').html(data) }, function(data){ jQuery('#create-post-main-container').html('<?php echo __('Loading') . '...' ?>') })"><?php echo __('Poll') ?></button></li>
  </ul>
<?php }else{ ?>
  <h1><?php echo __('Edit post') ?>: <?php echo $editPost->getTitle() ?></h1>
  <h2>Tip: <?php echo $editPost->getTypeName() ?></h2><br/>
<?php } ?>

<div id="create-post-main-container"></div>

<?php if (!empty($editPost)) { ?>
  <?php $type = strtolower($editPost->getRealTypeName()); ?>
<?php } else { ?>
  <?php $type = 'text'; ?>
<?php } ?>

<script>
  ajaxRenderComponent('posts', 'create_post_<?php echo $type ?>', '', function(data){ jQuery('#create-post-main-container').html(data) }, function(data){ jQuery('#create-post-main-container').html('<?php echo __('Loading') . '...' ?>') });
</script>
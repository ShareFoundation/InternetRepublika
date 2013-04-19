<div id="div-post-report">
  
  <div class="report-title"><strong><?php echo __('Report post') ?>:</strong> <?php echo $post->getTitle() ?></div>
  
  <form id="form-post-report">
    <?php echo $form ?>
    <button type="button" onclick="ajaxRenderComponent('posts', 'flag_as_inapropriate_show', 'badge_id=<?php echo $badge->getId() ?>&post_id=<?php echo $post->getId() ?>&' + jQuery('#form-post-report').serialize(), function(data){afterCreateReport(data)}, function(){jQuery('#div-post-report').html('<?php echo __('Loading') . '...' ?>')})"><?php echo __('Report') ?></button>
    <button type="button" onclick="closeModal('modal-report')"><?php echo __('Close') ?></button>
  </form>
</div>
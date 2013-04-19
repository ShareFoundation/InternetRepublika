<div id="div-post-text">
  <form id="form-post-text">
    <ul>
      <?php echo $form['title']->renderRow(); ?>
      <?php echo $form['text']->renderRow(); ?>
      <?php echo $form['tags']->renderRow() ?>
      <li>
        <button type="button" onclick="ajaxRenderComponent('posts', 'create_post_text', jQuery('#form-post-text').serialize(), function(data){afterSavePost(data)}, function(){jQuery('#div-post-text').html('<?php echo __('Loading') . '...' ?>')})"><?php echo __('Save') ?></button>
        <button type="button" onclick="closeModal('modal-post')"><?php echo __('Close') ?></button>
      </li>
    </ul>
    <?php echo $form['submited'] ?>
    <?php echo $form['id'] ?>
    <?php echo $form['partie_id'] ?>
    <?php echo $form['type'] ?>
    <?php echo $form['_csrf_token'] ?>     
  </form>
</div>

<?php if (0/*!$form->getObject()->isNew() && (!$sf_user->getGuardUser()->getProfile()->isUserPost($form->getObject()))*/) { ?>
  <script>
    jQuery('#div-post-text li').hide();
    jQuery('#div-post-text .checkbox_list').parent().show();
    jQuery('#div-post-text .checkbox_list li').show();
  </script>
<?php } ?>
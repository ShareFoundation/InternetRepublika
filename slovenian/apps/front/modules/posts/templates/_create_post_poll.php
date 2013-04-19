<div id="div-post-poll">
  <form id="form-post-poll">
    <ul>
      <?php echo $form['title']->renderRow() ?>
      <?php echo $form['text']->renderRow() ?>
      <?php echo $form['answer_1']->renderRow() ?>
      <?php echo $form['answer_2']->renderRow() ?>
      <?php echo $form['answer_3']->renderRow() ?>
      <?php echo $form['answer_4']->renderRow() ?>
      <?php echo $form['answer_5']->renderRow() ?>
      <?php echo $form['tags']->renderRow() ?>
      <li>
        <button type="button" onclick="ajaxRenderComponent('posts', 'create_post_poll', jQuery('#form-post-poll').serialize(), function(data){afterSavePost(data)}, function(){jQuery('#div-post-poll').html('<?php echo __('Loading') . '...' ?>')})"><?php echo __('Save') ?></button>
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
    jQuery('#div-post-poll li').hide();
    jQuery('#div-post-poll .checkbox_list').parent().show();
    jQuery('#div-post-poll .checkbox_list li').show();
  </script>
<?php } ?>
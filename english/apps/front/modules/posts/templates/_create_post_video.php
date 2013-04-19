<div id="div-post-video">
  <form id="form-post-video">
    <?php if (!$form->getObject()->isNew()) { ?>
      <?php if ($youtubeId = isYoutubeUrl($form->getObject()->getVideoUrl())) { ?>
        <div class="postVideo">
          <?php echo __('Current video') ?>:<br/>
          <iframe width="120" height="90"  wmode="transparent" src="http://www.youtube.com/embed/<?php echo $youtubeId ?>?wmode=transparent&autohide=1" frameborder="0" allowfullscreen=""></iframe>
          <br/>
        </div>
      <?php } ?>
    <?php } ?>
    <ul>
      <?php echo $form['title']->renderRow() ?>
      <?php echo $form['video_url']->renderRow() ?>
      <?php echo $form['text']->renderRow() ?>
      <?php echo $form['tags']->renderRow() ?>
      <li>
        <button type="button" onclick="ajaxRenderComponent('posts', 'create_post_video', jQuery('#form-post-video').serialize(), function(data){afterSavePost(data)}, function(){jQuery('#div-post-video').html('<?php echo __('Loading') . '...' ?>')})"><?php echo __('Save') ?></button>
        <button type="button" onclick="closeModal('modal-post')"><?php echo __('Close') ?></button>
      </li>
    </ul>
    <?php echo $form['submited'] ?>
    <?php echo $form['id'] ?>
    <?php echo $form['partie_id'] ?>
    <?php echo $form['type'] ?>
    <?php echo $form['_csrf_token'] ?>   
  </form>
  <?php if (0/*!$form->getObject()->isNew() && (!$sf_user->getGuardUser()->getProfile()->isUserPost($form->getObject()))*/) { ?>
    <script >
      jQuery('#div-post-video li') . hide();
      jQuery('#div-post-video .checkbox_list') . parent() . show();
      jQuery('#div-post-video .checkbox_list li') . show();
      jQuery('.postVideo') . hide();
    </script>
  <?php } ?>

</div>
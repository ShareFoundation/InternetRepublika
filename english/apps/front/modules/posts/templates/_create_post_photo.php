<div id="div-post-photo">
  <form id="form-post-photo">
    <ul>
      <?php if (!$form->getObject()->isNew()) { ?>
        <li>
          <?php echo __('Current Photo') ?>:<br/>
          <?php echo include_partial('main/draw_post_photo', array('post' => $form->getObject(), 'width' => 120, 'height' => 120)) ?>
        </li>
      <?php } ?>
      <?php echo $form['title']->renderRow() ?>
      <?php echo $form['text']->renderRow() ?>
      <?php echo $form['photo_file']->renderRow() ?>
      <li>
        <input id="file_upload" type="file" name="file_upload" />
      </li>
      <?php echo $form['tags']->renderRow() ?>
      <li>
        <button type="button" onclick="ajaxRenderComponent('posts', 'create_post_photo', jQuery('#form-post-photo').serialize(), function(data){afterSavePost(data)}, function(){jQuery('#div-post-photo').html('<?php echo __('Loading') . '...' ?>')})"><?php echo __('Save') ?></button>
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
    jQuery('#div-post-photo li').hide();
    jQuery('#div-post-photo .checkbox_list').parent().show();
    jQuery('#div-post-photo .checkbox_list li').show();
  </script>
<?php } ?>

<script type="text/javascript">
  // <![CDATA[
  jQuery(document).ready(function() {
    jQuery('#file_upload').uploadify({
      'uploader'  : '/uploadify/uploadify.swf',
      'sizeLimit' : <?php echo sfConfig::get('post_photo_size') ?>,
      'fileExt'   : '*.jpg;*.gif;*.png',
      'fileDesc'  : '<?php echo __('Photos') ?>',
      'script'    : '<?php echo url_for("@file_upload_post?filename=" . md5(time()), true) ?>',
      'cancelImg' : '/uploadify/cancel.png',
      'folder'    : '/uploads/posts',
      'auto'      : true,
      'onComplete': function(event, ID, fileObj, response, data){
        jQuery('#post_photo_file').val(response);
      },
      'onError'     : function (event, ID, fileObj, errorObj) {
        jAlert('<?php echo __('Max image size i 1M, allowed formats are *.jpg, *.png and *.gif') ?>');
      }
    });
  });
  // ]]>
</script>
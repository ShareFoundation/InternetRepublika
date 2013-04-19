<div id="div-post-link">
  <form id="form-post-link">
    <ul>
      <?php echo $form['link_url']->renderRow() ?>
      <?php echo $form['title']->renderRow() ?>
      <?php echo $form['text']->renderRow() ?>
      <li>
        <ul>
          <li id="url_images">&nbsp;</li>
        </ul>
      </li>
      <?php echo $form['tags']->renderRow() ?>
      <li>
        <button type="button" onclick="ajaxRenderComponent('posts', 'create_post_link', jQuery('#form-post-link').serialize(), function(data){afterSavePost(data)}, function(){jQuery('#div-post-link').html('<?php echo __('Loading') . '...' ?>')})"><?php echo __('Save') ?></button>
        <button type="button" onclick="closeModal('modal-post')"><?php echo __('Close') ?></button>
      </li>
    <?php echo $form['submited'] ?>
    <?php echo $form['id'] ?>
    <?php echo $form['partie_id'] ?>
    <?php echo $form['type'] ?>
    <?php echo $form['_csrf_token'] ?>   
    <?php echo $form['link_image'] ?>
    </ul>
  </form>
</div>

<?php if (0/*!$form->getObject()->isNew() && (!$sf_user->getGuardUser()->getProfile()->isUserPost($form->getObject()))*/) { ?>
  <script>
    jQuery('#div-post-link li').hide();
    jQuery('#div-post-link .checkbox_list').parent().show();
    jQuery('#div-post-link .checkbox_list li').show();
  </script>
<?php } ?>

<script>
  var images = new Array();
  var currentImage = 0;
  jQuery('#post_link_url').live('blur', function(){
    var value = jQuery(this).val();
    if(value != '')
    {
      ajaxRenderComponent('posts', 'link_data', 'link=' + value, function(data) {
        var obj = jQuery.parseJSON(data);
        jQuery('#post_title').val(obj.title);
        jQuery('#post_text').val(obj.description);
        
        var output = '';
        currentImage = 0;
        if(obj.images.length > 0) {
          images = obj.images;
          output = output + '<a href="javascript: void(0);" onclick="prevImage()" id="">Prev</a><img src="' + obj.images[currentImage] + '" width="260" height="260" style="border: 1px solid black;" id="selected-link-image" /><a href="javascript: void(0);" onclick="nextImage()" id="">Next</a><br/><span id="link-image-pager">1 of ' + images.length + '</div>';
          jQuery('#post_link_image').val(images[currentImage]);
        }
        jQuery('#url_images').html(output);
      }, function(){ jQuery('#url_images').html('<?php echo __('Loading') . '...' ?>'); });
    }
  });
  
  function nextImage()
  {
    if(currentImage == (images.length - 1))
      return 0;
    currentImage = currentImage + 1;
    changePager();
    jQuery('#selected-link-image').attr('src', images[currentImage]);
  }
  function prevImage()
  {
    changePager();
    if(currentImage == 0)
      return 0;
    currentImage = currentImage - 1;
    changePager();
    jQuery('#selected-link-image').attr('src', images[currentImage]);
  }
  
  function changePager()
  {
    jQuery('#post_link_image').val(images[currentImage]);
    jQuery('#link-image-pager').html(currentImage + 1 + ' of ' + images.length);
  }
</script>
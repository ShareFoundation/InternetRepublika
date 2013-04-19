<?php include_partial('global/flashes') ?>

<form id="form-create-party">
  <ul>
    <?php echo $form->renderGlobalErrors() ?>
    <?php echo $form['name']->renderRow() ?>
    <?php echo $form['bio']->renderRow() ?>
    <?php echo $form['facebook_page']->renderRow() ?>
    <li>
      <?php echo $form['logo']->renderRow() ?>
      <?php if($party != null && $party->getLogo() != ''){ ?>
        <div class="edit-party-logo">
          <?php echo include_partial('main/draw_party_logo', array('party' => $party, 'width' => 120, 'height' => 120)) ?><br/>
          <?php echo $form['remove_logo'] ?> <label><?php echo __('Remove Photo') ?></label>
        </div>
      <?php } ?>
      <input id="file_upload" type="file" name="file_upload" />
    </li>
    <?php echo $form['submited'] ?>
    <?php echo $form['id'] ?>
    <?php echo $form['user_id'] ?>
    <?php echo $form['_csrf_token'] ?>
  </ul>
  <br/> <br/>
  <button type="button" onclick="ajaxRenderComponent('user', 'create_party', jQuery('#form-create-party').serialize(), function(data){after<?php echo ($party != null)?'Edit':'' ?>SaveParty(data)}, function(){jQuery('#form-create-party').html('<?php echo __('Loading') . '...' ?>')})">
    <?php echo($party == null)?__('Create'):__('Edit') ?> <?php echo __('Party') ?>
  </button>
  <button type="button" onclick="closeModal('modal-party<?php echo($party != null)?'-edit':'' ?>')"><?php echo __('Close') ?></button>
</form>

<script type="text/javascript">
  // <![CDATA[
  jQuery(document).ready(function() {
    jQuery('#file_upload').uploadify({
      'uploader'  : '/uploadify/uploadify.swf',
      'sizeLimit' : <?php echo sfConfig::get('party_logo_size') ?>,
      'fileExt'   : '*.jpg;*.gif;*.png',
      'fileDesc'  : 'Slike',
      'script'    : '<?php echo url_for("@file_upload_party?filename=" . md5(time()), true) ?>',
      'cancelImg' : '/uploadify/cancel.png',
      'folder'    : '/uploads/parties',
      'auto'      : true,
      'onComplete': function(event, ID, fileObj, response, data){
        jQuery('#partie_logo').val(response);
      },
      'onError'     : function (event, ID, fileObj, errorObj) {
        jAlert('<?php echo __('Max image size i 1M, allowed formats are *.jpg, *.png and *.gif') ?>');
      }
    });
  });
  // ]]>
</script>
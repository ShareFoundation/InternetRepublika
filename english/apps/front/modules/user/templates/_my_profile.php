<?php include_partial('global/flashes') ?>

<ul>
    <li class="top"><label><?php echo __('Profile photo') ?></label><hr/></li>
    <li id="profile_image"><?php include_component('user', 'profile_image') ?></li>
    <li><input id="file_upload" type="file" name="file_upload" /></li>
</ul>
<br/>
<form id="form-my-profile">
    <ul>
        <li class="top"><label><?php echo __('Basic data') ?></label><hr/></li>
        <?php echo $form['first_name']->renderRow() ?>
        <?php echo $form['last_name']->renderRow() ?>
        <?php echo $form['username']->renderRow() ?>
        <?php echo $form['email']->renderRow() ?>
    </ul>
    <br/>
    <ul>
        <li class="top"><label><?php echo __('Change password') ?></label><hr/></li>
        <?php echo $form['password']->renderRow() ?>
        <?php echo $form['confirm_password']->renderRow() ?>
    </ul>
    <?php echo $form->renderHIddenFields() ?>
    <button type="button" onclick="ajaxRenderComponent('user', 'my_profile', jQuery('#form-my-profile').serialize(), function(data){afterSaveProfile(data)}, function(){jQuery('#form-my-profile').html('<?php echo __('Loading') . '...' ?>')})"><?php echo __('Save') ?></button>
    <button type="button" onclick="closeModal('modal-profile')"><?php echo __('Close') ?></button>
</form>

<div class="buttonDelete"><a href="javascript: void(0);" onclick="deleteUser()"><?php echo __('Delete Account') ?></a></div>

<script type="text/javascript">
    // <![CDATA[
    jQuery(document).ready(function() {
        jQuery('#file_upload').uploadify({
            'uploader'  : '/uploadify/uploadify.swf',
            'sizeLimit' : <?php echo sfConfig::get('profile_image_size') ?>,
            'fileExt'   : '*.jpg;*.gif;*.png',
            'fileDesc'  : 'Slike',
            'script'    : '/file-upload/hash/<?php echo $sf_user->getGuardUser()->getId() ?>/filename/<?php echo md5(time()) ?>/',
            'cancelImg' : '/uploadify/cancel.png',
            'folder'    : '/uploads/member_profiles/<?php echo $sf_user->getGuardUser()->getId() ?>',
            'auto'      : true,
            onComplete: function(data){
                jAlert('<?php echo __('Image has been successfully uploaded.') ?>');
                ajaxRenderComponent('user', 'profile_image', '', function(data){ jQuery('#profile_image').html(data); jQuery('#header-user-image').html(data); }, function(){ jQuery('#profile_image').html('Učitavanje...');});
            },
            'onError'     : function (event, ID, fileObj, errorObj) {
                jAlert('<?php echo __('Max image size i 1M, allowed formats are *.jpg, *.png and *.gif') ?>');
            }
        });
    });
    // ]]>
</script>
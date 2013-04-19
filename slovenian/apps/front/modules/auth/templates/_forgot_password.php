<div id="div-forgot-password">
  <form id="form-forgot-password">
    <?php echo $form ?>
    <button type="button" onclick="ajaxRenderComponent('auth', 'forgot_password', jQuery('#form-forgot-password').serialize(), function(data){afterForgotPassword(data)}, function(){jQuery('#div-forgot-password').html('<?php echo __('Loading') . '...' ?>)})"><?php echo __('Send new password') ?></button>
  </form>
</div>
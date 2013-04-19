<div id="div-login">
    <h1><?php echo __('Login') ?></h1>
    <form id="form-login">
        <?php echo $form ?>
      <div class="btnLogin"> <button type="button" onclick="ajaxRenderComponent('auth', 'login', jQuery('#form-login').serialize(), function(data){afterLogin(data)}, function(){jQuery('#div-login').html('<?php echo __('Loading') . '...' ?> ')})"><?php echo __('Login') ?></button></div><div class="regLink"> | <a href="javascript: void(0);" onclick="popRegisterToggle()"><?php echo __('Register') ?></a></div>  
        <a class="forgot-pass" href="javascript: void(0)" onclick="ajaxRenderComponent('auth', 'forgot_password', '', function(data){jQuery('#modal-register').html(data);}, function(){jQuery('#modal-register').html('<?php echo __('Loading') . '...' ?> ')})"><?php echo __('Forgot password?') ?></a>
        
    </form>
</div>
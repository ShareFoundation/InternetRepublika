<form id="form-register">
    <?php echo $form ?>
    <div class="btnLogin"> <button type="button" onclick="ajaxRenderComponent('auth', 'register', jQuery('#form-register').serialize(), function(data){afterRegister(data)}, function(){jQuery('#div-register').html('<?php echo __('Loading') . '...' ?> ')})"><?php echo __('Register') ?></button> </div>
</form>

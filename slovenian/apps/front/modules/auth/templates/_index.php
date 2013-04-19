<?php if (!$sf_user->isAuthenticated()) { ?>

  <?php include_component('auth', 'login') ?>

  <div id="div-register">
    <h1><?php echo __('Register') ?></h1>
    <?php include_component('auth', 'register') ?>
  </div>
    
<?php } else { ?>
  <?php echo __('You are already logged in.') ?>
  <button onclick="ajaxRenderComponent('auth', 'logout', '', function(data){ afterLogout(data) })"><?php echo __('Log Out') ?></button>
  <button onclick="closeModal('modal-register')"><?php echo __('Close') ?></button>
<?php } ?>

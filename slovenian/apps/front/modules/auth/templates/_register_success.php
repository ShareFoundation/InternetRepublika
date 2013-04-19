<p>
  <strong><?php echo __('You have successfully regsitered.') ?></strong>
</p>

<?php insertContent('Register Success') ?>

<p>
  <button type="button" onclick="finishRegister()">OK</button>       
</p>

<script>
  function finishRegister(){
    var data = '';
    data = data + '<?php echo ($sf_request->getParameter('sent', 0) == 0)?"&sent=1":"" ?>';
    ajaxRenderComponent('auth', 'register_success', data, function(data) {
      closeModal('finish-register');
    }, function(){
      closeModal('finish-register');
      jQuery('#finish-register').html("Učitavanje...");
    });
  }
</script>
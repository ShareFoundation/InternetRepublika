<?php include_partial('global/flashes') ?>
<h1>Settings</h1>

<form action="<?php echo url_for('settings/index', true) ?>" method="post" enctype="multipart/form-data">
  <div id="tabs">
    <ul>
      <li><a href="#tabs-1">Global</a></li>
      <li><a href="#tabs-2">Social Networks</a></li>
    </ul>
    <div id="tabs-1">
      <table>
        <?php echo $form1 ?>
      </table>
    </div>
    <div id="tabs-2">
      <table>
        <?php echo $form2 ?>
      </table>
    </div>
  </div>
  <br/>
  <ul class="sf_admin_actions settings-actions">
    <li class="sf_admin_action_save"><input type="submit" value="Save"></li>
  </ul>
</form>

<script>
  jQuery(function() {
    jQuery("#tabs").tabs();
  });
</script>
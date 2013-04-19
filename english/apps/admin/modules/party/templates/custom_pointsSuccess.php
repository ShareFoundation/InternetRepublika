<?php use_helper('I18N', 'Date') ?>
<?php include_partial('party/assets') ?>

<div id="sf_admin_container">
  <h1>Parties Custom Points</h1>
  <h3>Party: <?php echo $party->getName() ?></h3>

  <?php include_partial('party/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('party/list_header') ?>
  </div>

  <style>
    label[for=partie_custom_points_points] { float: none !important; }
  </style>
  
  <div id="sf_admin_content" style="margin-bottom: 40px;">
    <form action="<?php echo url_for('partie_collection', array('action' => 'custom_points', 'id' => $party->getId())) ?>" method="post">
      <?php echo $form ?>
      <input type="submit" value="Save" />
    </form>
  </div>
  
  
  <div id="sf_admin_content" class="log sf_admin_list">
    <?php if(!empty($logList) && count($logList) > 0){ ?>  
      <table border="0" cellpading="0" cellspaceing="0">
        <tr>
          <th>Points</th>
          <th>Admin</th>
          <th>Date</th>
        </tr>
        <?php foreach($logList as $log){ ?>
          <tr>
            <td><?php echo $log->getPoints() ?></td>
            <td><?php echo $log->getsfGuardUser()->getProfile()->getFullName() ?></td>
            <td><?php echo $log->getCreatedAt() ?></td>
          </tr>
        <?php } ?>
      </table>
    <?php }else{ ?>
      <div class="no-log">There are no logs for this party.</div>
    <?php } ?>
  </div>
  
  <ul class="sf_admin_actions">
    <li class="sf_admin_action_list"><a href="/backoffice/index.php/party">Back to list</a></li>
  </ul>

</div>

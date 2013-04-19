<?php if (!empty($partyList) && count($partyList) > 0) { $i = 0; ?>
  <div style="float: left; width: 100%;">
    <?php foreach ($partyList as $party) { $i++;  ?>
       <?php include_partial('parties/party_box', array('party' => $party)) ?>
       <?php if($i == 2){ $i = 0; ?>
         </div><div style="float: left; width: 100%;">
       <?php } ?>
    <?php } ?>
  </div>
<?php } else { ?>
  <?php if(!$sf_request->isXmlHttpRequest()){ ?>
    <div class="no-object">
      <?php echo __('There are no parties') ?>
    </div>
  <?php } ?>
<?php } ?>

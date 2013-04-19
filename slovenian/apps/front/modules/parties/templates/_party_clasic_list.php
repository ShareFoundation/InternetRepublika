<?php if (!empty($partyList) && count($partyList) > 0) { $i = 0; ?>
  <?php foreach ($partyList as $party) { $i++;  ?>
     <?php include_partial('parties/party_clasic_box', array('party' => $party)) ?>
     <?php if($i == 2){ $i = 0; ?>
     <?php } ?>
  <?php } ?>
<?php } else { ?>
<?php } ?>
  <?php if (!isset($width))
    $width = 32; ?>
  <?php if (!isset($height))
    $height = 32; ?>
<?php if ($party->getLogo() != '' && $party->getLogo() != null) { ?>
  <?php

  if ($width < 64) {
    $noPhoto = 'no-content-64x64.png';
  } else {
    $noPhoto = 'no-content.png';
  }
  ?>
  <?php echo thumbnail_tag($party->getImageRealUrl(), $width, $height, array('alt' => $party->getName(), 'title' => $party->getName()), true, false, false, $noPhoto) ?>
<?php } ?>
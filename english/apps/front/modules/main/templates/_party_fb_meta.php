<meta property="og:title" content="<?php echo $party->getName() ?>" /> 
<?php if($party->getLogo() != '' && $party->getLogo() != null){ ?>
  <meta property="og:image" content="<?php echo thumbnail_tag($party->getImageRealUrl(), 120, 120, array(), true, false, true) ?>" />
<?php } ?>
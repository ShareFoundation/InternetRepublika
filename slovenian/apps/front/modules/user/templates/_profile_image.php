<?php if(!isset($width)) $width = 32; ?>
<?php if(!isset($height)) $height = 32;  ?>
<?php echo thumbnail_tag($sf_user->getGuardUser()->getProfile()->getProfileImageUrl(), $width, $height, array('alt' => $sf_user->getGuardUser()->getProfile()->getFullName(), 'title' => $sf_user->getGuardUser()->getProfile()->getFullName()), true, false, false, 'avatar.png') ?>
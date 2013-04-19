<?php if(!isset($width)) $width = 260; ?>
<?php if(!isset($height)) $height = 450; ?>
<?php echo thumbnail_tag($post->getPhotoImageUrl(), $width, $height, array('alt' => $post->getTitle(), 'class' => 'postPhoto', 'title' => $post->getTitle()), false) ?>
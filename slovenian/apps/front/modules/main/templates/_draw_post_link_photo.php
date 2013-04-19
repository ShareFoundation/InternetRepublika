<?php if(!isset($width)) $width = 90; ?>
<?php if(!isset($height)) $height = 90; ?>
<?php echo thumbnail_tag($post->getLinkImageUrl(), $width, $height, array('alt' => $post->getTitle(), 'title' => $post->getTitle()), false) ?>
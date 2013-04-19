<?php if ($sf_user->hasFlash('error')){ ?><p class="error"><?php echo $sf_user->getFlash('error') ?></p><?php } ?>
<?php if ($sf_user->hasFlash('success')){ ?><p class="success"><?php echo $sf_user->getFlash('success') ?>.</p><?php } ?>
<?php if ($sf_user->hasFlash('warning')){ ?><p class="error"><?php echo $sf_user->getFlash('warning') ?></p><?php } ?>
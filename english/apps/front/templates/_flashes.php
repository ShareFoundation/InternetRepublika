<?php if ($sf_user->hasFlash('notice')): ?>
    <div class="flash-notice">
        <?php echo html_entity_decode($sf_user->getFlash('notice')) ?>
    </div>
<?php endif; ?>

<?php if ($sf_user->hasFlash('error')): ?>
    <div class="flash-error"><?php echo html_entity_decode($sf_user->getFlash('error')) ?></div>
<?php endif; ?>
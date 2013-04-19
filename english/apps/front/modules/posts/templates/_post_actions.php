<?php $user = $sf_user->getGuardUser() ?>

<?php if($sf_user->isAuthenticated() && (($user->getProfile()->getParty() != null && $user->getProfile()->getParty()->getId() == $post->getPartieId()) || $user->getIsSuperAdmin())){ ?>
  <div class="actions">
    <?php if($sf_user->getGuardUser()->getIsSuperAdmin()){ ?>
      <?php if($post->getIsFeatured()){ ?>  
        <span class="edit"><a href="javascript: void(0)" onclick="featured(<?php echo $post->getId() ?>)"><?php echo __('Unfeature') ?></a></span>
      <?php }else{ ?>
        <span class="edit"><a href="javascript: void(0)" onclick="featured(<?php echo $post->getId() ?>)"><?php echo __('Feature') ?></a></span>
      <?php } ?>
    <?php } ?>
      
    <?php if($user->getIsSuperAdmin()){ ?>
      <span class="edit"><a href="javascript: void(0)" onclick="showEditPostDialog(<?php echo $post->getId() ?>)"><img src="/images/front/edit.png" alt="<?php echo __('Edit') ?>" title="<?php echo __('Edit') ?>" /></a></span>
    <?php }else if($user->getProfile()->getParty() != null && $user->getProfile()->getParty()->getId() == $post->getPartieId() && (time() - strtotime($post->getCreatedAt())) <= (30 * 60)){ ?>
      <span class="edit"><a href="javascript: void(0)" onclick="showEditPostDialog(<?php echo $post->getId() ?>)"><img src="/images/front/edit.png" alt="<?php echo __('Edit') ?>" title="<?php echo __('Edit') ?>" /></a></span>
    <?php } ?>
    <span class="delete"><a href="javascript: void(0)" onclick="deletePost(<?php echo $post->getId() ?>)"><img src="/images/front/delete.png" alt="<?php echo __('Remove') ?>" title="<?php echo __('Remove') ?>" /></a></span>
  </div>
<?php } ?>
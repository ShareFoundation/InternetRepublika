<?php $user = $sf_user->getGuardUser() ?>
<div id="rightSide">
  <?php if ($user->getProfile()->getParty() == null) { ?>
    <div id="addPartija"><a href="javascript: void(0)" onclick="showPartyDialog()"><?php echo __('Create Party') ?></a></div>
  <?php } else { ?>
    <div id="addStav"><div class="stav"><a href="javascript: void(0)" onclick="showPostDialog()"><?php echo __('Create Post') ?></a></div></div>
    <div id="addedPartija">
      <a href="<?php echo $user->getProfile()->getParty()->getLink() ?>"><?php echo $user->getProfile()->getParty()->getName() ?></a>
    </div>
  <?php } ?>
  <div id="user" style=" background:  black">
    <span id="header-user-image"><?php include_component('user', 'profile_image') ?></span>
    <span class="name"><a href="javascript: void(0)"><?php echo $user ?></a></span>
    <div class="user-header-popup" style="display: none;">
      <ul>
        
      </ul>
    </div>
  </div>
  <div class="userOption">
    <ul>
      <li><a href="javascript: void(0);" onclick="showMyProfileDialog()"><?php echo __('My Profile') ?></a></li>
      <?php if ($user->getProfile()->getParty() != null) { ?>
        <li><a href="javascript: void(0);" onclick="showPartyEditDialog()"><?php echo __('Edit Party') ?></a></li>
        <li><a href="javascript: void(0);" onclick="deletePartie()"><?php echo __('Remove Party') ?></a></li>
      <?php } ?>
      <li class="last"><a href="javascript: void(0)" onclick="ajaxRenderComponent('auth', 'logout', '', function(data){ afterLogout(data) })"><?php echo __('Log Out') ?></a></li>
    </ul>
  </div>
</div>
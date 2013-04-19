<div class="leftSidebar">
  <?php if (!in_array($sf_context->getModuleName(), array('news', 'mg_page', 'contact'))) { ?>
    <div class="badgeDescription"><?php echo __('VOTE: DRAG MEDAL & BADGE!') ?></div>
    <div class="block open">
      <div class="title"><span class="name"><?php echo __('Medals') ?></span></div>
      <?php if (!empty($badge1)) { ?>
        <div class="badges">
          <?php foreach ($badge1 as $badge) { ?>
            <div class="badge" badge_type="<?php echo $badge->getTypeId() ?>" badge_id="<?php echo $badge->getId() ?>"><a class="tooltip badge-universal" style="background-image: url('<?php echo $badge->getImageUrl() ?>') !important;" href="javascript: void(0);" title="<?php echo $badge->getName() ?> - <?php echo $badge->getDescription() ?>"><?php echo $badge->getName() ?> - <?php echo $badge->getDescription() ?></a></div>
          <?php } ?>
        </div>
      <?php } ?>
    </div>
    
    <?php if((bool) ConfigurationPeer::get('use_badges', 1)){ ?>
      <div class="block open">
        <div class="title"><span class="name"><?php echo __('Badges') ?></span></div>
        <?php if (!empty($badge2)) { ?>
          <div class="badges">
            <?php foreach ($badge2 as $badge) { ?>
              <div class="badge" badge_type="<?php echo $badge->getTypeId() ?>" badge_id="<?php echo $badge->getId() ?>"><a class="tooltip badge-universal" style="background-image: url('<?php echo $badge->getImageUrl() ?>') !important;" href="javascript: void(0);" title="<?php echo $badge->getName() ?>"><?php echo $badge->getName() ?></a></div>
            <?php } ?>
          </div>
        <?php } ?>
      </div>
    <?php } ?>
    
    
    <div class="block close">
      <div class="title"><span class="name"><?php echo __('Report post') ?></span></div>
      <?php if (!empty($badge4)) { ?>
        <div class="badges" style="display: none;">
          <?php foreach ($badge4 as $badge) { ?>
            <div class="badge" badge_type="<?php echo $badge->getTypeId() ?>" badge_id="<?php echo $badge->getId() ?>"><a class="tooltip badge-universal" style="background-image: url('<?php echo $badge->getImageUrl() ?>') !important;" href="javascript: void(0);" title="<?php echo $badge->getName() ?>"><?php echo $badge->getName() ?> - <?php echo $badge->getDescription() ?></a></div>
          <?php } ?>
        </div>
      <?php } ?>
    </div>
  <?php } ?>

  <div class="leftMenu">
    <?php $menuItems = MenuPeer::getChildMenus(2) ?>
    <?php $i = 0 ?>
    <?php if (count($menuItems) > 0) { ?>
      <ul>
        <?php foreach ($menuItems as $item) {
          $i++; ?>
          <li <?php echo $i == count($menuItems) ? 'class="last"' : '' ?>><a href="<?php echo $item->getParsedLink() ?>" <?php echo ($item->getIsTargetBlank()) ? 'target="_blank"' : '' ?>><?php echo $item->getTitle() ?></a></li>
      <?php } ?>
      </ul>
    <?php } ?>
    <a target="_blank" href="http://www.implementek.com" style="font-family: arial; font-size:10px; text-align:left; text-transform: uppercase; line-height: 12px; display:block; margin-left:12px;"><?php echo __('Design & development') ?><br/> <strong>Implementek</strong></a>
  </div>
</div>

<script>
  jQuery(".leftSidebar .title").live('click', function() {
    jQuery('.badges', jQuery(this).parent()).toggle();
    if (jQuery(this).parent().hasClass('open')) {
      jQuery(this).parent().removeClass('open');
      jQuery(this).parent().addClass('close');
    } else {
      jQuery(this).parent().removeClass('close');
      jQuery(this).parent().addClass('open');
    }
  });

  jQuery(".leftSidebar .badge").draggable({revert: true});
</script>
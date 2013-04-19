<div class="indexTop">
  <div class="title"><?php echo __('Support Index') ?></div>
  <div class="indexRang"> <?php echo $post->getIndexOfSupport() ?> </div>
</div>
<div class="indexContent">
  <div class="indexBlock">
    <div class="indexTitle"><span class="name"><?php echo __('Medals') ?></span></div>
    <div class="badges">
      <?php if (!empty($badge1)) { ?>
        <?php foreach ($badge1 as $badge) { ?>
          <div class="badge"><a title="<?php echo $badge->getName() ?>" href="javascript: void(0);" class="badge-universal tooltip" style="background-image: url('<?php echo $badge->getImageUrl() ?>');">&nbsp;</a><span class="total"><?php echo $badge->getPostBadgeCount($post->getId()) ?></span></div>
        <?php } ?>
      <?php } ?>
    </div>
  </div>
  <div class="indexBlock">
    <div class="indexTitle"><span class="name"><?php echo __('Colected Badges') ?></span></div>
    <div class="badges">
      <?php if (!empty($badge2)) { ?>
        <?php foreach ($badge2 as $badge) { ?>
          <div class="badge"><a title="<?php echo $badge->getName() ?>" href="javascript: void(0);" class="badge-universal tooltip" style="background-image: url('<?php echo $badge->getImageUrl() ?>');">&nbsp;</a><span class="total"><?php echo $badge->getPostBadgeCount($post->getId()) ?></span></div>
        <?php } ?>
      <?php } ?>
    </div>
  </div>
</div>
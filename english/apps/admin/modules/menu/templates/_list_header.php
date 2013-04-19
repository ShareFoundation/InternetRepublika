<?php
$parent = $sf_user->getAttribute('filter_parent', null);
$Menu = MenuPeer::retrieveByPK($parent);
?>

<?php if ($Menu) { ?>
  <?php $path = MenuPeer::getMenuPath(MenuPeer::retrieveByPK($parent)); ?>
  <?php $path = array_reverse($path); ?>
  <ul class="admin-category-navigation">
    <li><a href="<?php echo url_for('menu/index?parent_id=0', true) ?>">Root</a></li>
    <?php foreach ($path as $item) { ?>
      <li> > <a href="<?php echo url_for('menu/index?parent_id=' . $item->getId(), true) ?>"><?php echo $item->getTitle() ?></a></li>
    <?php } ?>
  </ul>
<?php } ?>
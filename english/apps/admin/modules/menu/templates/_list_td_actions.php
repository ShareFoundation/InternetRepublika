<td>
  <ul class="sf_admin_td_actions">
    <?php echo $helper->linkToEdit($Menu, array(  'params' =>   array(  ),  'class_suffix' => 'edit',  'label' => 'Edit',)) ?>
    <?php echo $helper->linkToDelete($Menu, array(  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
    <li><a href="<?php echo url_for('menu/index?parent_id='. $Menu->getId(), true) ?>">Sub items</a></li>
  </ul>
</td>

<td width="120">
  <ul class="sf_admin_td_actions">
    <?php echo $helper->linkToDelete($Inappropriate, array(  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete Report',)) ?>
    <li class="sf_admin_action_view">
      <?php echo link_to(__('View', array(), 'messages'), 'flag_view/view?id='.$Inappropriate->getId(), array('target' => '_blank')) ?>
    </li>
  </ul>
</td>

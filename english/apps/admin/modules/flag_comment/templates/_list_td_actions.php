<td>
  <ul class="sf_admin_td_actions">
    <li class="sf_admin_action_view">
      <?php if ($InappropriateComment->getComment()->getItemType() == 1) { ?>
        <?php echo link_to(__('View Partie', array(), 'messages'), cross_app_url_for('front', '@post_view?url=' . $InappropriateComment->getComment()->getItemUrl()), array('target' => '_blank')) ?>
      <?php }else { ?>
        <?php echo link_to(__('View Post', array(), 'messages'), cross_app_url_for('front', '@party_view?url=' . $InappropriateComment->getComment()->getItemUrl()), array('target' => '_blank')) ?>
      <?php } ?>
    </li>
    <li class="sf_admin_action_delete">
      <?php echo link_to('Delete Comment', url_for('flag_comment/ListDelete?id=' . $InappropriateComment->getComment()->getId(), true), array('confirm' => 'Are you sure?')) ?>
    </li>
  </ul>
</td>

<?php use_helper('I18N', 'Date') ?>
<?php include_partial('flag_view/assets') ?>

<?php $post = PostPeer::retrieveByPK($sf_user->getAttribute('postId', null)); ?>

<div id="sf_admin_container">
  <h1>Report Post: "<?php echo $post->getTitle() ?>"</h1>

  <?php include_partial('flag_view/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('flag_view/list_header', array('pager' => $pager)) ?>
  </div>

  <div id="sf_admin_bar">
    <?php include_partial('flag_view/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('flag_view/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?>
    <ul class="sf_admin_actions">
      <?php include_partial('flag_view/list_batch_actions', array('helper' => $helper)) ?>
      <?php include_partial('flag_view/list_actions', array('helper' => $helper)) ?>
    </ul>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('flag_view/list_footer', array('pager' => $pager)) ?>
  </div>
</div>

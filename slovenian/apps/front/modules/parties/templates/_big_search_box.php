<div id="search-top">
  <form action="<?php echo url_for('@party_search') ?>" method="get">
    <div class="inputfield"><label><?php __('Search Parties') ?></label>
      <input id="party-search" name="query" type="text" value="<?php echo $sf_request->getParameter('query', '') ?>" /></div>
    <div class="searchButton-top">
      <input name="" type="submit" value="<?php echo __('search') ?>" />
    </div>
  </form>
  <div class="view-mode">
    <?php if ($sf_context->getActionName() == 'index') { ?>
      <div class="grid"><a href="<?php echo url_for('@party_index', true) ?>"><img src="/images/front/grid.png" width="28" height="28" align="left" /></a></div>
      <div class="list"><a href="<?php echo url_for('@party_index?type=lista', true) ?>"><img src="/images/front/list.png" width="28" height="28" align="left" /></a></div>
    <?php } else { ?>
      <?php if ($sf_request->getParameter('query', null) != null) { ?>
        <?php $query = 'query=' . $sf_request->getParameter('query', null); ?>
      <?php } else { ?>
        <?php $query = ''; ?>
      <?php } ?>
      <div class="grid"> <a href="<?php echo url_for('@party_search?' . $query) ?>"><img src="/images/front/grid.png" width="28" height="28" /></a></div>
      <div class="list"> <a href="<?php echo url_for('@party_search?' . $query . '&type=lista', true) ?>"><img src="/images/front/list.png" width="28" height="28" /></a></div>
    <?php } ?>
  </div>
</div>

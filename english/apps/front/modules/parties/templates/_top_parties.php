<div id="lists">
  <div class="listTitle"> <?php echo __('Party Rankings') ?>Rang Lista Partija </div>
  <div class="listContent">
    <ul>
      <?php foreach (PartiePeer::getTopParties(5) as $val) { ?>
        <li>
          <div class="list">
            <h2><a href="<?php echo $val->getLink() ?>"><?php echo $val->getName() ?></a></h2>
          </div>
          <div class="listImage"><?php echo include_partial('main/draw_party_logo', array('party' => $val, 'width' => 32, 'height' => 32)) ?></div>
        </li>
      <?php } ?>
    </ul>
  </div>
</div>
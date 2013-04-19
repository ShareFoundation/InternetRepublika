<div class="partyList" style="width: 810px;">
  <div class="partyTopRank">
    <div class="partyRank"><span class="partyRankNumber"><?php echo $party->getRealRang() ?></span></div>
    <div class="partyTitleRank"><?php echo include_partial('main/draw_party_logo', array('party' => $party, 'width' => 29, 'height' => 29)) ?></div>
    <div class="partyTitleRank name"><a href="<?php echo $party->getLink() ?>"><?php echo $party->getName() ?></a></div>
    <div class="partyRankSupport"><?php echo __('Support Index') ?> <span class="partyRankNumber"><?php echo $party->getRang() ?></span></div>
  </div>
</div>
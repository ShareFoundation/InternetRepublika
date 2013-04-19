<div class="partyR">
  <div class="partyTopRank">
    <div class="partyTitleRank"><a href="<?php echo $party->getLink() ?>"><?php echo $party->getName() ?></a></div>
    <div class="partyRank"><?php __('Support Index') ?> <span class="partyRankNumber"><?php echo $party->getRang() ?></span></div>
  </div>
  <div class="clear"></div>
  <div class="partyContentRank">
    <div class="partyDescriptionRank">
      <div class="text"><?php echo $party->getBioLimited() ?><a class="readMore" href="<?php echo $party->getLink() ?>"><?php echo __('Read more') ?> </a></div>
      <?php echo include_partial('main/draw_party_logo', array('party' => $party, 'width' => 120, 'height' => 120)) ?>
    </div>
  </div>
  <?php $topComments = $party->getPartyPosts(3); ?>
  <?php if (!empty($topComments)) { ?>
    <div class="replicaContentRank">
      <ul>
        <?php foreach ($topComments as $post) { ?>
          <li>
            <div class="replicaRank">
              <h2><a href="<?php echo $post->getLink() ?>"><?php echo $post->getPrintTitle(37) ?></a></h2>

              <div class="socialRank">

                <div class="like-share">  
                  <a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo $post->getLink() ?>" data-text="<?php echo $post->getTitle() ?>" data-hashtags="netrepublika">Tweet</a>
                </div>
                <div class="like-share">
                  <iframe src="//www.facebook.com/plugins/like.php?href=<?php echo $post->getLink() ?>&amp;send=false&amp;layout=button_count&amp;width=150&amp;show_faces=true&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21&amp;appId=190915007686913" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:95px; height:21px;" allowTransparency="true"></iframe>
                </div>
              </div>
            </div>
            <div class="replicaCommentRank"><a href="<?php echo $post->getLink() ?>"><?php echo $post->getReplicaCount() ?> <?php echo __('Replicas') ?></a><br>
              <a href="<?php echo $post->getLink() ?>"><?php echo $post->getCommentsCount() ?> <?php echo __('Comments') ?></a></div>
          </li>
        <?php } ?>
      </ul>
    </div>
  <?php } ?>
</div>
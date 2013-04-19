<div id="leftColumn"> 
  <div id="party">
    <div class="party">
      <div class="partyTop">
        <div class="partyTitle"><?php echo $party->getName() ?></div>
        <div class="partyRang"><?php echo __('Rang') ?> <span class="rangNumber"><?php echo $party->getRealRang() ?></span></div>
      </div>
      <div class="clear"></div>
      <div class="partyContent">
        <div class="partyDescription">
          <div class="text"><?php echo nl2br($party->getBio()) ?></div>
          <?php echo include_partial('main/draw_party_logo', array('party' => $party, 'width' => 120, 'height' => 120)) ?>
        </div>

        <div class="partyCategory">
          <?php $tagList = $party->getTags() ?>
          <?php if (count($tagList) > 0) { ?>
            <div class="catLabel"><span class="name"><?php echo __('Used tags') ?></span></div>
            <div class="catList">
              <ul>
                <li>
                  <?php $i = 0; ?>
                  <?php foreach ($tagList as $tag) {
                    $i++;
                    ?>
                    <?php echo $tag->getName() ?><?php echo $i < count($tagList) ? ',' : '' ?>
  <?php } ?>
                </li>
              </ul>
            </div>
<?php } ?>
        </div>

      </div>
      <div class="partySocials">
        <div class="like-share">  
          <a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo $party->getLink() ?>" data-text="<?php echo $party->getName() ?>" data-hashtags="netrepublika">Tweet</a>
        </div>
        <div class="like-share">
          <iframe src="//www.facebook.com/plugins/like.php?href=<?php echo $party->getLink() ?>&amp;send=false&amp;layout=button_count&amp;width=500&amp;show_faces=true&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21&amp;appId=190915007686913" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:150px; height:21px;" allowTransparency="true"></iframe>
        </div>
      </div>
    </div>
  </div>

  <div id="posts" style="display: none;"> 
<?php include_component('posts', 'post_list', array('party' => $party)) ?>
  </div>

  <div id="footer-loader" style="display: none;"><?php echo __('Loading') . '...' ?></div>

  <script>
    var options = {
      autoResize: true, // This will auto-update the layout when the browser window is resized.
      container: jQuery('body'), // Optional, used for some extra CSS styling
      offset: 14, // Optional, the distance between grid items
      itemWidth: 262 // Optional, the width of a grid item
    };
    jQuery(window).bind('load', function() {
      jQuery('#posts').show();
      //jQuery('#posts .postBlock').wookmark(options);

      jQuery('#posts').masonry({
        itemSelector: '.postBlock',
        columnWidth: 262,
        gutterWidth: 14
      });

      jQuery(window).endlessScroll({
        bottomPixels: 1,
        fireDelay: 500,
        callback: function(p) {
          ajaxRenderComponent('posts', 'post_list', '', function(data) {
            jQuery('#posts').append(data).masonry('reload');
            redrawTwitterButton();
            jQuery('#footer-loader').hide();
          }, function() {
            jQuery('#footer-loader').show();
          });
        }
      });
    });

    var isUserLoggedIn = <?php echo ($sf_user->isAuthenticated()) ? 'true' : 'false' ?>;

    jQuery(document).ready(function() {
      drawDropable();
    });
  </script>

</div>

<div id="rightColumn"> 

  <div id="orientation">
<?php include_component('parties', 'orientation', array('party' => $party)) ?>
  </div>

  <?php if ($party->getFacebookPage() != '' || $party->getFacebookPage() != null) { ?>
    <div class="fb-like-box" data-href="<?php echo $party->getFacebookPage() ?>" data-width="262" data-show-faces="true" data-stream="true" data-header="true"></div>
  <?php } ?>

<?php include_partial('parties/support_letters', array('party' => $party)) ?>

  <div id="search">
    <div class="searchTitle">
      <h2><?php echo __('Search') ?></h2>
    </div>
    <form action="<?php echo url_for('@party_search') ?>" method="get">
      <input id="party-search" name="query" type="text" />
      <div class="searchButton">
        <input name="" type="submit" value="<?php echo __('Search') ?>" />
      </div>
    </form>
  </div>

<?php include_partial('parties/top_parties') ?>

</div>
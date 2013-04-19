<div id="posts" style="display: none;"> 
  <?php include_component('posts', 'post_list') ?>
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

          var imageCount = 0;
          var length = 0;
          if (jQuery.trim(data) != '') {
            length = jQuery(data).find('.postPhoto').length;
            if (length > 0) {
              jQuery(data).find('.postPhoto').each(function() {
                jQuery('<img />').attr('src', jQuery(this).attr('src')).load(function() {
                  imageCount++;
                  if (imageCount == length) {
                    jQuery('#posts').append(data).masonry('reload');
                    redrawTwitterButton();
                    jQuery('#footer-loader').hide();
                  }
                });
              });
            } else {
              jQuery('#posts').append(data).masonry('reload');
              redrawTwitterButton();
              jQuery('#footer-loader').hide();
            }
          } else {
            jQuery('#footer-loader').hide();
          }
        }, function() {
          jQuery('#footer-loader').show();
        });
      }
    });
  });

  var isUserLoggedIn = <?php echo ($sf_user->isAuthenticated()) ? 'true' : 'false' ?>;

  jQuery(document).ready(function() {
    drawDropable();
    jQuery('.postNews').droppable('destroy');
  });
</script>
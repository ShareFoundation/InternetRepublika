<div class="news-static-box">
  <?php include_component('news', 'news_list') ?>
</div>

<div id="footer-loader" style="display: none;"><?php echo __('Loading') . '...' ?></div>

<script>
  jQuery(document).ready(function(){
    jQuery(window).endlessScroll({
      bottomPixels: 1,
      fireDelay: 500,
      callback: function(p){
        ajaxRenderComponent('news', 'news_list', '', function(data) {
          jQuery('.news-static-box').append(data);
          redrawTwitterButton();
          jQuery('#footer-loader').hide();
        }, function(){
          jQuery('#footer-loader').show();
        });
      }
    });
  });
</script>
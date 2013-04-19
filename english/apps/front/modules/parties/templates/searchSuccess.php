<?php include_partial('parties/big_search_box') ?>

<div id="partyRank"> 
  <?php if($type == 'lista'){ ?>
    <?php include_component('parties', 'party_clasic_list') ?>
  <?php }else{ ?>
    <?php include_component('parties', 'party_list') ?>
  <?php } ?>
</div>

<div id="footer-loader" style="display: none;"><?php echo __('Loading') . '...' ?></div>

<script>
  <?php if($type == 'lista'){ ?>
    <?php $renderComponent = 'party_clasic_list'; ?>
  <?php }else{ ?>
    <?php $renderComponent = 'party_list'; ?>
  <?php } ?>
  
  jQuery(document).ready(function(){
    jQuery(window).endlessScroll({
      bottomPixels: 1,
      fireDelay: 500,
      callback: function(p){
        ajaxRenderComponent('parties', '<?php echo $renderComponent ?>', 'query=<?php echo $sf_request->getParameter('query') ?>', function(data) {
          jQuery('#partyRank').append(data);
          redrawTwitterButton();
          jQuery('#footer-loader').hide();
        }, function(){
          jQuery('#footer-loader').show();
        });
      }
    });
  });
</script>
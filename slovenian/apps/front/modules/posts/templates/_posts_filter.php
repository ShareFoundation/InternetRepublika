<div class="toolBar">
  <form id="filter-form">
    <input type="hidden" name="filter" value="1" />
    <div class="sort">
      <span class="label"><?php echo __('Sort by') ?></span>
      <a class="links menu6" href="javascript: void(0);"><?php echo __('rank') ?>
        <span class="filter-submenu">
          <span><input type="radio" class="radio_sort" name="rang_sort" value="1" id="danas_r" /> <label for="danas_r"><?php echo __('Today') ?></label></span>
          <span><input type="radio" class="radio_sort" name="rang_sort" value="2" id="nedelja_r" /> <label for="nedelja_r" ><?php echo __('This week') ?></label></span>
          <span><input type="radio" class="radio_sort" name="rang_sort" value="3" id="sve_r"  /> <label for="sve_r"><?php echo __('All') ?></label></span>
        </span>
      </a>
      <a class="links menu2" id="sort-hronoloski" href="javascript: void(0);"><?php echo __('Chronological') ?><input type="radio" style="display: none;" name="rang_sort" class="radio_sort" value="4" /></a>
      <a class="links active menu3" id="sort-popular" href="javascript: void(0);"><?php echo __('Popularity') ?><input type="radio" style="display: none;" name="rang_sort" class="radio_sort" value="5" /></a>
    </div>
    <div class="filter">
      <span class="label"><?php echo __('Filter by') ?></span>
      
      <a class="links menu7" href="javascript: void(0)"><?php echo __('tag') ?>
        <span class="filter-submenu">
          <span>
            <label><?php echo __('Filter by tag') ?>: </label><input type="text" name="tag_search" id="tag-search" />
            <input type="button" class="tagSearch button" value="<?php echo __('Search') ?>" />
          </span>
        </span>
      </a>

      <a class="links menu4" href="javascript: void(0)"><?php echo __('badge') ?>
        <span class="filter-submenu">
          <?php $badge1 = BadgePeer::getBadgesByType(1); ?>
          <?php $badge2 = BadgePeer::getBadgesByType(2); ?>
          <?php $badge3 = BadgePeer::getBadgesByType(3); ?>
          <span class="half">
            <span><?php echo __('Medals') ?></span>
            <?php foreach ($badge1 as $key=>$val) { ?>
              <span>
                <input type="checkbox" id="filter-badge1<?php echo $key ?>" name="badges1[]" value="<?php echo $val->getId() ?>" /> <label for="filter-badge1<?php echo $key ?>"><?php echo $val->getName() ?></label>
              </span>
            <?php } ?> 
          </span>
          <span class="half">
            <span><?php echo __('Badges') ?></span>
            <?php $i = 0; ?>
            <?php foreach ($badge2 as $key=>$val) { $i++; ?>
              <span>
                <input type="checkbox" id="filter-badge2<?php echo $key ?>" class="<?php echo($i <= 4)?'main-badge':'' ?>" name="badges2[]" value="<?php echo $val->getId() ?>" /> <label for="filter-badge2<?php echo $key ?>"><?php echo $val->getName() ?></label>
              </span>
            <?php } ?>
          </span>
          <span class="half">
            <span><?php echo __('neutral') ?></span>
            <?php foreach ($badge3 as $key=>$val) { ?>
              <span>
                <input type="checkbox" name="badges1[]" id="filter-badge3<?php echo $key ?>" value="<?php echo $val->getId() ?>" /> <label for="filter-badge3<?php echo $key ?>"><?php echo $val->getName() ?></label>
              </span>
            <?php } ?>
          </span>
        </span>
      </a>
      <a class="links menu1" href="javascript: void(0)"><?php echo __('type') ?>
        <span class="filter-submenu">
          <span><input type="checkbox" name="type[]" value="<?php echo PostPeer::TYPE_TEXT ?>" id="text_ch" /> <label for="text_ch"><?php echo __('Text') ?></label></span>
          <span><input type="checkbox" name="type[]" value="<?php echo PostPeer::TYPE_PHOTO ?>" id="slika_ch" /> <label for="slika_ch"><?php echo __('Photo') ?></label></span>
          <span><input type="checkbox" name="type[]" value="<?php echo PostPeer::TYPE_VIDEO ?>" id="video_ch" /> <label for="video_ch"><?php echo __('Video') ?></label></span>
          <span><input type="checkbox" name="type[]" value="<?php echo PostPeer::TYPE_QUOTE ?>" id="citat_ch" /> <label for="citat_ch"><?php echo __('Quote') ?></label></span>
          <span><input type="checkbox" name="type[]" value="<?php echo PostPeer::TYPE_LINK ?>" id="link_ch" /> <label for="link_ch"><?php echo __('Link') ?></label></span>
          <span><input type="checkbox" name="type[]" value="<?php echo PostPeer::TYPE_POLL ?>" id="anketa_ch" /> <label for="anketa_ch"><?php echo __('Poll') ?></label></span>
        </span>
      </a>
      <a class="links  menu6" href="javascript: void(0)"><?php echo __('interval') ?>
        <span class="filter-submenu">
          <span><input type="radio" name="interval" value="1" id="danas" /> <label for="danas"><?php echo __('Today') ?></label></span>
          <span><input type="radio" name="interval" value="2" id="nedelja" /> <label for="nedelja"><?php echo __('This Week') ?></label></span>
          <span><input type="radio" name="interval" value="3" checked="checked" id="sve" /> <label for="sve" ><?php echo __('All') ?></label></span>
        </span>
      </a>
    </div>
  </form>
</div>

<script>
  jQuery('.toolBar .links').live('mouseover', function(){
    jQuery('.filter-submenu', jQuery(this)).show();
  });
  jQuery('.toolBar .links').live('mouseout', function(){
    jQuery('.filter-submenu', jQuery(this)).hide();
  });
  jQuery('.toolBar input[type=checkbox], .toolBar input[type=radio]').live('click', function(){
    if(jQuery(this).hasClass('radio_sort')){
      if(jQuery('.toolBar input').val() == 1 || jQuery('.toolBar input').val() == 2 || jQuery('.toolBar input').val() == 3){
        jQuery('.main-badge').attr('checked','checked');
      }
    }
    ajaxRunPostFilter();
  });

  jQuery('.tagSearch').on('click', function(){
    ajaxRunPostFilter();
  });

  jQuery('#tag-search').on('keypress', function(e){
    if ( e.which == 13 ){
      ajaxRunPostFilter();
      e.preventDefault();
    }
  });

  jQuery('#sort-hronoloski').live('click', function(){
    jQuery('input[type=checkbox], input[type=radio]', jQuery(this)).attr('checked','checked');
    ajaxRunPostFilter();
  });
  jQuery('#sort-popular').live('click', function(){
    jQuery('input', jQuery(this)).attr('checked','checked');
    ajaxRunPostFilter();
  });
  
  var xhr = null;
  function ajaxRunPostFilter(){
    jQuery('.toolBar .sort a').removeClass('active');
    jQuery('.radio_sort:checked').each(function(){
      if(jQuery(this).val() == 1 || jQuery(this).val() == 2 || jQuery(this).val() == 3){
        jQuery(this).parent().parent().parent().addClass('active');
      }else{
        jQuery(this).parent().addClass('active');
      }
    });
    
    if(xhr != null){
      xhr.abort();
    }
    xhr = ajaxRenderComponent('posts', 'post_list', jQuery('#filter-form').serialize(), 
    function(data){
      
      
      var imageCount = 0;
          var length = 0;
          if(jQuery.trim(data) != ''){
            length = jQuery(data).find('.postPhoto').length;
            if(length > 0){
            jQuery(data).find('.postPhoto').each(function(){
              jQuery('<img />').attr('src', jQuery(this).attr('src')).load(function(){
                imageCount++;
                if(imageCount == length){
                  jQuery('#posts').append(data).masonry('reload');
                  redrawTwitterButton();
                  jQuery('#footer-loader').hide();
                }
              });
            });
            }else{
              jQuery('#posts').append(data).masonry('reload');
              redrawTwitterButton();
              jQuery('#footer-loader').hide();
            }
          }else{
            jQuery('#footer-loader').hide();
          }
      
    },
    function(){
      jQuery('#footer-loader').show();
      jQuery('#posts').html('').height(20);
    }
  );
  }
</script>
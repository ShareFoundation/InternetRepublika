<div class="comment-<?php echo $id ?>-<?php echo $type ?>">

  <form id="commentForm-<?php echo $id ?>-<?php echo $type ?>" class="commentForm">
    <?php if (!$sf_user->isAuthenticated()) { ?>
      <label><?php echo __('Name') ?></label><input type="text" name="name" id="commentName" value="" />
      <span class="nameError"><?php echo __('You need to write your name.') ?></span><br/>
    <?php } ?>
    <div class="area-comment"><label><?php echo __('Comment') ?></label><textarea name="comment"></textarea>
    <span class="commentError"><?php echo __('You need to write your comment.') ?></span></div>
    <input type="button" value="<?php echo __('Add Comment') ?>" onclick="addComment(<?php echo $id ?>, <?php echo $type ?>)" />
  </form>

  <div class="commentList">
    <?php include_component('comment', 'comment_list', array('id' => $id, 'type' => $type)) ?>
  </div>


</div>


<script>

      function addComment(id, type) {
        noErrors = true;
        
        if (jQuery('#commentForm-' + id + '-' + type + ' textarea').val() == '') {
          jQuery('#commentForm-' + id + '-' + type + ' .commentError').show();
          noErrors = false;
        }else{
            jQuery('#commentForm-' + id + '-' + type + ' .commentError').hide();
          }
      
        <?php if (!$sf_user->isAuthenticated()) { ?>
          if (jQuery('#commentForm-' + id + '-' + type + ' #commentName').val() == '') {
            jQuery('#commentForm-' + id + '-' + type + ' .nameError').show();
            noErrors = false;
          }else{
            jQuery('#commentForm-' + id + '-' + type + ' .nameError').hide();
          }
        <?php } ?>
          
        if(noErrors == false){
          return false;
        }
      
        jQuery('#commentForm-' + id + '-' + type + ' .commentError').hide();
        jQuery('#commentForm-' + id + '-' + type + ' .commentError').hide();
        // Ajax to add comment and relist comment list
        var formData = jQuery('#commentForm-' + id + '-' + type).serialize();
        jQuery('#commentForm-' + id + '-' + type + ' textarea').val('');
        ajaxRenderComponent('comment', 'add_comment', 'id=' + id + '&type=' + type + '&' + formData, function() {
          renderCommentList(id, type);
        }, function() {
          jQuery('.comment-' + id + '-' + type + ' .commentList').html('<?php echo __('Loading') . '...' ?>');
        });
      }

      function addSubComment(id, type, parent_id) {
        noErrors = true;
      
        if (jQuery('#commentForm-' + id + '-' + type + '-' + parent_id + ' textarea').val() == '') {
          jQuery('#commentForm-' + id + '-' + type + '-' + parent_id + ' .commentError').show();
          noErrors = false;
        }else{
          jQuery('#commentForm-' + id + '-' + type + '-' + parent_id + ' .commentError').hide();
        }

        <?php if (!$sf_user->isAuthenticated()) { ?>
          if (jQuery('#commentForm-' + id + '-' + type + '-' + parent_id + ' .commentName').val() == '') {
            jQuery('#commentForm-' + id + '-' + type + '-' + parent_id + ' .nameError').show();
            noErrors = false;
          }else{
            jQuery('#commentForm-' + id + '-' + type + '-' + parent_id + ' .nameError').hide();
          }
        <?php } ?>
          
        if(noErrors == false){
          return false;
        }
      
        jQuery('#commentForm-' + id + '-' + type + '-' + parent_id + ' .commentError').hide();
        
        // Ajax to add comment and relist comment list
        var formData = jQuery('#commentForm-' + id + '-' + type + '-' + parent_id).serialize();
        jQuery('#commentForm-' + id + '-' + type + '-' + parent_id + ' textarea').val('');
        ajaxRenderComponent('comment', 'add_comment', 'id=' + id + '&type=' + type + '&parent_id=' + parent_id + '&' + formData, function() {
          renderCommentList(id, type);
        }, function() {
          jQuery('.comment-' + id + '-' + type + ' .commentList').html('<?php echo __('Loading') . '...' ?>');
        });

      }

      function renderCommentList(id, type) {
        ajaxRenderComponent('comment', 'comment_list', 'id=' + id + '&type=' + type,
                function(data) {
                  jQuery('.comment-' + id + '-' + type + ' .commentList').html(data);
                },
                function() {
                  jQuery('.comment-' + id + '-' + type + ' .commentList').html('<?php echo __('Loading') . '...' ?>');
                }
        );
      }

      function commentReply(obj) {
        jQuery(obj).parent().parent().find('.subCommentForm').hide();
        jQuery(obj).next().show();
        jQuery(obj).hide();
      }

      function flagComment(id) {
        ajaxRenderComponent('comment', 'flag_comment', 'id=' + id, function() {
          jAlert('<?php echo __('You have successfully flaged comment as inappropriate.') ?>');
        }, function() {

        });
      }

      function deleteComment(id, itemId, itemType) {
        ajaxRenderComponent('comment', 'delete_comment', 'id=' + id, function() {
          jAlert('You have successfully deleted comment.');
        }, function() {
          renderCommentList(itemId, itemType);
        });
      }


</script>
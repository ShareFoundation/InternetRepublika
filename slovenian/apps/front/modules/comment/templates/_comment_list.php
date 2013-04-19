<?php if (!empty($commentsList)) { ?>
  <ul>
    <?php foreach ($commentsList as $comment) { ?>
      <li>
        <div class="created-by"><span><?php echo __('Created by') ?>:</span><?php echo $comment->getCreatedBy() ?> <span>at</span> <?php echo $comment->getCreatedAt(sfConfig::get('date_format')) ?></div>
        <div class="comment-text"><?php echo nl2br($comment->getText()) ?></div>
        <?php if ($comment->canFlag()) { ?>
          <a href="javascript: void(0)" onclick="flagComment(<?php echo $comment->getId() ?>);jQuery(this).remove();"><?php echo __('Flag') ?></a>
        <?php } ?>
          <?php if ($comment->canDelete()) { ?>
          <a href="javascript: void(0)" onclick="deleteComment(<?php echo $comment->getId() ?>, <?php echo $id ?>, <?php echo $type ?>);jQuery(this).remove();"><?php echo __('Delete') ?></a>
        <?php } ?>
        <?php $subCommentList = CommentPeer::getComments($id, $type, $comment->getId()); ?>
        <?php if (!empty($subCommentList)) { ?>
          <ul>
            <?php foreach ($subCommentList as $subComment) { ?>
              <li>
                <div class="created-by"><span>Created by:</span> <?php echo $subComment->getsfGuardUser() ?></div>
                <div class="comment-text"><?php echo nl2br($subComment->getText()) ?></div>
                <?php if ($subComment->canFlag()) { ?>
                  <a href="javascript: void(0)" onclick="flagComment(<?php echo $subComment->getId() ?>);jQuery(this).remove();"><?php echo __('Flag') ?></a>
                <?php } ?>
                <?php if ($subComment->canDelete()) { ?>
                  <a href="javascript: void(0)" onclick="deleteComment(<?php echo $subComment->getId() ?>, <?php echo $id ?>, <?php echo $type ?>);jQuery(this).remove();"><?php echo __('Delete') ?></a>
                <?php } ?>
              </li>
            <?php } ?>
          </ul>
        <?php } ?>
        <a href="javascript: void(0)" onclick="commentReply(this);"><?php echo __('Reply') ?></a>
        <form id="commentForm-<?php echo $id ?>-<?php echo $type ?>-<?php echo $comment->getId() ?>" class="subCommentForm">
          <?php if (!$sf_user->isAuthenticated()) { ?>
            <label>Name</label><input class="commentName" type="text" name="name" value="" />
            <span class="nameError"><?php echo __('You need to write your name.') ?></span>
          <?php } ?>
          <div class="area-comment"><label><?php echo __('Comment') ?></label><textarea name="comment"></textarea>
          <span class="commentError"><?php echo __('You need to write your comment.') ?></span></div>
          <input type="button" value="<?php echo __('Reply') ?>" onclick="addSubComment(<?php echo $id ?>, <?php echo $type ?>, <?php echo $comment->getId() ?>)" />
        </form>
      </li>
    <?php } ?>
  </ul>
<?php } ?>
<div class="postBlock">
  <div class="dropHover"></div>
  <?php include_partial('posts/post_header', array('post' => $post)) ?>
  <div class="postContent smiley-universal" style="border-color: <?php echo $post->getBadge2()->getStyle() ?>">
    <div class="poll">
      <?php include_partial('posts/post_description', array('post' => $post)) ?>
      <div class="pollForm">
        <form class="pollVoteForm">
          <div class="pollAnswers">
            <?php if($sf_user->canVoteOnPoll($post->getId()) || !$sf_user->isAuthenticated()){ ?>
              <?php include_partial('posts/poll_answers', array('post' => $post)); ?>
            <?php }else{ ?>
              <?php include_partial('posts/poll_results', array('post' => $post)); ?>
            <?php } ?>
          </div>
          <?php if($sf_user->canVoteOnPoll($post->getId()) || !$sf_user->isAuthenticated()){ ?>
            <input class="poll_vote_no_post_button" type="button" name="Submit" style="display: none;" onclick="getPollAnswers('<?php echo $post->getId() ?>', jQuery(this).parent())" value="<?php echo __('Vote') ?>">
            <input class="poll_vote_button" type="button" name="Submit" onclick="pollVote('<?php echo $post->getId() ?>', jQuery(this).parent())" value="<?php echo __('Vote') ?>">
          <?php } ?>
          <div class="result"><a href="javascript: void(0);" onclick="getPollResults('<?php echo $post->getId() ?>', jQuery(this).parent().parent())"><?php echo __('Results') ?></a></div>
        </form>
      </div>
    </div>
  </div>
  <?php include_partial('posts/post_footer', array('post' => $post)) ?>
</div>
<div class="pollResults">
  <?php foreach ($post->getAnswers() as $key=>$answer) { ?>
    <div class="pollSelect">
      <label><?php echo $answer->getAnswer() ?> (<?php echo $answer->getVoteCount() ?>)</label>
      <div class="poll_result_bar_<?php echo $key ?>" style="width: <?php echo 180 * $answer->getAnswerPercentOfBar() ?>px;"></div>
    </div>
  <?php } ?>
</div>
<?php foreach ($post->getAnswers() as $answer) { ?>
  <div class="pollSelect">
    <input name="poll<?php echo $post->getId() ?>[]" type="radio" value="<?php echo $answer->getId() ?>" class="styled" />
    <label><?php echo $answer->getAnswer() ?></label>
  </div>
<?php } ?>
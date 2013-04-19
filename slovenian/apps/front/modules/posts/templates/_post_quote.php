<div class="postBlock">
  <div class="dropHover"></div>
  <?php include_partial('posts/post_header', array('post' => $post)) ?>
  <div class="postContent smiley-universal" style="border-color: <?php echo $post->getBadge2()->getStyle() ?>">
    <div class="postQuote">
      <p><?php echo $post->getQuote() ?></p>
      <div class="author"><?php echo $post->getQuoteAuthor() != ''?'- ' . $post->getQuoteAuthor() : '' ?></div>
    </div>
  </div>
  <?php include_partial('posts/post_footer', array('post' => $post)) ?>
</div>
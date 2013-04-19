<div class="spostQuote">
  <p><?php echo $post->getQuote() ?></p>
  <div class="author"><?php echo $post->getQuoteAuthor() != '' ? '- ' . $post->getQuoteAuthor() : '' ?></div>
</div>
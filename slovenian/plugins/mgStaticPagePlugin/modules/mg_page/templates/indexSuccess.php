<div class="static-page">
  <h1><?php echo $page->getTitle() ?></h1>

  <div class="static-page-content">
    <?php echo sfOutputEscaper::unescape($page->getText()) ?>
  </div>
</div>
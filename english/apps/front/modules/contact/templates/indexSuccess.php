<div class="static-page">
  <h1><?php echo $title ?></h1>
  <div class="static-page-content">
    <?php echo insertContent('Contact') ?><br/>    
    <form action="<?php echo url_for('@contact', true) ?>" method="post">
    <ul>
      <?php echo $form ?>
     </ul>
      <input type="submit" value="<?php echo __('Send') ?>" />
    </form>
  </div>
</div>
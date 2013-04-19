<form action="<?php echo url_for('@sf_guard_signin') ?>" method="post">
  <ul>
    <?php echo $form ?>
    <li>
      <input type="submit" value="Sign In" />
    </li>
  </ul>
</form>
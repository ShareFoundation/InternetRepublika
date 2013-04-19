<?php echo __('Hello') ?>, <br/> <br/>

<?php echo __('You have new contact from site') ?> <?php echo ConfigurationPeer::get('site_name') ?>, <br/> <br/>

<strong><?php echo __('Name') ?>:</strong>   <?php echo $name ?> <br/>
<strong><?php echo __('Email') ?>:</strong> <?php echo $email ?> <br/>
<strong><?php echo __('Subject') ?>:</strong> <?php echo $subject ?> <br/>
<strong><?php echo __('Message') ?>:</strong> <br/><?php echo nl2br($message) ?> <br/> <br/> <br/>
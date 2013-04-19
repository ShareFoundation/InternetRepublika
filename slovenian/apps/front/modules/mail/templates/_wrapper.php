<?php echo get_partial('mail/' . $type, $params); ?>

<?php echo __('Regards') ?> <br/>
<?php echo ConfigurationPeer::get('site_name') ?> <a href="<?php echo ConfigurationPeer::get('site_url') ?>"><?php echo ConfigurationPeer::get('site_url') ?></a>
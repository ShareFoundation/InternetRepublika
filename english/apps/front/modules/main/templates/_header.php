<div id="header">
  <div id="header-content">
    <div id="logo"><a href="<?php echo url_for('@homepage', true) ?>" <?php echo (ConfigurationPeer::getLogoUrl() != '')?'style="background-image: url(\'' . ConfigurationPeer::getLogoUrl() . '\');"':''  ?>><?php echo ConfigurationPeer::get('site_name') ?></a></div>
    <div id="menu">
      <?php $menuItems = MenuPeer::getChildMenus(1) ?>
      <?php $i = 0 ?>
      <?php if (count($menuItems) > 0) { ?>
        <ul>
          <?php foreach ($menuItems as $item) { $i++; ?>
            <li <?php echo $i == count($menuItems)?'class="last"':'' ?>><a href="<?php echo $item->getParsedLink() ?>" <?php echo ($item->getIsTargetBlank())?'target="_blank"':'' ?>><?php echo $item->getTitle() ?></a></li>
          <?php } ?>
        </ul>
      <?php } ?>
    </div>
    <?php if ($sf_user->isAuthenticated()) { ?>
      <?php include_partial('user/header_user_section') ?>
    <?php } else { ?>
      <?php include_partial('auth/header_register') ?>
    <?php } ?>
  </div>
  <div id="header-social">
    <?php $facebook = ConfigurationPeer::get('facebook') ?>
    <?php if($facebook != ''){ ?>
      <a target="_blank" href="<?php echo $facebook ?>"><img src="/images/front/facebook.png" alt="facebook" /></a>
    <?php } ?>
      
    <?php $twitter = ConfigurationPeer::get('twitter') ?>
    <?php if($twitter != ''){ ?>
      <a target="_blank" href="<?php echo $twitter ?>"><img src="/images/front/twitter.png" alt="twitter" /></a>
    <?php } ?>
      
    <?php $youtube = ConfigurationPeer::get('youtube') ?>
    <?php if($youtube != ''){ ?>
      <a target="_blank" href="<?php echo $youtube ?>"><img src="/images/front/youtube.png" alt="youtube" /></a>
    <?php } ?>
      
    <?php $linkedin = ConfigurationPeer::get('linkedin') ?>
    <?php if($linkedin != ''){ ?>
      <a target="_blank" href="<?php echo $linkedin ?>"><img src="/images/front/in.png" alt="linkedin" /></a>
    <?php } ?>
      
    <?php $instagram = ConfigurationPeer::get('instagram') ?>
    <?php if($instagram != ''){ ?>
      <a target="_blank" href="<?php echo $instagram ?>"><img src="/images/front/instagram.png" alt="instagram" /></a>
    <?php } ?>
      
    <?php $pinterest = ConfigurationPeer::get('pinterest') ?>
    <?php if($pinterest != ''){ ?>
      <a target="_blank" href="<?php echo $pinterest ?>"><img src="/images/front/pinterest.png" alt="pinterest" /></a>
    <?php } ?>
      
    <?php $hastag = ConfigurationPeer::get('hashtag') ?>
    <?php if($hastag != ''){ ?>
      <a class="hash" target="_blank" href="https://twitter.com/#!/search/%23<?php echo $hastag ?>">#<?php echo $hastag ?></a>
    <?php } ?>
  </div>
</div>
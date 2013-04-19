<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" xmlns:fb="http://ogp.me/ns/fb#">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />

    <?php include_partial('main/scripts') ?>
    
    <?php if ($sf_context->getModuleName() == 'posts' && $sf_context->getActionName() == 'view') { ?>
      <?php include_component('main', 'post_fb_meta') ?>
    <?php } else if ($sf_context->getModuleName() == 'parties' && $sf_context->getActionName() == 'view') { ?>
      <?php include_component('main', 'party_fb_meta') ?>
    <?php } ?>

    <?php include_stylesheets() ?>
    <script type="text/javascript">
      var BaseUrl = '<?php echo url_for('@homepage', true) ?>';
    </script>
    <?php include_javascripts() ?>

    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

    <?php if ($sf_user->isAuthenticated()) { ?>
      <script>
        jQuery(document).ready(function(){
          var intervalID = setInterval(checkIsLoggedIn, 15 * 1000);
        });
      </script>
    <?php } ?>
    <!--[if lt IE 8]>
    <link rel="stylesheet" type="text/css" href="/css/front/ie7.css" media="all" />
    <![endif]-->
    <!--[if gte IE 8]>
    <link rel="stylesheet" type="text/css" href="/css/front/ie8.css" media="all" />
    <![endif]-->
    <!--[if IE 9]>
    <link rel="stylesheet" type="text/css" href="/css/front/ie9.css" media="all" />
    <![endif]-->

    <?php $googleCode = ConfigurationPeer::get('google_analytics'); ?>
    <?php if($googleCode != ''){ ?>
      <script type="text/javascript">
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', '<?php echo $googleCode ?>']);
        _gaq.push(['_trackPageview']);
        (function() {
          var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
          ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
          var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();
      </script>
    <?php } ?>
    
  </head>
  <body>

    <div id="fb-root"></div>
    <script>
      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/sr_RS/all.js#xfbml=1&appId=190915007686913";
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>
    <div id="wrapper"> 
      <!-- Header -->
      <?php include_partial('main/header') ?>
      <!-- End Header -->
    </div>
    <div id="content"> 

      <?php include_component('main', 'badges') ?>

      <div class="mainContent"> 
        <!-- Banners -->
        <?php if(!$sf_user->isAuthenticated()){ ?>
          <div class="banners"><?php insertContent('Top Block') ?></div>
        <?php }else{ ?>
          <div class="banners"><?php insertContent('Top Block Register') ?></div>
        <?php } ?>
        <!-- End Banners -->
        <?php if ($sf_context->getModuleName() == 'posts' && $sf_context->getActionName() == 'index') { ?>
          <?php include_partial('posts/posts_filter') ?>

          <?php echo $sf_content ?>

        <?php } else { ?>
          <?php echo $sf_content ?>
        <?php } ?>
        <!-- End Id Posts --> 
      </div>
      <!-- End  Main Content --> 
    </div>
    
    <?php // Check user registration status ?>
    <?php if($sf_user->isAuthenticated() && $sf_user->getGuardUser()->getProfile()->getIsFirstLogin()){ ?>
      <?php // show twitter registration confirmation ?>
      <script>
        jQuery(document).ready(function(){
          ajaxRenderComponent('auth', 'register_success', '', function(data) {
            jQuery('#finish-register').html(data);
          }, function(){
            showModal('finish-register');
            jQuery('#finish-register').html("<?php echo __('Loading') ?>...");
          });
        });
      </script>
    <?php } ?>
    
  </body>
</html>

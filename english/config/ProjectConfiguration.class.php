<?php

require_once dirname(__FILE__).'/../lib/vendor/symfony/lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {
    sfConfig::set('url', 'http://yourdomain.com/');
    
    $this->setWebDir($this->getRootDir() . DIRECTORY_SEPARATOR);
    sfConfig::set('profile_image_path', sfConfig::get('sf_web_dir') . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'member_profiles');
    sfConfig::set('profile_image_url', sfConfig::get('url') . 'uploads/member_profiles');
    sfConfig::set('profile_image_size', '1000000');

    sfConfig::set('party_logo_path', sfConfig::get('sf_web_dir') . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'parties');
    sfConfig::set('party_logo_url', sfConfig::get('url') . 'uploads/parties');
    sfConfig::set('party_logo_size', '1000000');

    sfConfig::set('post_photo_path', sfConfig::get('sf_web_dir') . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'posts');
    sfConfig::set('post_photo_url', sfConfig::get('url') . 'uploads/posts');
    sfConfig::set('post_photo_size', '1000000');
    
    sfConfig::set('badge_image_path', sfConfig::get('sf_web_dir') . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'badges');
    sfConfig::set('badge_image_url', sfConfig::get('url') . 'uploads/badges');
    sfConfig::set('badge_image_size', '500000');
    
    sfConfig::set('download_dir', sfConfig::get('sf_web_dir') . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'download');
    sfConfig::set('cache_dir', sfConfig::get('sf_web_dir') . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'cache');
    
    sfConfig::set('logo_url', sfConfig::get('url') . 'uploads/logo');
    sfConfig::set('logo_image_path', sfConfig::get('sf_web_dir') . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'logo');
    
    sfConfig::set('date_format', 'm/d/Y h:i a');
    
    $this->enablePlugins('sfPropelPlugin');
    $this->enablePlugins('sfGuardPlugin');
    $this->enablePlugins('mgStaticPagePlugin');
    $this->enablePlugins('sfFormExtraPlugin');
    $this->enablePlugins('sfFCKEditorPlugin');
    $this->enablePlugins('sfImageTransformPlugin');
    $this->enablePlugins('jsThumbnailPlugin');
    $this->enablePlugins('omCrossAppUrlPlugin');
    $this->enablePlugins('sfPropelActAsTaggableBehaviorPlugin');
    
    sfApplicationConfiguration::getActive()->loadHelpers(array('I18N'));
  }
}
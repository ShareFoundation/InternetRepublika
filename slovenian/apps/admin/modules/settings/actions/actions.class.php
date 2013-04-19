<?php

/**
 * settings actions.
 *
 * @package    netizbori
 * @subpackage settings
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class settingsActions extends sfActions {

  /**
   * Executes index action
   *
   * @param sfRequest $request A request object
   */
  public function executeIndex(sfWebRequest $request) {
    $default1 = array(
        'site_name' => ConfigurationPeer::get('site_name', ''),
        'site_url' => ConfigurationPeer::get('site_url', sfConfig::get('url')),
        'email' => ConfigurationPeer::get('admin_email', 'admin@admin.com'),
        'email_from' => ConfigurationPeer::get('admin_email_from', ''),
        'use_badges' => (bool) ConfigurationPeer::get('use_badges', 1),
        'google_analytics' => (bool) ConfigurationPeer::get('google_analytics', ''),
        'index_boundary' => ConfigurationPeer::get('index_boundary', 0),
        'logo' => (bool) ConfigurationPeer::get('logo', ''),
    );

    $default2 = array(
        'facebook' => ConfigurationPeer::get('facebook', ''),
        'twitter' => ConfigurationPeer::get('twitter', ''),
        'hashtag' => ConfigurationPeer::get('hashtag', ''),
        'youtube' => ConfigurationPeer::get('youtube', ''),
        'linkedin' => ConfigurationPeer::get('linkedin', ''),
        'instagram' => ConfigurationPeer::get('instagram', ''),
        'pinterest' => ConfigurationPeer::get('pinterest', ''),
    );

    $this->form1 = new SettingsForm($default1);
    $this->form2 = new SettingsSocialNetworksForm($default2);

    if ($request->isMethod('post')) {
      $values1 = $request->getParameter($this->form1->getName());
      $values2 = $request->getParameter($this->form2->getName());
      $files = $request->getFiles($this->form1->getName());
      $this->form1->bind($values1, $files);
      $this->form2->bind($values2);

      if ($this->form1->isValid() && $this->form2->isValid()) {
        ConfigurationPeer::set('site_name', $values1['site_name']);
        ConfigurationPeer::set('site_url', $values1['site_url']);
        ConfigurationPeer::set('admin_email', $values1['email']);
        ConfigurationPeer::set('admin_email_from', $values1['email_from']);
        ConfigurationPeer::set('google_analytics', $values1['google_analytics']);
        ConfigurationPeer::set('index_boundary', $values1['index_boundary']);
        
        if(isset($values1['logo_delete']) && !empty($values1['logo_delete'])){
          $logo = sfConfig::get('logo_image_path') . '/' . ConfigurationPeer::get('logo');
          if(file_exists($logo)){
            unlink($logo);
          }
          ConfigurationPeer::set('logo', '');
        }
        
        if(!empty($files['logo']['name'])){
          $newFile = md5($files['logo']['name'] . rand(1000, 9999)) . '.' . pathinfo($files['logo']['name'], PATHINFO_EXTENSION);
          move_uploaded_file($files['logo']['tmp_name'], sfConfig::get('logo_image_path') . '/' . $newFile);
          ConfigurationPeer::set('logo', $newFile);
        }
        
        if(!isset($values1['use_badges'])){
          ConfigurationPeer::set('use_badges', 0);
        }else{
          ConfigurationPeer::set('use_badges', 1);
        }
        
        ConfigurationPeer::set('facebook', $values2['facebook']);
        ConfigurationPeer::set('twitter', $values2['twitter']);
        ConfigurationPeer::set('hashtag', $values2['hashtag']);
        ConfigurationPeer::set('youtube', $values2['youtube']);
        ConfigurationPeer::set('linkedin', $values2['linkedin']);
        ConfigurationPeer::set('instagram', $values2['instagram']);
        ConfigurationPeer::set('pinterest', $values2['pinterest']);

        $this->getUser()->setFlash('success', 'You have successfully stored settings.');
        $this->redirect('settings/index');
      } else {
        $this->getUser()->setFlash('error', 'Please fix errros on form.');
      }
    }
  }

}

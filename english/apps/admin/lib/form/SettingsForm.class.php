<?php

/**
 * News form.
 *
 * @package    netizbori
 * @subpackage form
 * @author     Your name here
 */
class SettingsForm extends BaseForm {

  public function setup() {
    $this->setWidgets(array(
        'site_name' => new sfWidgetFormInputText(),
        'site_url' => new sfWidgetFormInputText(),
        'email' => new sfWidgetFormInputText(),
        'email_from' => new sfWidgetFormInputText(),
        'use_badges' => new sfWidgetFormInputCheckbox(),
        'google_analytics' => new sfWidgetFormInputText(),
        'index_boundary' =>  new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
        'site_name' => new sfValidatorPass(),
        'site_url' => new sfValidatorPass(),
        'email' => new sfValidatorEmail(array('required' => true)),
        'email_from' => new sfValidatorPass(),
        'use_badges' => new sfValidatorPass(),
        'google_analytics' => new sfValidatorPass(),
        'index_boundary' => new sfValidatorNumber(array('min' => 0, 'max' => 1000)),
    ));

    $this->widgetSchema->setNameFormat('settings[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
    
    
    $this->widgetSchema['logo'] = new sfWidgetFormInputFileEditable(array('file_src' => '<a href="' . ConfigurationPeer::getLogoUrl() . '" target="_blank">View Image</a>', 'is_image' => false, 'delete_label' => 'remove'));
    $this->validatorSchema['logo'] = new sfValidatorFile(array('mime_types' => 'web_images', 'path' => sfConfig::get('logo_image_path'), 'max_size' => '1000000', 'required' => false), array('mime_types' => 'Invalid file type. Only images are allowed.'));
    $this->validatorSchema['logo_delete'] = new sfValidatorPass();
    $this->getWidgetSchema()->setHelp('logo', 'Logo size: 143px x 28px');
    
    /*$template = '<div class="input-file-link">%file%</div><div class="input-file-field">%input%</div><div class="input-file-remove">%delete% %delete_label%</div>';
    if($this->getObject()->getBanner() != ''){
      $template .= '<a href="' . $this->getObject()->getBannerUrl() . '" target="_blank">' . thumbnail_tag($this->getObject()->getBannerUrl(), 100, 100, array(), true) . '</a>';
    }
    $this->widgetSchema['banner']->setOption('template', $template);*/
    
  }

}

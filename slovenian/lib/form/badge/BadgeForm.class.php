<?php

/**
 * Badge form.
 *
 * @package    netizbori
 * @subpackage form
 * @author     Your name here
 */
class BadgeForm extends BaseBadgeForm
{
  public function configure()
  {
    sfContext::getInstance()->getConfiguration()->loadHelpers(array('Thumbnail'));
    
    unset($this['created_at'], $this['updated_at'], $this['place_count']);

    if(!$this->getObject()->isNew()){
      
    }else{
      $c = new Criteria();
      $c->add(BadgeTypePeer::ID, array(1, 2), Criteria::IN);
      $this->widgetSchema['type_id'] = new sfWidgetFormPropelChoice(array('criteria' => $c, 'model' => 'BadgeType', 'add_empty' => 'Select'));
    }
    
    unset($this['type_id']);    
    
    $this->widgetSchema['image'] = new sfWidgetFormInputFileEditable(array('file_src' => $this->object->getImageLink('View Image'), 'is_image' => false, 'delete_label' => 'remove'));
    $this->validatorSchema['image'] = new sfValidatorFile(array('mime_types' => 'web_images', 'path' => sfConfig::get('badge_image_path'), 'max_size' => sfConfig::get('badge_image_size'), 'required' => false), array('mime_types' => 'Invalid file type. Only images are allowed.'));
    $this->validatorSchema['image_delete'] = new sfValidatorPass();
    
    $template = '<div class="input-file-link">%file%</div><div class="input-file-field">%input%</div><div class="input-file-remove">%delete% %delete_label%</div>';
    if($this->getObject()->getImage() != ''){
      $template .= '<a href="' . $this->getObject()->getImageUrl() . '" target="_blank">' . thumbnail_tag($this->getObject()->getImageUrl(), 46, 92, array(), true) . '</a>';
    }
    $this->widgetSchema['image']->setOption('template', $template);
    
    $this->getWidgetSchema()->setHelp('image', 'Size 46px x 92px');
    $this->getWidgetSchema()->setHelp('style', 'Upisite boju koja predstavlja ovaj badge.');
    
    //$this->widgetSchema['image']->setHelp('Test');
  }
}

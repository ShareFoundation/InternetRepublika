<?php

/**
 * Post form base class.
 *
 * @method Post getObject() Returns the current form's model object
 *
 * @package    netizbori
 * @subpackage form
 * @author     Your name here
 */
abstract class BasePostForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'partie_id'       => new sfWidgetFormPropelChoice(array('model' => 'Partie', 'add_empty' => false)),
      'replica_post_id' => new sfWidgetFormPropelChoice(array('model' => 'Post', 'add_empty' => true)),
      'type'            => new sfWidgetFormInputText(),
      'title'           => new sfWidgetFormInputText(),
      'url'             => new sfWidgetFormInputText(),
      'text'            => new sfWidgetFormTextarea(),
      'photo_file'      => new sfWidgetFormInputText(),
      'photo_url'       => new sfWidgetFormInputText(),
      'quote'           => new sfWidgetFormTextarea(),
      'quote_author'    => new sfWidgetFormInputText(),
      'link_title'      => new sfWidgetFormInputText(),
      'link_url'        => new sfWidgetFormInputText(),
      'link_image'      => new sfWidgetFormInputText(),
      'video_url'       => new sfWidgetFormInputText(),
      'total_index'     => new sfWidgetFormInputText(),
      'best_badge_1'    => new sfWidgetFormInputText(),
      'best_badge_2'    => new sfWidgetFormInputText(),
      'is_published'    => new sfWidgetFormInputCheckbox(),
      'is_featured'     => new sfWidgetFormInputCheckbox(),
      'comments_count'  => new sfWidgetFormInputText(),
      'created_at'      => new sfWidgetFormDateTime(),
      'updated_at'      => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'partie_id'       => new sfValidatorPropelChoice(array('model' => 'Partie', 'column' => 'id')),
      'replica_post_id' => new sfValidatorPropelChoice(array('model' => 'Post', 'column' => 'id', 'required' => false)),
      'type'            => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'title'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'url'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'text'            => new sfValidatorString(array('required' => false)),
      'photo_file'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'photo_url'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'quote'           => new sfValidatorString(array('required' => false)),
      'quote_author'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'link_title'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'link_url'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'link_image'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'video_url'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'total_index'     => new sfValidatorNumber(),
      'best_badge_1'    => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'best_badge_2'    => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'is_published'    => new sfValidatorBoolean(),
      'is_featured'     => new sfValidatorBoolean(),
      'comments_count'  => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'created_at'      => new sfValidatorDateTime(array('required' => false)),
      'updated_at'      => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('post[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Post';
  }


}

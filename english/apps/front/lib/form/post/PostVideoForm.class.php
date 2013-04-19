<?php

/**
 * Post form.
 *
 * @package    netizbori
 * @subpackage form
 * @author     Your name here
 */
class PostVideoForm extends BasePostForm {

  public function configure() {
    $this->setWidgets(array(
        'submited' => new sfWidgetFormInputHidden(),
        'id' => new sfWidgetFormInputHidden(),
        'partie_id' => new sfWidgetFormInputHidden(),
        'type' => new sfWidgetFormInputHidden(),
        'title' => new sfWidgetFormInputText(),
        'video_url' => new sfWidgetFormInputText(),
        'text' => new sfWidgetFormTextarea(), // (array('tool' => 'Basic')),
        'tags' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
        'submited' => new sfValidatorPass(),
        'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
        'partie_id' => new sfValidatorPropelChoice(array('model' => 'Partie', 'column' => 'id')),
        'type' => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
        'video_url' => new sfValidatorUrl(array('max_length' => 255, 'required' => false)),
        'title' => new sfValidatorString(array('max_length' => 75)),
        'text' => new sfValidatorString(array('max_length' => 4000)),
        'tags' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(new YoutubeValidator());

    $this->getWidget('submited')->setDefault(1);

    $this->getWidgetSchema()->setLabels(array('text' => __('Comment'), 'title' => __('Title'), 'video_url' => __('Youtube Link')));

    $this->widgetSchema->setFormFormatterName('list');
    $this->widgetSchema->setNameFormat('post[%s]');
    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
  }

  public function save($con = null) {
    $object = parent::save($con);
    if ($this->getValue('tags') != '') {
      $object->removeAllTags();
      $object->addTag($this->getValue('tags'));
      $object->save();
    }
    return $object;
  }

  public function updateDefaultsFromObject() {
    parent::updateDefaultsFromObject();

    $this->setDefault('tags', implode(", ", $this->getObject()->getTags()));
  }

}

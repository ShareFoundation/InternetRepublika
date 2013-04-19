<?php

/**
 * Post filter form base class.
 *
 * @package    netizbori
 * @subpackage filter
 * @author     Your name here
 */
abstract class BasePostFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'partie_id'       => new sfWidgetFormPropelChoice(array('model' => 'Partie', 'add_empty' => true)),
      'replica_post_id' => new sfWidgetFormPropelChoice(array('model' => 'Post', 'add_empty' => true)),
      'type'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'title'           => new sfWidgetFormFilterInput(),
      'url'             => new sfWidgetFormFilterInput(),
      'text'            => new sfWidgetFormFilterInput(),
      'photo_file'      => new sfWidgetFormFilterInput(),
      'photo_url'       => new sfWidgetFormFilterInput(),
      'quote'           => new sfWidgetFormFilterInput(),
      'quote_author'    => new sfWidgetFormFilterInput(),
      'link_title'      => new sfWidgetFormFilterInput(),
      'link_url'        => new sfWidgetFormFilterInput(),
      'link_image'      => new sfWidgetFormFilterInput(),
      'video_url'       => new sfWidgetFormFilterInput(),
      'total_index'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'best_badge_1'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'best_badge_2'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'is_published'    => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'is_featured'     => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'comments_count'  => new sfWidgetFormFilterInput(),
      'created_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'partie_id'       => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Partie', 'column' => 'id')),
      'replica_post_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Post', 'column' => 'id')),
      'type'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'title'           => new sfValidatorPass(array('required' => false)),
      'url'             => new sfValidatorPass(array('required' => false)),
      'text'            => new sfValidatorPass(array('required' => false)),
      'photo_file'      => new sfValidatorPass(array('required' => false)),
      'photo_url'       => new sfValidatorPass(array('required' => false)),
      'quote'           => new sfValidatorPass(array('required' => false)),
      'quote_author'    => new sfValidatorPass(array('required' => false)),
      'link_title'      => new sfValidatorPass(array('required' => false)),
      'link_url'        => new sfValidatorPass(array('required' => false)),
      'link_image'      => new sfValidatorPass(array('required' => false)),
      'video_url'       => new sfValidatorPass(array('required' => false)),
      'total_index'     => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'best_badge_1'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'best_badge_2'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'is_published'    => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'is_featured'     => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'comments_count'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('post_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Post';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'partie_id'       => 'ForeignKey',
      'replica_post_id' => 'ForeignKey',
      'type'            => 'Number',
      'title'           => 'Text',
      'url'             => 'Text',
      'text'            => 'Text',
      'photo_file'      => 'Text',
      'photo_url'       => 'Text',
      'quote'           => 'Text',
      'quote_author'    => 'Text',
      'link_title'      => 'Text',
      'link_url'        => 'Text',
      'link_image'      => 'Text',
      'video_url'       => 'Text',
      'total_index'     => 'Number',
      'best_badge_1'    => 'Number',
      'best_badge_2'    => 'Number',
      'is_published'    => 'Boolean',
      'is_featured'     => 'Boolean',
      'comments_count'  => 'Number',
      'created_at'      => 'Date',
      'updated_at'      => 'Date',
    );
  }
}

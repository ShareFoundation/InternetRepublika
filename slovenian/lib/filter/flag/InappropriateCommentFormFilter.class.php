<?php

/**
 * InappropriateComment filter form.
 *
 * @package    netizbori
 * @subpackage filter
 * @author     Your name here
 */
class InappropriateCommentFormFilter extends BaseInappropriateCommentFormFilter
{
  public function configure()
  {
    unset($this['user_id'], $this['created_at'], $this['updated_at']);
    
  }
}

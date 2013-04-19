<?php

class mgAjax {

  public static function isAjax() {

    if (sfContext::getInstance()->getRequest()->isXmlHttpRequest()) {
      return true;
    }
    return false;
  }
  
  public static function ajaxOutput($type, $content, $params = array())
  {
    $output = array('status' => $type, 'content' => $content);
    if(!empty($params))
    {
      $output = array_merge($output, $params);
    }
    return json_encode($output);
  }

}
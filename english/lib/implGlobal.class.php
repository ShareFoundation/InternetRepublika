<?php

class implGlobal {

  public static function applyFilters($content) {
    $content = self::applyFilterPageUrl($content);
    $content = self::applyFilterUrl($content);
    $content = self::applyFilterPostUrl($content);
    $content = self::applyFilterPartyUrl($content);
    $content = self::applyFilterNewsUrl($content);

    return $content;
  }

  public static function applyFilterPageUrl($content) {
    $pattern = "/{page='[^'}]*'}/i";
    $content = $content;
    preg_match_all($pattern, $content, $output);
    if (!empty($output[0])) {
      foreach ($output[0] as $val) {
        $pattern = "/{page='([^'}]*)'}/i";
        preg_match($pattern, $val, $item);
        if (!empty($item[1])) {
          $url = url_for_static_page($item[1]);
          $content = str_ireplace($item[0], $url, $content);
        } else {
          $content = str_ireplace($val, '###', $content);
        }
      }
    }
    return $content;
  }

  public static function applyFilterUrl($content) {
    $pattern = "/{url='[^'}]*'}/i";
    $content = $content;
    preg_match_all($pattern, $content, $output);
    if (!empty($output[0])) {
      foreach ($output[0] as $val) {
        $pattern = "/{url='([^'}]*)'}/i";
        preg_match($pattern, $val, $item);
        if (!empty($item[1])) {
          $url = url_for($item[1], true);
          $content = str_ireplace($item[0], $url, $content);
        } else {
          $content = str_ireplace($val, '###', $content);
        }
      }
    }
    return $content;
  }

  public static function applyFilterPostUrl($content) {
    $pattern = "/{post_url='[^'}]*'}/i";
    $content = $content;
    preg_match_all($pattern, $content, $output);
    if (!empty($output[0])) {
      foreach ($output[0] as $val) {
        $pattern = "/{post_url='([^'}]*)'}/i";
        preg_match($pattern, $val, $item);
        if (!empty($item[1])) {
          $url = url_for('@post_view?url=' . $item[1], true);
          $content = str_ireplace($item[0], $url, $content);
        } else {
          $content = str_ireplace($val, '###', $content);
        }
      }
    }
    return $content;
  }

  public static function applyFilterPartyUrl($content) {
    $pattern = "/{party_url='[^'}]*'}/i";
    $content = $content;
    preg_match_all($pattern, $content, $output);
    if (!empty($output[0])) {
      foreach ($output[0] as $val) {
        $pattern = "/{party_url='([^'}]*)'}/i";
        preg_match($pattern, $val, $item);
        if (!empty($item[1])) {
          $url = url_for('@party_view?url=' . $item[1], true);
          $content = str_ireplace($item[0], $url, $content);
        } else {
          $content = str_ireplace($val, '###', $content);
        }
      }
    }
    return $content;
  }

   public static function applyFilterNewsUrl($content) {
    $pattern = "/{news_url='[^'}]*'}/i";
    $content = $content;
    preg_match_all($pattern, $content, $output);
    if (!empty($output[0])) {
      foreach ($output[0] as $val) {
        $pattern = "/{news_url='([^'}]*)'}/i";
        preg_match($pattern, $val, $item);
        if (!empty($item[1])) {
          $url = url_for('@news_view?url=' . $item[1], true);
          $content = str_ireplace($item[0], $url, $content);
        } else {
          $content = str_ireplace($val, '###', $content);
        }
      }
    }
    return $content;
  }

}
<?php

function mgGetUrlContent($url) {
  $ch = curl_init();
  $timeout = 5;
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
  $data = curl_exec($ch);
  curl_close($ch);
  return $data;
}

function mgGetDataFromHtml($html) {
  /* get page's title */
  preg_match("/<title>(.+)<\/title>/siU", $html, $matches);
  $title = $matches[1];

  /* get page's keywords */
  $re = "<meta\s+name=['\"]??keywords['\"]??\s+content=['\"]??(.+)['\"]??\s*\/?>";
  preg_match("/$re/siU", $html, $matches);
  $keywords = '';
  if (isset($matches[1]))
    $keywords = $matches[1];

  /* get page's description */
  $re = "<meta\s+name=['\"]??description['\"]??\s+content=['\"]??(.+)['\"]??\s*\/?>";
  preg_match("/$re/siU", $html, $matches);
  $desc = '';
  if (isset($matches[1]))
    $desc = $matches[1];

  /* parse links */
  $re = "<a\s[^>]*href\s*=\s*(['\"]??)([^'\">]*?)\\1[^>]*>(.*)<\/a>";
  preg_match_all("/$re/siU", $html, $matches);
  $links = array();
  if (isset($matches[2]))
    $links = $matches[2];

  /* parse images */
  $matches = '';
  $re = "<a\s[^>]*href\s*=\s*(['\"]??)([^'\">]*?)\\1[^>]*>(.*)<\/a>";
  preg_match_all("/$re/siU", $html, $matches);
  $images = array();
  if (isset($matches[2]))
    $images = $matches[2];

  $info = array(
      "title" => $title,
      "keywords" => $keywords,
      "description" => $desc,
      "md5" => md5($html),
      "links" => array_unique($links),
      "images" => array_unique($images)
  );

  return($info);
}

function isYoutubeUrl($url) {
  if (!empty($url)) {
    preg_match("~(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+~", $url, $matches);
    if (!empty($matches)) {
      $v = $matches[0];
      $content = mgGetUrlContent('http://gdata.youtube.com/feeds/api/videos/' . $v);
      if (!empty($content) && ($content != 'Invalid id' && $content != '')) {
        $v = str_replace("!", "", $v);
        return str_replace("#", "", $v);
      }
    }
    return false;
  }
  return false;
}

function getYoutubeThumbnailPhoto($youtubeId) {
  return 'http://img.youtube.com/vi/' . $youtubeId . '/0.jpg';
}
<?php

function thumbnail_tag($img, $maxx = '128', $maxy = '128', $options = array(), $crop = false, $content = false, $url = false, $noPhoto = 'no-content.png') {
  if (!isset($options) || !is_array($options))
    $options = array();

  $maxx = (int) trim(isset($maxx) ? $maxx : 128);
  $maxy = (int) trim(isset($maxy) ? $maxy : 128);

  $exploded = explode('/', str_replace('\\', '/', $img));
  $fileExtension = '.png';
  $smallFileName = md5($exploded[count($exploded) - 1]) . $maxx . $maxy;
  $smallFolderPath = sfConfig::get('sf_upload_dir') . "/small/";
  
  if (!file_exists(trim($smallFolderPath . $smallFileName . '.png'))) {
    include_once(sfConfig::get('sf_root_dir') . "/lib/vendor/wideimage/WideImage.php");
    try {
      if (file_exists($img) || url_exists($img)) {
        $image = WideImage::load($img);
      } else {
        $img = sfConfig::get('sf_web_dir') . '/images/front/' . $noPhoto;
        $image = WideImage::load($img);
      }
    } catch (Exception $e) {
      $img = sfConfig::get('sf_web_dir') . '/images/front/' . $noPhoto;
      $image = WideImage::load($img);
    }

    $aRation = $image->getWidth() / $image->getHeight();

    if (!$crop) {
      if ($maxx == 0) {
        $resizedImage = $image->resize($maxx, null);
      } else if ($maxy == 0) {
        $resizedImage = $image->resize(null, $maxy);
      } else {
        $resizedImage = $image->resize($maxx, $maxy);
      }
    } else {
      if ($image->getWidth() < $image->getHeight()) {
        if (($aRation * $maxy) < $maxx) {
          $resizedImage = $image->resize($maxx);
        } else {
          $resizedImage = $image->resize($aRation * $maxy);
        }
      } else {
        if (($aRation * $maxy) < $maxx) {
          $resizedImage = $image->resize($maxx);
        } else {
          $resizedImage = $image->resize($aRation * $maxy);
        }
      }
      $resizedImage = $resizedImage->crop("center", "middle", $maxx, $maxy);
    }
    $resizedImage->saveToFile($smallFolderPath . $smallFileName . $fileExtension);
  }

  if ($url) {
    return sfConfig::get('url') . 'uploads/small/' . $smallFileName . $fileExtension;
  }

  if ($content == true) {
    header("Content-Type: image/jpeg");
    $c = fopen(sfConfig::get('sf_web_dir') . '/uploads/small/' . $smallFileName . $fileExtension, 'r');
    echo fread($c, filesize(sfConfig::get('sf_web_dir') . '/uploads/small/' . $smallFileName . $fileExtension));
    exit;
  } else {
    $options['src'] = sfConfig::get('url') . 'uploads/small/' . $smallFileName . $fileExtension;
    if ($crop) {
      $options['width'] = $maxx;
      $options['height'] = $maxy;
    }
    return tag('img', $options, true);
  }
}

function url_exists($url) {
  // Version 4.x supported
  $handle = curl_init($url);
  if (false === $handle) {
    return false;
  }
  curl_setopt($handle, CURLOPT_HEADER, false);
  curl_setopt($handle, CURLOPT_FAILONERROR, true);  // this works
  curl_setopt($handle, CURLOPT_HTTPHEADER, Array("User-Agent: Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.15) Gecko/20080623 Firefox/2.0.0.15")); // request as if Firefox
  curl_setopt($handle, CURLOPT_NOBODY, true);
  curl_setopt($handle, CURLOPT_RETURNTRANSFER, false);
  $connectable = curl_exec($handle);
  curl_close($handle);
  return $connectable;
}


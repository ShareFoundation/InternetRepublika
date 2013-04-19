<?php

sfApplicationConfiguration::getActive()->loadHelpers(array('mgUrlContent'));

class YoutubeValidator extends sfValidatorBase {

  public function configure($options = array(), $messages = array()) {
    $this->addOption('video_url', 'video_url');
    $this->setMessage('invalid', __('Youtube link is not valid.'));
  }

  protected function doClean($values) {
    if (isset($values[$this->getOption('video_url')])) {
      $url = $values[$this->getOption('video_url')];
      preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $url, $matches);
      if (!empty($matches)) {
        $v = $matches[0];
        $content = mgGetUrlContent('http://gdata.youtube.com/feeds/api/videos/' . $v);
        if (!empty($content) && ($content != 'Invalid id' && $content != '')) {
          return $values;
        }
      }
      throw new sfValidatorError($this, 'invalid');
      return $values;
    }
    return $values;
  }

}

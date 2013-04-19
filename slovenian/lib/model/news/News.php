<?php


/**
 * Skeleton subclass for representing a row from the 'news' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * 02/09/12 10:59:31
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model.news
 */
class News extends BaseNews {

	public function getUrl()
  {
    if($this->getId())
    {
      $url = parent::getUrl();
      if($url == '')
      {
        // Generate new url
        $name = strtolower($this->getTitle());
        
        $name = str_replace("ć", "c", $name);
        $name = str_replace("č", "c", $name);
        $name = str_replace("ž", "z", $name);
        $name = str_replace("đ", "d", $name);
        $name = str_replace("š", "s", $name);
        
        $url = ltrim(rtrim(preg_replace("/[^A-Za-z0-9-]/", "-", $name), "-"), "-");
        $c = new Criteria();
        $c->add(NewsPeer::URL, $url);
        if(NewsPeer::doCount($c) > 0)
        {
          $url .= '-' . $this->getId();
        }
        $this->setUrl($url);
        $this->save();
      }
      return $url;
    }
    return '';
  }
  
  public function getLink()
  {
    return sfContext::getInstance()->getController()->genUrl('@news_view?url=' . $this->getUrl(), true);
  }

  public function getTextShort($count)
  {
    $text = $this->getText();
    if(strlen($text) > $count) { 
      $text = substr($text, 0, $count) . '...';
    }
    return strip_tags($text);
  }
  
} // News
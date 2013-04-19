<?php

sfContext::getInstance()->getConfiguration()->loadHelpers(array('Partial'));

class mgEmail {

  protected $_subject;
  protected $_message;
  protected $_type;

  const TYPE_TEXT = 'Text';
  const TYPE_HTML = 'Html';

  public function __construct($type = self::TYPE_HTML) {
    $this->_type = $type;
    if (!empty($from)) {
      $this->_from = $from['name'] . ' <' . $from['email'] . '>';
    }
  }

  public function createMessage($subject, $params) {
    $this->_setSubject($subject);
    $this->_setMessage(get_partial('mail/wrapper', $params));
  }

  public function send($to, $cc = null, $bcc = array('milos.glavinic@gmail.com')) {
    $message = sfContext::getInstance()->getMailer()->compose(
            array(ConfigurationPeer::get('admin_email', 'admin@admin.com') => ConfigurationPeer::get('admin_email_from')), $to, $this->_subject, $this->_message
    );
    sfContext::getInstance()->getMailer()->send($message);
    return true;
  }

  protected function _setMessage($message) {
    $this->_message = $message;
  }

  protected function _setSubject($subject) {
    return $this->_subject = $subject;
  }

}
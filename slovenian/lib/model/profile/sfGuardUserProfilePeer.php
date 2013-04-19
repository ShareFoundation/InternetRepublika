<?php

class sfGuardUserProfilePeer extends BasesfGuardUserProfilePeer {

  public static function registerUser($data) {
    $user = new sfGuardUser();
    //$user->setEmail($data['email']);
    $user->setUsername($data['username']);
    $user->setPassword($data['password']);
    $user->setIsActive(true);
    $user->save();

    $profile = new sfGuardUserProfile();
    $profile->setUserId($user->getId());
    $profile->save();

    $utg = new sfGuardUserGroup();
    $utg->setUserId($user->getId());
    $utg->setGroupId(1);
    $utg->save();

    return $user;
  }

  public static function registerGuest() {
    $user = new sfGuardUser();
    $user->setUsername("gost");
    $user->setIsActive(true);
    $user->save();
    return $user;
  }

  public static function sendContactEmail($params) {
    $messageSubject = 'Kontakt';
    $params = array(
        'type' => 'contact',
        'params' => $params);
    $mail = new mgEmail();
    $mail->createMessage($messageSubject, $params);
    $mail->send(ConfigurationPeer::get('admin_email', 'admin@admin.com'));
  }

  public static function sendForgotPasswordEmail($email, $password) {

    $messageSubject = __('Password has been successfully reset.');

    $params = array(
        'type' => 'forgot_password',
        'params' => array(
            'password' => $password,
        )
    );

    $mail = new mgEmail();
    $mail->createMessage($messageSubject, $params);
    $mail->send($email);
  }

  public static function getUsersCount() {
    return sfGuardUserPeer::doCount(new Criteria());
  }

  public static function createVirtualUser() {
    if (isset($_COOKIE['vuser']) && !empty($_COOKIE['vuser'])) {
      $user = sfGuardUserPeer::retrieveByUsername($_COOKIE['vuser']);
      if (empty($user)) {
        // Create new vuser
        $username = time() . rand(1000, 9999) . rand(1000, 9999);
        setcookie('vuser', $username, time() + 3600 * 24 * 30, "/");

        $user = new sfGuardUser();
        $user->setUsername($username);
        $user->setPassword($username);
        $user->setIsActive(true);
        $user->save();

        $profile = new sfGuardUserProfile();
        $profile->setUserId($user->getId());
        $profile->setFirstName('Unknown');
        $profile->setLastName('Unknown');
        $profile->save();
      }
    } else {
      // Create new vuser
      $username = time() . rand(1000, 9999) . rand(1000, 9999);
      setcookie('vuser', $username, time() + 3600 * 24 * 30, "/");

      $user = new sfGuardUser();
      $user->setUsername($username);
      $user->setPassword($username);
      $user->setIsActive(true);
      $user->save();

      $profile = new sfGuardUserProfile();
      $profile->setUserId($user->getId());
      $profile->save();
    }
    return $user;
  }

}

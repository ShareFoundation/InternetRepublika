<?php

class homeActions extends sfActions {

  public function executeIndex(sfWebRequest $request) {
    $connection = Propel::getConfiguration();
    $user = $connection['datasources']['propel']['connection']['user'];
    $password = $connection['datasources']['propel']['connection']['password'];
    $host = str_replace("host=", "", strstr($connection['datasources']['propel']['connection']['dsn'], "host="));

    $database = explode(";", $connection['datasources']['propel']['connection']['dsn']);
    $database = str_replace('mysql:dbname=', '', $database[0]);
    
    $this->form = new InstallForm();

    if ($request->isMethod('post')) {
      $values = $request->getParameter($this->form->getName());
      $this->form->bind($values);
      if ($this->form->isValid()) {


        $mysqli = new mysqli($host, $user, $password, $database);
        if (mysqli_connect_errno()) {
          printf("Connect failed: %s\n", mysqli_connect_error());
          exit();
        }
        $query = file_get_contents(sfConfig::get('sf_root_dir') . '/initial-database.sql');
        if ($mysqli->multi_query($query)) {
          do {
            if ($result = $mysqli->store_result()) {
              while ($row = $result->fetch_row()) {
              }
              $result->free();
            }
            if (!$mysqli->more_results()) {
              break;
            }
          } while ($mysqli->next_result());
        }

        $data = file_get_contents(sfConfig::get('sf_root_dir') . '/initial-database-keys.sql');
        $queryList = explode("\n\n", $data);
        foreach ($queryList as $query) {
          if (!$mysqli->query($query)) {
            var_dump(mysqli_error($mysqli));
          } else {
          }
        }
        $mysqli->close();

        // Save data
        ConfigurationPeer::set('site_name', $values['site_name']);
        ConfigurationPeer::set('admin_email_from', $values['site_name']);
        ConfigurationPeer::set('admin_email', $values['email']);

        $user = new sfGuardUser();
        $user->setUsername($values['admin']);
        $user->setPassword($values['password']);
        $user->setIsActive(true);
        $user->setIsSuperAdmin(true);
        $user->save();

        $profile = new sfGuardUserProfile();
        $profile->setUserId($user->getId());
        $profile->setFirstName('Admin');
        $profile->setLastName('Admin');
        $profile->setIsEmailComfirmed(true);
        $profile->save();

        if (file_exists(sfConfig::get('sf_web_dir') . '/install.php')) {
          unlink(sfConfig::get('sf_web_dir') . '/install.php');
        }
        $this->redirect('@homepage');
      }
    }
  }

}
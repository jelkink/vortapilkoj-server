<?php
class Session {

  private $id;

  public function __construct() {
    $this->id = 0;
  }

  public function user_id() {
    return $this->id;
  }

  public function check_id($sessionid) {
    global $db;

    $result = $db->query("SELECT user FROM sessions WHERE id = '" . $sessionid . "'");
    $session = $result->fetch(PDO::FETCH_ASSOC);

    if ($session) {
      $this->id = $session['user'];
    }
  }

  public function is_logged_in() {
    return $this->id > 0;
  }

  public function is_admin() {
    global $db;

    if (!$this->is_logged_in()) {
      return false;
    }

    $result = $db->query("SELECT admin FROM users WHERE id = " . $this->id);
    $user = $result->fetch(PDO::FETCH_ASSOC);

    return $user['admin'] == 1;
  }

  public function email() {
    global $db;

    $result = $db->query("SELECT email FROM users WHERE id = " . $this->id);
    $user = $result->fetch(PDO::FETCH_ASSOC);

    return $user['email'];
  }

  public function register($email, $password) {
    global $db;

    $result = $db->query("SELECT id FROM users WHERE email = '" . htmlspecialchars($email) . "'");

    if ($result->rowCount() == 0) {
      $hashed_password = password_hash($password, PASSWORD_BCRYPT);
      $userid = $db->insert_query("INSERT INTO users (email, password, admin) VALUES ('" . htmlspecialchars($email) . "', '" . $hashed_password . "', 0)");
    }
    
    return $this->login($email, $password);
  }

  public function login($email, $password) {
    global $db;

    $result = $db->query("SELECT id, email, password FROM users WHERE email = '" . htmlspecialchars($email) . "'");
    $user = $result->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
      $this->id = $user['id'];

      $sessionid = bin2hex(random_bytes(16));
      $db->insert_query("INSERT INTO sessions (id, user) VALUES ('" . $sessionid . "', " . $this->id . ")");

      return $sessionid;
    }

    return "";
  }

  public function logout() {
    global $db;
    
    $this->id = 0;
    $db->query("DELETE FROM sessions WHERE user = " . $this->id);
  }
}
?>
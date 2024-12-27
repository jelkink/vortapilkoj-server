<?php
class Database {
  private $host;
  private $db_name;
  private $username;
  private $password;
  private $conn;

  public function __construct() {
    $credentials = file_get_contents('../vortapilkoj_database_credentials.txt');
    list($this->host, $this->db_name, $this->username, $this->password) = explode("\n", trim($credentials));
  }

  // Open a connection to the database
  public function connect() {
    $this->conn = null;

    try {
      $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
      throw new Exception('Connection Error: ' . $e->getMessage());
    }

    return $this->conn;
  }

  // Send a query to the database
  public function query($sql) {
    try {
      $stmt = $this->conn->prepare($sql);
      $stmt->execute();
      return $stmt;
    } catch (PDOException $e) {
      throw new Exception('Query Error: ' . $e->getMessage());
    }
  }
}
?>
<?php
require_once '../library/database.php';

class WordList {
  private $db;
  private $words;

  public function __construct($db) {
    $this->db = $db;
    $this->words = [];
  }

  public function read_list($listname) {
    $query = "SELECT word FROM wordlists WHERE listname = ?";
    $stmt = $this->db->prepare($query);
    $stmt->bind_param("s", $listname);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
      $this->words[] = $row['word'];
    }
  }

  public function get_list() {
    return json_encode($this->words);
  }

  public function get_all_list_names() {
    $query = "SELECT DISTINCT listname FROM wordlists";
    $stmt = $this->db->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    $listnames = [];
    while ($row = $result->fetch_assoc()) {
      $listnames[] = $row['listname'];
    }
    return json_encode($listnames);
  }
}

?>
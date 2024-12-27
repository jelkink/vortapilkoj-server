<?php
class WordList {
  private $db;
  private $words;

  public function __construct($db) {
    $this->db = $db;
    $this->words = [];
  }

  public function read_list($listname) {
    $result = $this->db->query("SELECT word FROM wordlists WHERE listname = " . $listname);
    while ($row = $result->fetch_assoc()) {
      $this->words[] = $row['word'];
    }
  }

  public function get_list() {
    return json_encode($this->words);
  }

  public function get_all_list_names() {
    $result = $this->db->query("SELECT DISTINCT listname FROM wordlists");
    $listnames = [];
    while ($row = $result->fetch_assoc()) {
      $listnames[] = $row['listname'];
    }
    return json_encode($listnames);
  }
}

?>
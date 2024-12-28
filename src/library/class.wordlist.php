<?php
class WordList {
  private $db;
  private $words;

  public function __construct($db) {
    $this->db = $db;
    $this->words = [];
  }

  public function read_list($list) {
    $result = $this->db->query("SELECT word1,language1,word2,language2 FROM wordmapping LEFT JOIN words ON wordmapping.word = words.id WHERE wordmapping.list = " . $list . " ORDER BY word1, word2");
    while ($row = $result->fetch_assoc()) {
      $this->words[] = $row;
    }
  }

  public function get_list($json = false) {
    if (json) {
      return json_encode($this->words);
    } else {
      return $this->words;
    }
  }

  public function get_all_list_names($json = false) {
    $result = $this->db->query("SELECT DISTINCT title FROM wordlists");
    $listnames = [];
    while ($row = $result->fetch_assoc()) {
      $listnames[] = $row['listname'];
    }

    if (json) {
      return json_encode($listnames);
    } else {
      return $listnames;
    }
  }
}

?>
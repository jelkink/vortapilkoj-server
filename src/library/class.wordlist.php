<?php
class WordList {
  private $words;

  public function __construct() {
    $this->words = [];
  }

  public function clear_list() {
    $this->words = [];
  }

  public function read_list($list) {
    global $db;

    if (isset($_POST["reverse"]) && $_POST["reverse"] == 1) {
      $result = $db->query("SELECT id,word1 AS word2,language1 AS language2,word2 AS word1,language2 AS language1 FROM wordmapping LEFT JOIN words ON wordmapping.word = words.id WHERE wordmapping.list = " . $list . " ORDER BY word1, word2");
    } else {
      $result = $db->query("SELECT id,word1,language1,word2,language2 FROM wordmapping LEFT JOIN words ON wordmapping.word = words.id WHERE wordmapping.list = " . $list . " ORDER BY word1, word2");
    }
      $this->words = array_merge($this->words, $result->fetchAll(PDO::FETCH_ASSOC));
  }

  public function read_list_by_language($language) {
    global $db;
    
    $result = $db->query("SELECT id, word1, language1, word2, language2 FROM wordmapping LEFT JOIN words ON wordmapping.word = words.id WHERE language1 = $language OR language2 = $language ORDER BY word1, word2");
    $this->words = $result->fetchAll(PDO::FETCH_ASSOC);
  }

  public function search_words($search) {
    global $db;
    
    $result = $db->query("SELECT id, word1, language1, word2, language2 FROM words WHERE word1 LIKE '%" . $search . "%' OR word2 LIKE '%" . $search . "%' ORDER BY word1, word2");
    $this->words = $result->fetchAll(PDO::FETCH_ASSOC);
  }

  public function get_list($json = false) {
    if ($json) {
      return json_encode($this->words);
    } else {
      return $this->words;
    }
  }

  public function get_all_list_names($json = false) {
    global $db;
    
    $result = $db->query("SELECT id, title, COUNT(word) AS len FROM wordmapping RIGHT JOIN wordlists ON wordmapping.list = wordlists.id GROUP BY list ORDER BY title");
    $listnames = $result->fetchAll(PDO::FETCH_ASSOC);

    if ($json) {
      return json_encode($listnames);
    } else {
      return $listnames;
    }
  }

  public function delete_list($list) {
    global $db;
    
    $db->query("DELETE FROM wordmapping WHERE list = $list");
    $db->query("DELETE w FROM words w LEFT JOIN wordmapping wm ON w.id = wm.word WHERE wm.list IS NULL");
    $db->query("DELETE FROM wordlists WHERE id = $list");
  }
}

?>
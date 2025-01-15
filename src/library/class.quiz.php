<?php

class Quiz {

  private $words;
  private $total;
  private $correct;

  public function __construct($words) {
    $this->words = $words;

    if (isset($_POST['total']) && isset($_POST['correct'])) {
      $this->total = $_POST['total'];
      $this->correct = $_POST['correct'];
    } else {
      $this->total = 0;
      $this->correct = 0;
    }
  }

  public function show_quiz($list) {

    global $sessionid;

    $randomIndex = array_rand($this->words);
    $correctWordPair = $this->words[$randomIndex];
    $options = [$correctWordPair['word2']];

    // Add 3 random incorrect options
    while (count($options) < 4) {
      $randomOption = $this->words[array_rand($this->words)]['word2'];
      if (!in_array($randomOption, $options)) {
        $options[] = $randomOption;
      }
    }

    shuffle($options);

    echo "<p>" . htmlspecialchars($correctWordPair['word1']) . "</p>";
    echo "<form method=\"post\" action=\"index.php?page=quiz&session=$sessionid\">";
    foreach ($list as $l) {
      echo "<input type=\"hidden\" name=\"list[]\" value=\"" . htmlspecialchars($l) . "\">";
    }
    echo "<input type=\"hidden\" name=\"test\" value=\"" . htmlspecialchars($correctWordPair['word1']) . "\">";
    echo "<input type=\"hidden\" name=\"total\" value=\"" . $this->total . "\">";
    echo "<input type=\"hidden\" name=\"correct\" value=\"" . $this->correct . "\">";
    foreach ($options as $option) {
      echo "<button type=\"submit\" name=\"word" . $correctWordPair['id'] . "\" value=\"" . htmlspecialchars($option) . "\">" . htmlspecialchars($option) . "</button>";
    }
    echo "</form>";
  }

  public function show_test($list) {

    global $sessionid;

    $reverse = isset($_POST['reverse']) && $_POST['reverse'] == 1;

    $randomIndex = array_rand($this->words);
    $correctWordPair = $this->words[$randomIndex];
    
    echo "<p>" . htmlspecialchars($correctWordPair['word1']) . "</p>";
    echo "<form method=\"post\" action=\"index.php?page=test&session=$sessionid\">";
    foreach ($list as $l) {
      echo "<input type=\"hidden\" name=\"list[]\" value=\"" . htmlspecialchars($l) . "\">";
    }
    echo "<input type=\"hidden\" name=\"test\" value=\"" . htmlspecialchars($correctWordPair['word1']) . "\">";
    echo "<input type=\"hidden\" name=\"total\" value=\"" . $this->total . "\">";
    echo "<input type=\"hidden\" name=\"correct\" value=\"" . $this->correct . "\">";
    echo "<input type=\"text\" name=\"answer\" autofocus><br>";
    echo "<input type=\"checkbox\" name=\"reverse\" value=\"1\" " . ($reverse ? "checked" : "") . ">Inversigi<br>";
    echo "<input type=\"submit\" value=\"Kontroli\">";
    echo "</form>";
  }

  public function grade_quiz($post) {
    $testWord = $post['test'];
    $selectedWord = '';

    // Find the selected word
    foreach ($post as $key => $value) {
      if (strpos($key, 'word') === 0) {
        $selectedWord = $value;
        break;
      }
    }

    $this->total++;

    $correctTranslation = [];
    $correct = false;
    foreach ($this->words as $wordPair) {
      if ($wordPair['word1'] === $testWord) {
        $correctTranslation[] = $wordPair['word2'];

        if ($wordPair['word2'] === $selectedWord) {
          echo "<p>Ĝuste!</p>";
          $this->correct++;
          $correct = true;
          break;
        }  
      }
    }

    if (!$correct) {
      echo "<p>Malĝuste. La ĝusta traduko de <i>" . $testWord . "</i> estas <i>" . implode("</i> aŭ <i>", $correctTranslation) . "</i>.</p>";
    }
  }

  public function grade_test($post) {
    $testWord = $post['test'];
    $answer = $post['answer'];

    $this->total++;

    $correctTranslation = [];
    $correct = false;
    foreach ($this->words as $wordPair) {
      if ($wordPair['word1'] === $testWord) {
        $correctTranslation[] = $wordPair['word2'];

        if (strtolower(preg_replace("/[[:punct:]]+/", "", $wordPair['word2'])) === strtolower(preg_replace("/[[:punct:]]+/", "", $answer))) {
          echo "<p>Ĝuste!</p>";
          $this->correct++;
          $correct = true;
          break;
        }  
      }
    }

    if (!$correct) {
      echo "<p>Malĝuste. La ĝusta traduko de <i>" . $testWord . "</i> estas <i>" . implode("</i> aŭ <i>", $correctTranslation) . "</i>.</p>";
      echo "<p>Vi respondis <i>" . $answer . "</i>.</p>";
    }
  }

  public function show_results() {
    echo "<p>Vi pravilis " . $this->correct . " el " . $this->total . ".</p>";
  }
}

?>
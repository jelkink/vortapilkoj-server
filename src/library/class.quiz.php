<?php

class Quiz {

  private $words;
  private $total;
  private $correct;

  public function __construct($words) {
    $this->words = $words;

    if (isset($_POST['test'])) {
      $this->total = $_POST['total'];
      $this->correct = $_POST['correct'];
    } else {
      $this->total = 0;
      $this->correct = 0;
    }
  }

  public function shuffle_words() {
    shuffle($this->words);
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
    echo "<form method=\"post\" action=\"index.php?page=quiz&session=$sessionid&list=$list\">";
    echo "<input type=\"hidden\" name=\"test\" value=\"" . htmlspecialchars($correctWordPair['word1']) . "\">";
    echo "<input type=\"hidden\" name=\"total\" value=\"" . $this->total . "\">";
    echo "<input type=\"hidden\" name=\"correct\" value=\"" . $this->correct . "\">";
    foreach ($options as $option) {
      echo "<button type=\"submit\" name=\"word" . $correctWordPair['id'] . "\" value=\"" . htmlspecialchars($option) . "\">" . htmlspecialchars($option) . "</button>";
    }
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

  public function show_results() {
    echo "<p>Vi pravilis " . $this->correct . " el " . $this->total . ".</p>";
  }
}

?>
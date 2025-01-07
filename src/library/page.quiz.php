<?php if (!$session->is_logged_in()): ?>
  <error>Vi devas ensaluti por vidi tiun paĝon</error>
<?php else: ?>
  
<h2>Kvizo</h2>

<?php

include($path_to_library . "class.quiz.php");

if (!isset($_GET['list']) && !isset($_POST['list'])) {
  echo "<error>Vi devas elekti liston</error>";
} else {

  $wl = new WordList($db);

  $selectedLists = $_POST['list'];

  for ($i = 0; $i < count($selectedLists); $i++) {
    $wl->read_list($selectedLists[$i]);
  }

  $words = $wl->get_list();

  $quiz = new Quiz($words);
  $quiz->shuffle_words();

  if (isset($_POST['test'])) {
    $quiz->grade_quiz($_POST);
    $quiz->show_results();
  } 
  
  $quiz->show_quiz($selectedLists);
}

?>

<? endif; ?>


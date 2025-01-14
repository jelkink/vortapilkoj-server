<?php

$showLists = true;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $selectedLists = $_POST['list'];

  if (empty($selectedLists)) {
    echo "Vi devas elekti liston.";
  } else {
    if (isset($_POST['delete']) && !empty($_POST['list'])) {
      include($path_to_library . 'page.deletelist.php');
    } elseif (isset($_POST['quiz']) && !empty($_POST['list'])) {
      include($path_to_library . "page.quiz.php");
      $showLists = false;
    } elseif (isset($_POST['test']) && !empty($_POST['list'])) {
      include($path_to_library . "page.test.php");
      $showLists = false;
    }
  }
}

if ($showLists) {

  $wl = new WordList($db);
  $wordlists = $wl->get_all_list_names();

  echo "<h2>Vortlistoj</h2>";

  echo "<form method=\"post\" action=\"index.php?page=lists&session=$sessionid\">";
  echo "<table>";
  echo "<tr><th></th><th>Titolo</th><th>Vortoj</th><th></th></tr>";

  foreach ($wordlists as $list) {
      echo "<tr><td><input type=\"checkbox\" name=\"list[]\" value=\"" . $list['id'] . "\"></td>"
          . "<td><a href=\"index.php?page=words&session=$sessionid&list=" . $list['id'] . "\">" 
          . htmlspecialchars($list['title']) . "</a></td><td>" . $list['len'] . "</td>"
          . "</tr>";
  }

  echo "</table><br>";
  echo "<input type=\"submit\" name=\"delete\" value=\"Forigi listojn\">";
  echo "<input type=\"submit\" name=\"quiz\" value=\"Krei kvizon\">";
  echo "<input type=\"submit\" name=\"test\" value=\"Krei teston\">";
  echo "</form>";

  echo "<br><a href=\"index.php?page=addlist&session=$sessionid \">Aldoni liston</a><br>";
}

?>


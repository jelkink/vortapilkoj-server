<?php if (!$session->is_logged_in()): ?>
  <error>Vi devas ensaluti por vidi tiun paĝon</error>
<?php else: ?>

<h2>Vortoj</h2>

<?php

if (!isset($_GET['list']) && !isset($_POST['list'])) {
  echo "<error>Vi devas elekti liston</error>";
} else {

  if (isset($_POST['list'])) {
    $listid = $_POST['list'];
  } else {
    $listid = $_GET['list'];
  }

  $wl = new WordList($db);
  $wl->read_list($listid);

  $words = $wl->get_list();
?>

<table>
  <tr>
    <th>Vorto</th>
    <th>Lingvo</th>
    <th>Traduko</th>
    <th>Lingvo</th>
    <th>Redakti</th>
  </tr>

<?php

  foreach ($words as $wordpair) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($wordpair['word1']) . "</td>";
    echo "<td>" . htmlspecialchars($wordpair['language1']) . "</td>";
    echo "<td>" . htmlspecialchars($wordpair['word2']) . "</td>";
    echo "<td>" . htmlspecialchars($wordpair['language2']) . "</td>";
    echo "<td><a href=\"index.php?page=editword&session=$sessionid&word=" . htmlspecialchars($wordpair['id']) . "&list=" . htmlspecialchars($listid) . "\">Redakti</a></td>";
    echo "</tr>";
  }
}

?>

</table>
<?php endif; ?>

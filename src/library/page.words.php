<h2>Vortoj</h2>

<?php

if (!isset($_GET['list'])) {
  echo "<error>Vi devas elekti liston</error>";
} else {

  $wl = new WordList($db);
  $wl->read_list($_GET['list']);

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
    echo "<td><a href=\"index.php?page=editword&word=" . htmlspecialchars($wordpair['id']) . "\">Redakti</a></td>";
    echo "</tr>";
  }
}

?>

</table>

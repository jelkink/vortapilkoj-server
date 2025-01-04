<?php if (!$session->is_logged_in()): ?>
  <error>Vi devas ensaluti por vidi tiun paĝon</error>
<?php else: ?>

<h2>Vortoj</h2>

<?php

if (!isset($_GET['list']) && !isset($_POST['list']) && !isset($_POST['language']) && !isset($_GET['language']) && !isset($_POST['search']) && !isset($_GET['search'])) {
  echo "<error>Vi devas elekti liston, serĉi aŭ elekti lingvon</error>";
} else {

  $wl = new WordList();

  if (isset($_POST['language'])) {
    $language = $_POST['language'];
    $wl->read_list_by_language($language);
  } elseif (isset($_GET['language'])) {
    $language = $_GET['language'];
    $wl->read_list_by_language($language);
  } elseif (isset($_POST['search'])) {
    $search = $_POST['search'];
    $wl->search_words($search);
  } elseif (isset($_GET['search'])) {
    $search = $_GET['search'];
    $wl->search_words($search);
  } else {
    $listid = isset($_POST['list']) ? $_POST['list'] : $_GET['list'];
    $wl->read_list($listid);
  }

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
    $queryParams = "session=$sessionid&word=" . htmlspecialchars($wordpair['id']);
    if (isset($listid)) {
      $queryParams .= "&list=" . htmlspecialchars($listid);
    } elseif (isset($language)) {
      $queryParams .= "&language=" . htmlspecialchars($language);
    } elseif (isset($search)) {
      $queryParams .= "&search=" . htmlspecialchars($search);
    }
    echo "<td><a href=\"index.php?page=editword&$queryParams\">Redakti</a></td>";
    echo "</tr>";
  }
}

?>

</table>
<?php endif; ?>

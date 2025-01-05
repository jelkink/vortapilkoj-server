<?php if (!$session->is_admin()): ?>
  <error>Vi devas esti administranto por vidi tiun paĝon</error>
<?php else: ?>

<?php
$listId = isset($_GET['list']) ? intval($_GET['list']) : 0;
$listId = isset($_POST['list']) ? intval($_POST['list']) : $listId;
$sessionId = isset($_GET['session']) ? htmlspecialchars($_GET['session']) : '';
$sessionId = isset($_POST['session']) ? htmlspecialchars($_POST['session']) : $sessionId;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm']) && $_POST['confirm'] === 'yes') {

  $db->query("DELETE FROM wordmapping WHERE list = $listId");
  $db->query("DELETE w FROM words w LEFT JOIN wordmapping wm ON w.id = wm.word WHERE wm.list IS NULL");
  $db->query("DELETE FROM wordlists WHERE id = $listId");
  
  include($path_to_library . "page.lists.php");
  exit;
}

$listTitle = '';
if ($listId > 0) {
  $results = $db->query("SELECT title FROM wordlists WHERE id = $listId");
  if ($results->rowCount() > 0) {
    $listTitle = $results->fetch(PDO::FETCH_ASSOC)['title'];
  }
}
?>

<h2>Forigi liston</h2>

<p>Ĉu vi certas?</p>
<p>Vi forigos la liston: <strong><?php echo htmlspecialchars($listTitle); ?></strong></p>

<form method="post" action="index.php?page=deletelist&session=<?php echo $sessionId ?>&list=<?php echo $listId ?>">
  <button type="submit" name="confirm" value="yes">Jes</button>
  <button type="submit" name="confirm" value="no">Ne</button>
</form>

<?php endif; ?>
<?php if (!$session->is_admin()): ?>
  <error>Vi devas esti administranto por vidi tiun paĝon</error>
<?php else: ?>

<?php

$selectedLists = $_POST['list'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm']) && $_POST['confirm'] === 'yes') {

  $wl = new WordList($db);

  for ($i = 0; $i < count($selectedLists); $i++) {
    $wl->delete_list($selectedLists[$i]);
  }
  
  include($path_to_library . "page.lists.php");
  exit;
}
?>

<h2>Forigi liston</h2>

<p>Ĉu vi certas?</p>
<p>Vi forigos <?php echo count($selectedLists); ?> listojn.</p>

<form method="post" action="index.php?page=deletelist&session=<?php echo $sessionid ?>">
  <?php foreach ($selectedLists as $list): ?>
    <input type="hidden" name="list[]" value="<?php echo htmlspecialchars($list); ?>">
  <?php endforeach; ?>
  <button type="submit" name="confirm" value="yes">Jes</button>
  <button type="submit" name="confirm" value="no">Ne</button>
</form>

<?php endif; ?>
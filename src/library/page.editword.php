
<?php if (isset($_POST['word1'])): ?>

  <?php

    $db->query("UPDATE words SET word1 = '" . $_POST['word1'] . "', language1 = " . $_POST['lang1'] . ", word2 = '" . $_POST['word2'] . "', language2 = " . $_POST['lang2'] . " WHERE id = " . $_POST['word']);

    include($path_to_library . "page.words.php");
  ?>

<?php else: ?>

<h2>Redakti vorton</h2>

<?php
  $wordid = $_GET['word'];
  $result = $db->query("SELECT word1, language1, word2, language2 FROM words WHERE id = " . $wordid);
  $word = $result->fetch(PDO::FETCH_ASSOC);
?>

<form action="index.php?page=editword" method="post">
  <table>
    <tr valign="top">
      <td>Vorto:</td>
      <td><input type="text" name="word1" value="<?php echo htmlspecialchars($word['word1']); ?>" required></td>
    </tr>
    <tr valign="top">
      <td>Lingvo:</td>
      <td><select name="lang1">
        <?php
          $result = $db->query("SELECT id, name FROM languages ORDER BY name");
          $languages = $result->fetchAll(PDO::FETCH_ASSOC);
          foreach ($languages as $language) {
            if ($language['id'] == $word['language1']) {
              echo "<option value=\"" . $language['id'] . "\" selected>" . htmlspecialchars($language['name']) . "</option>";
            } else {
              echo "<option value=\"" . $language['id'] . "\">" . htmlspecialchars($language['name']) . "</option>";
            }
          }
        ?>
      </select></td>
    </tr>
    <tr valign="top">
      <td>Traduko:</td>
      <td><input type="text" name="word2" value="<?php echo htmlspecialchars($word['word2']); ?>" required></td>
    </tr>
    <tr valign="top">
      <td>Lingvo:</td>
      <td><select name="lang2">
        <?php
          $result = $db->query("SELECT id, name FROM languages ORDER BY name");
          $languages = $result->fetchAll(PDO::FETCH_ASSOC);
          foreach ($languages as $language) {
            if ($language['id'] == $word['language2']) {
              echo "<option value=\"" . $language['id'] . "\" selected>" . htmlspecialchars($language['name']) . "</option>";
            } else {
              echo "<option value=\"" . $language['id'] . "\">" . htmlspecialchars($language['name']) . "</option>";
            }
          }
        ?>
      </select></td>
    </tr>
    <tr>
      <input type="hidden" name="word" value="<?php echo $wordid; ?>">
      <input type="hidden" name="list" value="<?php echo $_GET['list']; ?>">
      <td colspan="2"><input type="submit" value="Konservu la vorton"></td>
    </tr>
  </table>
</form>

<?php endif; ?>

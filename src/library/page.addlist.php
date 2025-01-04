<?php if (!$session->is_logged_in()): ?>
  <error>Vi devas ensaluti por vidi tiun paĝon</error>
<?php else: ?>

<h2>Aldonu novan liston</h2>

<?php if (isset($_POST['title'])): ?>
  <?php
  $title = htmlspecialchars($_POST['title']);
  $listid = $db->insert_query("INSERT INTO wordlists (title, creator) VALUES ('" . $title . "', " . $session->user_id . ")");

  $lang1 = $_POST['lang1'];
  $lang2 = $_POST['lang2'];

  $words = explode("\n", $_POST['words']);

  foreach($words as $word) {
    $word = explode($_POST["sep"], $word);

    if (count($word) > 0) {
      $word1 = trim($word[0]);
    }

    if (count($word) > 1) {
      $word2 = trim($word[1]);
    }

    if (count($word) > 2) {
      $notes = trim($word[2]);
    }
    if (count($word) == 2) {
      $wordid = $db->insert_query("INSERT INTO words (word1, language1, word2, language2, creator) VALUES ('" . $word1 . "', " . $lang1 . ", '" . $word2 . "', " . $lang2 . ", " . $session->user_id . ")");
    } elseif (count($word) == 3) {
      $wordid = $db->insert_query("INSERT INTO words (word1, language1, word2, language2, notes, creator) VALUES ('" . $word1 . "', " . $lang1 . ", '" . $word2 . "', " . $lang2 . ", '" . $notes . "', " . $session->user_id . ")");
    } else {
      continue;
    }

    $db->query("INSERT INTO wordmapping (list, word) VALUES (" . $listid . ", " . $wordid . ")");
  }
  ?>
  <p>Listo aldonita</p>

<?php else: ?>

<form action="index.php?page=addlist&session=<?php echo $sessionid ?>" method="post">
  <table>
    <tr valign="top">
      <td>Titolo de listo:</td>
      <td><input type="text" name="title" required></td>
    </tr>
    <tr valign="top">
      <td>Lingvo 1:</td>
      <td><select name="lang1">
        <?php
          $result = $db->query("SELECT id, name FROM languages ORDER BY name");
          $languages = $result->fetchAll(PDO::FETCH_ASSOC);
          foreach ($languages as $language) {
            echo "<option value=\"" . $language['id'] . "\">" . htmlspecialchars($language['name']) . "</option>";
          }
        ?>
      </select></td>
    </tr>
    <tr valign="top">
      <td>Lingvo 2:</td>
      <td><select name="lang2">
        <?php
          $result = $db->query("SELECT id, name FROM languages ORDER BY name");
          $languages = $result->fetchAll(PDO::FETCH_ASSOC);
          foreach ($languages as $language) {
            echo "<option value=\"" . $language['id'] . "\">" . htmlspecialchars($language['name']) . "</option>";
          }
        ?>
      </select></td>
    </tr>
    <tr valign="top">
      <td>Apartigilo:</td>
      <td><select name="sep">
        <option value=";">punto-komo</option>
        <option value=",">komao</option>
      </select></td>
    </tr>
    <tr valign="top">
      <td>Vortlisto:</td>
      <td><textarea name="words" rows="30" cols="50"></textarea></td>
    </tr>
    <tr>
      <td colspan="2"><input type="submit" value="Aldoni listo"></td>
    </tr>
  </table>
</form>

<?php endif; ?>
<?php endif; ?>


<?php if (isset($_POST['name'])): ?>
  <?php
  $lang = htmlspecialchars($_POST['name']);
  $db->insert_query("INSERT INTO languages (name) VALUES ('" . $lang . "')");

  include($path_to_library . "page.languages.php");
  ?>
 

<?php else: ?>

<h2>Aldonu novan lingvon</h2>

<form action="index.php?page=addlang" method="post">
  <table>
    <tr valign="top">
      <td>Lingvo:</td>
      <td><input type="text" name="name" required></td>
    </tr>
    <tr>
      <td colspan="2"><input type="submit" value="Aldoni lingvon"></td>
    </tr>
  </table>
</form>

<?php endif; ?>

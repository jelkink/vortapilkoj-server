
<h2>Aldonu novan liston</h2>

<?php if (isset($_POST['title'])): ?>
  <?php
  $title = htmlspecialchars($_POST['title']);
  $db->query("INSERT INTO wordlists (title) VALUES ('" . $title . "')");
  ?>
  <p>Listo aldonita</p>

<?php else: ?>

<form action="index.php?page=addlist" method="post">
  <table>
    <tr>
      <td>Titolo de listo:</td>
      <td><input type="text" name="title" required></td>
    </tr>
    <tr>
      <td colspan="2"><input type="submit" value="Aldoni listo"></td>
    </tr>
  </table>
</form>

<?php endif; ?>

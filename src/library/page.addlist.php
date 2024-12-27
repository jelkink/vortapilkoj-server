
<h2>Add new list</h2>

<?php if (isset($_POST['title'])): ?>
  <?php
  $title = htmlspecialchars($_POST['title']);
  $db->query("INSERT INTO wordlists (title) VALUES ('" . $title . "')");
  ?>
  <p>List added</p>

<?php else: ?>

<form action="index.php?page=addlist" method="post">
  <table>
    <tr>
      <td>List title:</td>
      <td><input type="text" name="title" required></td>
    </tr>
    <tr>
      <td colspan="2"><input type="submit" value="Add List"></td>
    </tr>
  </table>
</form>

<?php endif; ?>

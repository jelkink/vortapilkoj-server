<?php if (!$session->is_admin()): ?>
  <error>Vi devas esti administranto por vidi tiun paĝon</error>
<?php else: ?>

<h2>Uzantoj</h2>

<?php
$result = $db->query("SELECT id, email, admin FROM users ORDER BY email");

$users = $result->fetchAll(PDO::FETCH_ASSOC);

echo "<table>";
echo "<tr><th>Uzanto</th><th>Administranto</th></tr>";

foreach ($users as $user) {
  echo "<tr>";
  echo "<td>" . htmlspecialchars($user['email']) . "</td>";
  echo "<td>" . ($user['admin'] == 1 ? "Jes" : "Ne") . "</td>";
  echo "</tr>";
}

echo "</table>";
?>

<?php endif; ?>
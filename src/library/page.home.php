<h2>Hejmo</h2>

<p>Bonvenon al la administra paĝo de Vortapilkoj. Vi povas uzi ĉi tiun retejon por aldoni, redakti aŭ forigi, kaj importi aŭ eksporti, vortlistojn por la Android-aplikaĵo Vortapilkoj.</p>

<?php if ($session->is_logged_in()): ?>
  <p>Vi estas ensalutinta. <a href="index.php?page=logout&session=<?php echo $sessionid ?>">Elsaluti</a></p>
<?php else: ?>
<form action="index.php?page=login" method="post">
  <label for="email">Retpoŝto:</label>
  <input type="email" id="email" name="email" required><br><br>
  
  <label for="password">Pasvorto:</label>
  <input type="password" id="password" name="password" required><br><br>
  
  <button type="submit" name="action" value="register">Registriĝi</button>
  <button type="submit" name="action" value="login">Ensaluti</button>
</form>
<?php endif; ?>
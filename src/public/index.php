<html>
  <head>
    <title>Administrado de Vortapilkoj</title>
    <link rel="stylesheet" type="text/css" href="vt.css">
  </head>
  <body>
    <div class="container">
      <header>
        <h1>Administrado de Vortapilkoj</h1>
      </header>
      <nav>
        <a href="index.php?page=home">hejmo</a> | <a href="index.php?page=lists">listoj</a> | <a href="index.php?page=words">vortoj</a></li>
      </nav>
      <main>

<?php
// during development only!
error_reporting(E_ALL);
ini_set('display_errors', 1);

$path_to_library = "../library/";

require_once($path_to_library . "class.database.php");
require_once($path_to_library . "class.wordlist.php");

$db = new Database();
$db->Connect();

if (isset($_GET["page"])) {
  $page = htmlspecialchars($_GET["page"]);
  if (file_exists($path_to_library . "page." . $page . ".php")) {
    include($path_to_library . "page." . $page . ".php");
  } else {
    echo "<div class=\"error\">ERARO: Paĝo " . $page . " ne trovita!</div>";
  }
} else {
  include($path_to_library . "page.home.php");
}
?>

      </main>
      <footer>
        <p>&copy; 2024 <a href="https://www.joselkink.net">Jos Dornschneider-Elkink</a></p>
      </footer>
    </div>
  </body>
</html>
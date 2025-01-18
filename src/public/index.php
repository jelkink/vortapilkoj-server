<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>

<html>
  <head>
    <title>Administrado de Vortapilkoj</title>
    <link rel="stylesheet" type="text/css" href="vt.css">
  </head>

<?php
// during development only!
error_reporting(E_ALL);
ini_set('display_errors', 1);

$path_to_library = "../library/";

require_once($path_to_library . "class.database.php");
require_once($path_to_library . "class.session.php");
require_once($path_to_library . "class.wordlist.php");

$db = new Database();
$db->Connect();

$session = new Session();

if (isset($_GET["session"])) {
  $session->check_id($_GET["session"]);
  $sessionid = $_GET["session"];
} else {
  $sessionid = "";
}
?>


<body>
    <div class="container">
      <header>
        <h1>Administrado de Vortapilkoj</h1>
      </header>
      <nav>
        <a href="index.php?page=home&session=<?php echo $sessionid ?>">hejmo</a> | <a href="index.php?page=search&session=<?php echo $sessionid; ?>">vortoj</a> | <a href="index.php?page=lists&session=<?php echo $sessionid ?>">listoj</a> | <a href="index.php?page=languages&session=<?php echo $sessionid ?>">lingvoj</a> | <a href="index.php?page=users&session=<?php echo $sessionid ?>">uzantoj</a> | <a href="index.php?page=logout&session=<?php echo $sessionid ?>">eliri</a>
      </nav>
      <main>
<?php    
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

if ($session->user_id() == 1) {
  echo "<br><br><pre style='color: lightgray; white-space: pre-wrap;'>" . $db->get_queries() . "</pre>";
}
?>
      </main>
      <footer>
        <p>&copy; 2024 <a href="https://www.joselkink.net" target="_blank">Jos Dornschneider-Elkink</a></p>
      </footer>
    </div>
  </body>
</html>
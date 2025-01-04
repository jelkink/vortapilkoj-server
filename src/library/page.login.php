<?php
$email = $_POST['email'];
$password = $_POST['password'];
$action = $_POST['action'];

if ($action == "register") {
  $sessionid = $session->register($email, $password);
} elseif ($action == "login") {
  $sessionid = $session->login($email, $password);
}

echo "Ensalutu sukcesa. <a href=\"index.php?page=home&session=$sessionid\">Iru al ĉefpaĝo</a>.";
?>


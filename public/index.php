<?php
$path_to_library = "../library/";

require_once($path_to_library . "class.database.php");
require_once($path_to_library . "class.wordlist.php");

$db = new Database();
$db->Connect();

$wl = new WordList($db);

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['command']) && $_GET['command'] === 'LIST_NAMES') {
  $response = [
    'status' => 'success',
    'message' => $wl->get_all_list_names()
  ];
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['command']) && $_GET['command'] === 'LIST' && isset($_GET['name'])) {

  $listName = $_GET['name'];
  $wl->read_list($listName);
  $response = [
    'status' => 'success',
    'message' => $wl->get_list();
  ];
} else {
  $response = [
    'status' => 'error',
    'message' => 'Command not found'
  ];
}

header('Content-Type: application/json');
echo json_encode($response);
?>

<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$path_to_library = "../library/";

require_once($path_to_library . "class.database.php");
require_once($path_to_library . "class.wordlist.php");
require_once($path_to_library . "class.processor.php");

$db = new Database();
$db->Connect();

$pr = new Processor();

$result = [
  'status' => 'error',
  'message' => 'Neniu respondo trovita',
  'request' => $_REQUEST
];

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  if (isset($_GET['command'])) {
    $response = $pr->process($_GET['command'], $_GET);
  } else {
    $response = [
      'status' => 'error',
      'message' => 'Ordono ne trovita',
      'request' => $_GET
    ];
  }
} else {
  if (isset($_POST['command'])) {
    $response = $pr->process($_POST['command'], $_POST);
  } else {
    $response = [
      'status' => 'error',
      'message' => 'Ordono ne trovita',
      'request' => $_POST
    ];
  }
}

header('Content-Type: application/json');
echo json_encode($response);

?>

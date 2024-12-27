<?php
require_once '../library/database.php';

$db = new Database();
$db->Connect();

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['command']) && $_GET['command'] === 'LIST' && isset($_GET['name'])) {
  $listName = $_GET['name'];
  // Here you would normally fetch the list from a database or another source
  // For demonstration purposes, we'll return a static list
  $list = [
    'name' => $listName,
    'items' => ['item1', 'item2', 'item3']
  ];

  $response = [
    'status' => 'success',
    'data' => $list
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

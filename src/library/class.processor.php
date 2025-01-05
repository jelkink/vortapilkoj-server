<?php

class Processor {

  public function process($command, $params) {
    global $db;

    $response = [
      'status' => 'error',
      'message' => "Ordono '$command' ne trovita",
      'request' => $params
    ];
    if ($command === 'LIST_NAMES') {
      $response = $this->list_names($params);
    } elseif ($command === 'LIST') {
      $response = $this->list_words($params);
    }

    return $response;
  }

  function list_names($params) {

    $wl = new WordList();

    return [
      'status' => 'success',
      'message' => $wl->get_all_list_names(json: true),
      'request' => $params
    ];
  }

  function list_words($params) {

    $wl = new WordList();
    
    if (isset($params['list'])) {
      $listId = $params['list'];
      $wl->read_list($listId);
      return [
        'status' => 'success',
        'message' => $wl->get_list(json: true),
        'request' => $params
      ];
    } else {
      return [
        'status' => 'error',
        'message' => 'Listnumero ne disponigita',
        'request' => $params
      ];
    }
  }
}

?>
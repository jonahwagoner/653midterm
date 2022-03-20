<?php
  // Headers
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to UPDATE
  $quote->id = $data->id;

  // Delete post
  if($quote->delete()) {
    if ($quote->id) {
      echo json_encode(
        array('id' => $quote->id)
      );
    } else {
      echo json_encode(
        array('message' => 'No Quotes Found')
      );
    }
  } else {
    echo json_encode(
      array('message' => 'Delete failed')
    );
  }
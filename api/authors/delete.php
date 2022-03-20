<?php
  // Headers
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to UPDATE
  $author->id = $data->id;

  // Delete post
  if($author->delete()) {
    echo json_encode(
      array('id'  => $author->id)
    );
  } else {
    echo json_encode(
      array('message' => 'Author not deleted')
    );
  }
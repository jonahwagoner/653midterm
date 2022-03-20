<?php
  // Headers
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  if ($data->id == null || $data->author == null) {
    echo json_encode(
      array('message' => 'Missing Required Parameters')
    );
    die();
  }

  // Set ID to UPDATE
  $author->id = $data->id;

  $author->author = $data->author;

  // Update post
  if($author->update()) {
    echo json_encode(
      array(
        'id' => $author->id,
        'author' => $author->author
      )
    );
  } else {
    echo json_encode(
      array('message' => 'Author not updated')
    );
  }
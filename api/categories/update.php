<?php
  // Headers
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  if ($data->id == null || $data->category == null) {
    echo json_encode(
      array('message' => 'Missing Required Parameters')
    );
    die();
  }


  // Set ID to UPDATE
  $category->id = $data->id;

  $category->category = $data->category;

  // Update post
  if($category->update()) {
    echo json_encode(
        array(
            'id' => $category->id,
            'category' => $category->category
          )
    );
  } else {
    echo json_encode(
      array('message' => 'Category not updated')
    );
  }
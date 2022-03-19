<?php
  // Headers
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to UPDATE
  $category->id = $data->id;

  // Delete post
  if($category->delete()) {
    echo json_encode(
      array('message' => 'Category deleted')
    );
  } else {
    echo json_encode(
      array('message' => 'Category not deleted')
    );
  }
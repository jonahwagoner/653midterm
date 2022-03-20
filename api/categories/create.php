<?php
// Headers
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');


  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  if ($data->category == null) {
    echo json_encode(
      array('message' => 'Missing Required Parameters')
    );
    die();
  }

  $category->category = $data->category;

  // Create Category
  if($category->create()) {
    echo json_encode(
        array(
            'id' => $category->id,
            'category' => $category->category
          )   
         );
  } else {
    echo json_encode(
      array('message' => 'Category Not Created')
    );
  }
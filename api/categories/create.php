<?php
// Headers
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');


  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  $category->category = $data->category;

  // Create Category
  if($category->create()) {
    echo json_encode(
        array(
            'id' => $category->id,
            'author' => $category->category
          )   
         );
  } else {
    echo json_encode(
      array('message' => 'Category Not Created')
    );
  }
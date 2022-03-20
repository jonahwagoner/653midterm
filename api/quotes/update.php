<?php
  // Headers
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  if ($data->authorId == null || $data->categoryId == null || $data->quote == null) {
    echo json_encode(
      array('message' => 'Missing Required Parameters')
    );
    die();
  }

  $category = new Category($db);
  $category->id = $data->categoryId;
  $category->read_single();
  $author = new Author($db);
  $author->id = $data->authorId;
  $author->read_single();

  if ($author->id == null) {
    echo json_encode(
      array('message' => 'authorId Not Found')
    );
    die();
  } else if ($category->id == null) {
    echo json_encode(
      array('message' => 'categoryId Not Found')
    );
    die();
  }

  // Set ID to UPDATE
  $quote->id = $data->id;

  $quote->quote = $data->quote;

  $quote->authorId = $data->authorId;

  $quote->categoryId = $data->categoryId;

  // Update post
  if($quote->update()) {
    if ($quotes->id) {
      echo json_encode(
        array(
          'id' => $quote->id,
          'quote' => $quote->quote,
          'authorId' => $quote->authorId,
          'categoryId' => $quote->categoryId
        )
      );
    } else {
      echo json_encode(
        array('message' => 'No Quotes Found')
      );    }
  } else {
    echo json_encode(
      array('message' => 'Quotes not updated')
    );
  }
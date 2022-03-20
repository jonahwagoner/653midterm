<?php 

  // Get ID
  $quote->categoryId = isset($_GET['categoryId']) ? $_GET['categoryId'] : null;
  $quote->authorId = isset($_GET['authorId']) ? $_GET['authorId'] : null;
  
  // Quote read query
  $result = $quote->read();
  
  // Get row count
  $num = $result->rowCount();

  // Check if any categories
  if($num > 0) {
        // Cat array
        $cat_arr = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {

          // echo $quote->id;
          extract($row);

          $author = new Author($db);
          $category = new Category($db);
          $author->id = $authorId;
          $category->id = $categoryId;
          $author->read_single();
          $category->read_single();

          $cat_item = array(
            'id' => $id,
            'quote' => $quote,
            'author' => $author->author,
            'category' => $category->category
          );

          // Push to "data"
          array_push($cat_arr, $cat_item);
        }

        // Turn to JSON & output
        echo json_encode($cat_arr);

  } else {
        // No Categories
        echo json_encode(
          array('message' => 'No Quotes Found')
        );
  }
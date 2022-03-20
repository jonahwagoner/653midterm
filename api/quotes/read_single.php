<?php

  // Get ID
  $quote->id = isset($_GET['id']) ? $_GET['id'] : die();

  // Get quote
  $quote->read_single();

  // Get category
  $category = new Category($db);
  $category->id = $quote->categoryId;
  $category->read_single();

    // Get author
    $author = new Author($db);
    $author->id = $quote->authorId;
    $author->read_single();

  // Create array

  $quote_arr;
  if ($quote->id === null) {
    $quote_arr = array(
      'message' => "No Quotes Found",
    );
  } else {
    $quote_arr = array(
      'id' => $quote->id,
      'quote' => $quote->quote,
      'author' => $author->author,
      'category' => $category->category
    );
  }

  // Make JSON
  print_r(json_encode($quote_arr));
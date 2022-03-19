<?php

  // Get ID
  $category->id = isset($_GET['id']) ? $_GET['id'] : die();

  // Get post
  $category->read_single();

  // Create array


  $category_arr;
  if ($category->id === null) {
    $category_arr = array(
      'message' => "categoryId Not Found",
    );
  } else {
    $category_arr = array(
      'id' => $category->id,
      'category' => $category->category
    );
  }

  // Make JSON
  print_r(json_encode($category_arr));
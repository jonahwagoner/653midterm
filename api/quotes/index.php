<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Quote.php';
  include_once '../../models/Category.php';
  include_once '../../models/Author.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $quote = new Quote($db);

  $method = $_SERVER['REQUEST_METHOD'];

  if ($method === 'POST') {
    include_once './create.php';
  } else if ($method === 'GET' && isset($_GET['id'])) {
    include_once './read_single.php';
  } else if ($method === 'GET') {
      include_once './read.php';
  } else if ($method === 'PUT') {
    include_once './update.php';
  } else if ($method === 'DELETE') {
    include_once './delete.php';
  }
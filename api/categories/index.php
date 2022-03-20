<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Category.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $category = new Category($db);

  $method = $_SERVER['REQUEST_METHOD'];

  if ($method === 'OPTIONS') {
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
}

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
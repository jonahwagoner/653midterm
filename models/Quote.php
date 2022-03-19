<?php

include_once './Category.php';
include_once './Authors.php';

  class Quote {
    // DB Stuff
    private $conn;
    private static $TABLE = 'quotes';

    // Properties
    public $id;
    public $quote;
    public $categoryId;
    public $authorId;


    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get quotes
    public function read() {
      // Create query
      $query = 'SELECT
      id, quote, categoryId, authorId
      FROM
      ' . $TABLE . '
      WHERE id = ?
      LIMIT 0,1';
    //   $query = 'SELECT
    //     q.id,
    //     q.quote,
    //     a.author,
    //     c.category
    //     FROM
    //     ' . $TABLE . ' q' .
    //     'JOIN ' . Category::$TABLE .'c on ' . ' c.id = q.categoryId ' .
    //     'JOIN ' . Author::$TABLE . 'a on ' . ' a.id = q.authorId ' .

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Get Single Quote
  public function read_single(){
    // Create query
    $query = 'SELECT
        id, quote, categoryId, authorId
        FROM
        ' . $TABLE . '
        WHERE id = ?
        LIMIT 0,1';
    // $query = 'SELECT
    //     q.id as id,
    //     q.quote as quote,
    //     a.author as author,
    //     c.category as category
    //       FROM
    //     ' . $TABLE . ' q' .
    //     'JOIN ' . Category::$TABLE .'c on ' . ' c.id = q.categoryId ' .
    //     'JOIN ' . Author::$TABLE . 'a on ' . ' a.id = q.authorId 
    //   WHERE id = ?
    //   LIMIT 0,1';

      //Prepare statement
      $stmt = $this->conn->prepare($query);

      // Bind ID
      $stmt->bindParam(1, $this->id);

      // Execute query
      $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      // set properties
      $this->id = $row['id'];
      $this->quote = $row['quote'];
      $this->authorId = $row['authorId'];
      $this->categoryId = $row['categoryId'];
  }

  // Create Quote
  public function create() {
    // Create Query
    $query = 'INSERT INTO ' .
      $TABLE. '
    SET
      quote = :quote,
      authorId = :authorId,
      categoryId = :categoryId
      ';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->quote = htmlspecialchars(strip_tags($this->quote));

  // Bind data
  $stmt-> bindParam(':quote', $this->quote);
  $stmt-> bindParam(':authorId', $this->authorId);
  $stmt-> bindParam(':categoryId', $this->categoryId);

  // Execute query
  if($stmt->execute()) {
    return true;
  }

  // Print error if something goes wrong
  printf("Error: $s.\n", $stmt->error);

  return false;
  }

  // Update Quote
  public function update() {
    // Create Query
    $query = 'UPDATE ' .
      $TABLE. '
    SET
      quote = :quote,
      authorId = :authorId,
      categoryId = :categoryId
      WHERE
      id = :id';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $stmt-> bindParam(':quote', $this->quote);
  $stmt-> bindParam(':authorId', $this->authorId);
  $stmt-> bindParam(':categoryId', $this->categoryId);

  // Bind data
  $stmt-> bindParam(':quote', $this->quote);
  $stmt-> bindParam(':id', $this->id);

  // Execute query
  if($stmt->execute()) {
    return true;
  }

  // Print error if something goes wrong
  printf("Error: $s.\n", $stmt->error);

  return false;
  }

  // Delete Quote
  public function delete() {
    // Create query
    $query = 'DELETE FROM ' . $TABLE. ' WHERE id = :id';

    // Prepare Statement
    $stmt = $this->conn->prepare($query);

    // clean data
    $this->id = htmlspecialchars(strip_tags($this->id));

    // Bind Data
    $stmt-> bindParam(':id', $this->id);

    // Execute query
    if($stmt->execute()) {
      return true;
    }

    // Print error if something goes wrong
    printf("Error: $s.\n", $stmt->error);

    return false;
    }
  }
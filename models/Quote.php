<?php

  class Quote {
    // DB Stuff
    private $conn;
    private $table = 'quotes';

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
        
        $queryEnd = '';
        if ($this->categoryId && $this->authorId) {
            $queryEnd = ' WHERE categoryId = ? AND authorId = ?';
        } else if ($this->categoryId) {
            $queryEnd = ' WHERE categoryId = ?';
        } else if ($this->authorId) {
            $queryEnd = ' WHERE authorId = ?';
        }
      // Create query
      $query = 'SELECT
      id, quote, categoryId, authorId
      FROM
      ' . $this->table . $queryEnd;

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Bind params
      if ($this->categoryId && $this->authorId) {
        $stmt->bindParam(1, $this->categoryId);
        $stmt->bindParam(2, $this->authorId);
    } else if ($this->categoryId) {
        $stmt->bindParam(1, $this->categoryId);
    } else if ($this->authorId) {
        $stmt->bindParam(1, $this->authorId);
    }



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
        ' . $this->table . '
        WHERE id = ?
        LIMIT 0,1';
    // $query = 'SELECT
    //     q.id as id,
    //     q.quote as quote,
    //     a.author as author,
    //     c.category as category
    //       FROM
    //     ' . $this->table . ' q' .
    //     'JOIN ' . Category::$this->table .'c on ' . ' c.id = q.categoryId ' .
    //     'JOIN ' . Author::$this->table . 'a on ' . ' a.id = q.authorId 
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
      $this->table. '
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
    $this->id = $this->conn->lastInsertId();
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
      $this->table. '
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
    if ($stmt->rowCount() == 0) {
        $this->id = null;
    }
    return true;
  }

  // Print error if something goes wrong
  printf("Error: $s.\n", $stmt->error);

  return false;
  }

  // Delete Quote
  public function delete() {
    // Create query
    $query = 'DELETE FROM ' . $this->table. ' WHERE id = :id';

    // Prepare Statement
    $stmt = $this->conn->prepare($query);

    // clean data
    $this->id = htmlspecialchars(strip_tags($this->id));

    // Bind Data
    $stmt-> bindParam(':id', $this->id);

    // Execute query
    if($stmt->execute()) {
        if ($stmt->rowCount() == 0) {
            $this->id = null;
        }
      return true;
    }

    // Print error if something goes wrong
    printf("Error: $s.\n", $stmt->error);

    return false;
    }
  }
<?php 
  class slots {
    // DB stuff
    private $conn;
    private $table = 'slots';

    // Post Properties
    public $id;
    public $name;
    public $stock;
    public $reference;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get Posts
    public function read() {
      // Create query
      $query = 'SELECT * FROM ' . $this->table ;
                               
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }
  
    

    // Get Single Post
    public function read_single() {
          // Create query
          $query = 'SELECT * FROM ' . $this->table . ' 
                                        WHERE
                                      id = ?
                                    ';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Bind ID
          $stmt->bindParam(1, $this->id);

          // Execute query
          $stmt->execute();

          $row = $stmt->fetch(PDO::FETCH_ASSOC);

          // Set properties
          $this->id = $row['id'];
          $this->name = $row['name'];
          $this->stock = $row['stock'];
          $this->reference = $row['reference'];
         
    }
  
    

    // Create Post
    public function create() {
          // Create query
          $query =    'INSERT INTO '.$this->table.' (name,stock,reference)
VALUES (:name,:stock,:reference)';


          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->name = htmlspecialchars(strip_tags($this->name));
          $this->stock = htmlspecialchars(strip_tags($this->stock));
          $this->reference = htmlspecialchars(strip_tags($this->reference));
         

          // Bind data
          $stmt->bindParam(':name', $this->name);
          $stmt->bindParam(':stock', $this->stock);
          $stmt->bindParam(':reference', $this->reference);
       

          // Execute query
          if($stmt->execute()) {
            return true;
      }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
    }
  

    // Update Post
    public function update() {
          // Create query
          $query = 'UPDATE ' . $this->table . '
                                SET name= :name, stock = :stock, reference = :reference
                                WHERE id = :id';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->name = htmlspecialchars(strip_tags($this->name));
          $this->stock = htmlspecialchars(strip_tags($this->stock));
          $this->reference = htmlspecialchars(strip_tags($this->reference));
        
          $this->id = htmlspecialchars(strip_tags($this->id));

          // Bind data
          $stmt->bindParam(':name', $this->name);
          $stmt->bindParam(':stock', $this->stock);
          $stmt->bindParam(':reference', $this->reference);
          
          $stmt->bindParam(':id', $this->id);

          // Execute query
          if($stmt->execute()) {
            return true;
          }

          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);

          return false;
    }
    // Delete Post
    public function delete() {
          // Create query
          $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->id = htmlspecialchars(strip_tags($this->id));

          // Bind data
          $stmt->bindParam(':id', $this->id);

          // Execute query
          if($stmt->execute()) {
            return true;
          }

          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);

          return false;
    }
    
  }
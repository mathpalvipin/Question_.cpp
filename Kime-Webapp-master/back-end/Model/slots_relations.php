<?php 
  class slots_relations{
    // DB stuff
    private $conn;
    private $table = 'slots_relations';

    // Post Properties
    public $product_slot;
    public $aux_slot;
   

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
          $this->product_slot= $row['product_slot'];
          $this->aux_slot= $row['aux_slot'];
          
         
    }
  
    

    // Create Post
    public function create() {
          // Create query
          $query =    'INSERT INTO '.$this->table.' (product_slot,aux_slot)
VALUES (:product_slot,:aux_slot)';


          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->product_slot= htmlspecialchars(strip_tags($this->product_slot));
          $this->aux_slot = htmlspecialchars(strip_tags($this->aux_slot));
          
         

          // Bind data
          $stmt->bindParam(':product_slot', $this->product_slot);
          $stmt->bindParam(':aux_slot', $this->aux_slot);
         
       

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
                                SET product_slot= :product_slot, aux_slot = :aux_slot
                                WHERE id = :id';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->product_slot= htmlspecialchars(strip_tags($this->product_slot));
          $this->aux_slot = htmlspecialchars(strip_tags($this->aux_slot));
       
          $this->id = htmlspecialchars(strip_tags($this->id));

          // Bind data
          $stmt->bindParam(':product_slot', $this->product_slot);
          $stmt->bindParam(':aux_slot', $this->aux_slot);
          
          
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

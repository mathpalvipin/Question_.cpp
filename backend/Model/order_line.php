<?php 
  class order_line {
    // DB stuff
    private $conn;
    private $table = 'order_line';

    // Post Properties
    public $product;
    public $amount;
    
   

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
         
          $this->name = $row['product'];
          $this->stock = $row['amount'];
          
    }
     public function create() {
          // Create query
          $query =    'INSERT INTO '.$this->table.'(product,amount)
VALUES (:product,:amount)';


          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->product= htmlspecialchars(strip_tags($this->product));
          $this->amount = htmlspecialchars(strip_tags($this->amount));
         
         

          // Bind data
          $stmt->bindParam(':product', $this->product);
          $stmt->bindParam(':amount', $this->amount);
          
       

          // Execute query
          if($stmt->execute()) {
            return true;
      }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
    }
     public function update() {
          // Create query
          $query = 'UPDATE ' . $this->table . '
                                SET product= :product, amount = :amount
                                WHERE id = :id';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->product = htmlspecialchars(strip_tags($this->product));
          $this->amount = htmlspecialchars(strip_tags($this->amount));
        
        
          $this->id = htmlspecialchars(strip_tags($this->id));

          // Bind data
          $stmt->bindParam(':product', $this->product);
          $stmt->bindParam(':amount', $this->amount);
         
          
          $stmt->bindParam(':id', $this->id);

          // Execute query
          if($stmt->execute()) {
            return true;
          }

          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);

          return false;
    }
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
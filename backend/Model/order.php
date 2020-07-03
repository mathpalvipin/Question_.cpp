<?php 
  class order {
    // DB stuff
    private $conn;
    private $table = 'order1';

    // Post Properties
    public $status;
    public $message;
    public $language;
   

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
         
          $this->status = $row['status'];
          $this->message = $row['message'];
          $this->language = $row['language'];
          
    }
     public function create() {
          // Create query
          $query =    'INSERT INTO '.$this->table.'(status,message,language)
VALUES (:status,:message,:language)';


          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->status= htmlspecialchars(strip_tags($this->status));
          $this->message = htmlspecialchars(strip_tags($this->message));
          $this->language = htmlspecialchars(strip_tags($this->language));
         
         

          // Bind data
          $stmt->bindParam(':status', $this->status);
          $stmt->bindParam(':message', $this->message);
          $stmt->bindParam(':language', $this->language);

          
       

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
                                SET status= :status, message = :message ,language=:language
                                WHERE id = :id';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->status = htmlspecialchars(strip_tags($this->status));
          $this->message= htmlspecialchars(strip_tags($this->message));
          $this->language= htmlspecialchars(strip_tags($this->language));
        
        
          $this->id = htmlspecialchars(strip_tags($this->id));

          // Bind data
          $stmt->bindParam(':status', $this->status);
          $stmt->bindParam(':message', $this->message);
          $stmt->bindParam(':language', $this->language);
         
          
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
          $query = 'DELETE FROM ' . $this->table . ' WHERE id =:id';

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
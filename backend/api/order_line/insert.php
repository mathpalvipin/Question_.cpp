
 
<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../Model/order_line.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $post = new order_line($db);

  // Get raw posted data
  
     
      
   $post->product = $_REQUEST["product"];
  $post->amount = $_REQUEST["amount"];
  
 
  // Create post
  if($post->create()) {
    echo json_encode(
      array('message' => 'order_line Created')
    );
  } else {
    echo json_encode(
      array('message' => 'order_line Not Created')
    );
  }
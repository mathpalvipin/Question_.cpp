
 
<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../Model/order.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $post = new order($db);

  // Get raw posted data
  
     
      
   $post->status = $_REQUEST["status"];
  $post->message = $_REQUEST["message"];
  $post->language = $_REQUEST["language"];
  
 
  // Create post
  if($post->create()) {
    echo json_encode(
      array('message' => 'order Created')
    );
  } else {
    echo json_encode(
      array('message' => 'order Not Created')
    );
  }
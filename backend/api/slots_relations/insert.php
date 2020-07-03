
 
<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../Model/slots_relations.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $post = new slots_relations($db);

  // Get raw posted data
  
    
      
   $post->product_slot = $_REQUEST["product_slot"];
  $post->aux_slot = $_REQUEST["aux_slot"];
  
 
  // Create post
  if($post->create()) {
    echo json_encode(
      array('message' => 'slots_relation Created')
    );
  } else {
    echo json_encode(
      array('message' => 'slots_relations Not Created')
    );
  }
<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../Model/order_line.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $post = new order_line($db);

  // Get raw posted data
 
  // Set ID to update
  $post->id =$_REQUEST["id"];

    $post->product = $_REQUEST["product"];
  $post->amount= $_REQUEST["amount"];
  
 
  // Update post
  if($post->update()) {
    echo json_encode(
      array('message' => 'order_line Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'order_line Not Updated')
    );
  }
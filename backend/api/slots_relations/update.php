<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../Model/slots_relations.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $post = new slots_relations($db);

  // Get raw posted data
 
  // Set ID to update
  $post->id =$_REQUEST["id"];

    $post->product_slot = $_REQUEST["product_slot"];
  $post->aux_slot= $_REQUEST["aux_slot"];
  
 
  // Update post
  if($post->update()) {
    echo json_encode(
      array('message' => 'slots_relation Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'slots_relation Not Updated')
    );
  }
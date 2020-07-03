<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../Model/slots.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $post = new slots($db);

  // Get raw posted data
  
  // Set ID to update
  $post->id = $_REQUEST['id'];

  // Delete post
  if($post->delete()) {
    echo json_encode(
      array('message' => 'slot Deleted')
    );
  } else {
    echo json_encode(
      array('message' => 'slot Not Deleted')
    );
  }
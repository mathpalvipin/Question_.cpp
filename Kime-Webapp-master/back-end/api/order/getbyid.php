<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../Model/order.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $post = new  order($db);

  // Get ID
  $post->id = isset($_GET['id']) ? $_GET['id'] : die();

  // Get post
  $post->read_single();

  // Create array
  $post_arr = array(
    'id' => $post->id,
    'status' => $post->status,
    'message' => $post->message,
        'language' =>$post->message
    
  
  );

  // Make JSON
  print_r(json_encode($post_arr));

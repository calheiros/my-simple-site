<?php

// Get the request method
$method = $_SERVER['REQUEST_METHOD'];
$json_path = "../data/data.json";

// Check the request method
if ($method === 'GET') {
  // Set the content type to JSON
  header("Content-Type: application/json");
  // Get the JSON data and return it
  echo get_json($json_path);
} else {
  // Return an error message for unsupported request methods
  echo send_response($status = "err", $err_message = "Unsupported request method: {$method}");
}

// Function to get the JSON data from a file
function get_json($file) {
  // Read the contents of the file
  $raw = file_get_contents($file);
  // If the file could not be opened, return an error response
  if (!$raw) {
    return send_response($status = "err", $err_message = "Error opening JSON file: {$GLOBALS['json_path']}");
  }
  // Decode the JSON data
  $obj = json_decode($raw);
  // If the JSON data could not be decoded, return an error response
  if (!$obj) {
    return send_response($status = "err", $err_message = "Error decoding JSON file!");
  }
  // Return a success response with the JSON data
  return send_response($status = "ok", $data = $obj);
}

// Function to send a response
function send_response($status, $data, $err_message = "") {
  // Create the response array
  $response = array(
    "error" => $err_message,
    "status" => $status,
    "data" => $data
  );
  // Encode the response array as JSON and return it
  return json_encode($response);
}
?>
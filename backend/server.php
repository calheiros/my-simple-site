<?php
   $method = $_SERVER['REQUEST_METHOD'];
 
   switch ($method) {
      case 'GET':
         header("Content-Type: application/json");
         echo get_json("src/data.json");
         break;
      case 'POST':
         echo "há algo de errado! 🙀🤔";
         break;
   }
   
   function get_json($file) {
      $raw = file_get_contents($file) or 
         die ("error to open json file: <strong>" . JSON_FILE ."</strong>" );
      $obj = json_decode($raw) or 
         die ("error to decode json file!");
         
      return json_encode($obj);
   }
?>
<?php
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type');


include_once '../dbconnect/Database.php';
include_once '../main/Marker.php';

$database = new Database();
$db = $database->connect();

$marker = new Marker($db);

$marker->accident_id  = $_COOKIE['_id'];




if ($marker->delete()) {
  echo "<h2>Marker Deleted!</h2>";
  echo "<a href ='../../index.php' id='add-marker'>Back to Maps</a>";
}
else {
  echo "<h2>Marker Not Deleted!</h2>";
  echo "<a href ='../../index.php' id='add-marker'>Back to Maps</a>";
}



?>

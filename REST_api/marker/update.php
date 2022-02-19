<?php
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type');


include_once '../dbconnect/Database.php';
include_once '../main/Marker.php';

$database = new Database();
$db = $database->connect();

$marker = new Marker($db);

$data = array("date" => $_POST['date'],
              "time" => $_POST['time'],
              "latitude" => $_POST['latitude'],
              "longitude" => $_POST['longitude'],
              "accidentseverity" => $_POST['accidentseverity'],
              "numberofvehicles" => $_POST['numberofvehicles'],
              "numberofcasualties" => $_POST['numberofcasualties'],
              "accidentid" => $_POST['accidentid']
);



$marker->date = $data['date'];
$marker->time = $data['time'];
$marker->latitude = $data['latitude'];
$marker->longitude = $data['longitude'];
$marker->accident_severity = $data['accidentseverity'];
$marker->number_of_vehicles = $data['numberofvehicles'];
$marker->number_of_casualties = $data['numberofcasualties'];
$marker->accident_id = $data['accidentid'];


$marker->update();

?>

<!DOCTYPE html>
<body>
<h1>Marker Updated!</h1>
<a href ='../../index.php' id='add-marker'>Back to Maps</a>
</div>
</body>

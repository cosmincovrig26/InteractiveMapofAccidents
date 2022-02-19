<!DOCTYPE html>

<head>
  <style>
  .container {
    width: 150px;
    clear: both;
  }

  .container select {
    width: 150px;
    clear: both;
  }

  .container input {
    width: 100%;
    clear: both;
  }

  </style>

</head>

<body>



</body>

<?php

include_once '../dbconnect/Database.php';
include_once '../main/Marker.php';

$database = new Database();
$db = $database->connect();

$marker = new Marker($db);

//Get ID
$marker->accident_id  = $_COOKIE['_id'];
// Get marker
$marker->single_marker();

$marker_arr = array(
  'Date' => $marker->date,
  'Time' => $marker->time,
  'Latitude' => $marker->latitude,
  'Longitude' =>$marker->longitude,
  'Accident Severity' =>$marker->accident_severity,
  'Number of Vehicles' =>$marker->number_of_vehicles,
  'Number of Casualties' =>$marker->number_of_casualties,

);
if (isset($_COOKIE['lon']))
{
  $marker_arr['Latitude'] = $_COOKIE['lat'];
  $marker_arr['Longitude'] = $_COOKIE['lon'];
}
echo
"<div class='container'>
  <form action='update.php' method='POST'>
    <label for='Latitude'>Latitude:</label>
    <input type='number' step ='any' id='Latitude' name='latitude' value=" . $marker_arr['Latitude'] . " required><br><br>
    <label for='Longitude'>Longitude:</label>
    <input type='number' step ='any' id='Longitude' name='longitude' value=" . $marker_arr['Longitude'] . " required><br><br>
    <label for='AccidentID'>ID:</label>
    <input type='text' id='AccidentID' name='accidentid' value =" . $marker->accident_id . " readonly ><br><br>
    <a href='../../index2.php'><img src='../../maps.webp' height='80px' width='80px'></a><br><br>
    <label for='Date'>Date:</label>
    <input type='date' id='Date' name='date' value=" . $marker_arr['Date'] . " required><br><br>
    <label for='Time'>Time:</label>
    <input type='time' id='Time' name='time' value=" . $marker_arr['Time'] . " required><br><br>

    <label for='Accident_Severity'>Accident Severity:</label>
    <input type='number id='Accident_Severity' name='accidentseverity' value=". $marker_arr['Accident Severity'] . " required><br><br>
    <label for='Number_of_Vehicles'>Number of Vehicles:</label>
    <input type='number' id='Number_of_Vehicles' name='numberofvehicles' value=" . $marker_arr['Number of Vehicles'] . " required><br><br>
    <label for='Number_of_Casualties'>Number of Casualties:</label>
    <input type='number' id='Number_of_Casualties' name='numberofcasualties' value=" . $marker_arr['Number of Casualties'] . " required><br><br>
    <input type='submit' value='Submit'>
  </form>
<br><br>

<a href ='../../index.php' id='add-marker'>Back to Maps</a>
</div>
";

?>

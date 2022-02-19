<?php
header('Content-Type: application/json');

include_once '../dbconnect/Database.php';
include_once '../main/Marker.php';

$database = new Database();
$db = $database->connect();

$marker = new Marker($db);

$result = $marker->read();

$geojson = array('type' => 'FeatureCollection', 'features' => array());

# Build GeoJSON feature collection array
$geojson = array(
   'type'      => 'FeatureCollection',
   'features'  => array()
);


while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $properties = $row;
    unset($properties['Longitude']);
    unset($properties['Latitude']);
    $properties = array(
      "Accident ID" => $row['Accident_id'],
      "Date" => $row['Date'],
      "Time" => $row['Time'],
      "Accident Severity" => $row['Accident_Severity'],
      "Number of Vehicles" => $row['Number_of_Vehicles'],
      "Number of Casualties" => $row['Number_of_Casualties'],
      "Speed Limit" => $row['Speed_limit'],
);
    $feature = array(
        'type' => 'Feature',
        'geometry' => array(
            'type' => 'Point',
            'coordinates' => array(
                floatval($row['Longitude']),
                floatval($row['Latitude'])
            )
        ),
        'properties' => $properties
    );
    array_push($geojson['features'], $feature);
}

echo json_encode($geojson);
 ?>

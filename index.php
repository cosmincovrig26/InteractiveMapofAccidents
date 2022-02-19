<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, intial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Web Map Of Accidents in 2017</title>
  <link rel="stylesheet" href="./styles.css">
  <link rel="stylesheet" href="./libs/v6.5.0-dist/ol.css">
</head>
<body>

    <h2><span style="border-bottom: 1px solid black">Interactive Map of Accidents in the UK 2017</span></h2>

    <div class="grid-container">
      <div class="grid-1">
        <div class="navbar">
          <h3><span style="border-bottom: 1px solid black">Choose Layer<span></h3>
          <input type="radio" name='LayerRadioButton' value='OSMLayerOne' checked>Layer One<br>
          <input type="radio" name='LayerRadioButton' value='OSMLayerTwo'>Layer Two<br>
          <input type="radio" name='LayerRadioButton' value='OSMLayerThree'>Layer Three<br>
        </div>
      </div>
      <div class="grid-2">
        <h3><span style="border-bottom: 1px solid black">Add Marker<span></h3>
        <a href ="REST_api/marker/addmarker.php" id='add-marker'><img src="add.png" width="50" height="50"></a>
      </div>
      <div class="grid-3">
        <h2>Press on Markers to interact or modify!</h2>
      </div>

    </div>
  <div id='js-map' class='map'></div>


  <div class="overlay-container">
    <span class='overlay-text' id='Date'></span><br>
    <span class='overlay-text' id='NumberOfVehicles'></span><br>
    <span class='overlay-text' id='NumberOfCasualties'></span><br>
    <span class='overlay-text' id='AccidentSeverity'></span><br>
    <span class='overlay-text' id='SpeedLimit'></span><br><br>
    <a href="REST_api/marker/singlemarker.php"><img src="edit.png" width="20" height="20"></a>
    <a href="REST_api/marker/delete.php"><img src="delete.png" width="20" height="20"></a>
  </div>



  <script src='./main.js'></script>
  <script src='./libs/v6.5.0-dist/ol.js'></script>
  </body>
  </html>

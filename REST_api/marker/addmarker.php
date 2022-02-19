<script>





  function myFunction() {
    setCookie("coordinates",1,10);
  }

  function setCookie(name, value, days) {
  var d = new Date();
  d.setTime(d.getTime() + (days*24*60*60*1000));
  var expires = "expires="+ d.toUTCString();
  document.cookie = name + "=" + value + ";" + expires + ";path=/";
}


  function deleteAllCookies() {
    var cookies = document.cookie.split(";");

    for (var i = 0; i < cookies.length; i++) {
        var cookie = cookies[i];
        var eqPos = cookie.indexOf("=");
        var name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
        document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT";
    }
}
</script>


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

  .location input {
    float: left;
  }

  </style>

</head>

<body>

<?php
if (!isset($_COOKIE['coordinates']))
{
  $_COOKIE['lat'] = " ";
  $_COOKIE['lon'] = " ";
}

echo
"<div class='container'>
<form action='create.php' method='POST'>
  <label for='Latitude'>Latitude:</label>
  <input type='number' step ='any' id='Latitude' name='latitude' value=" .  $_COOKIE['lat'] . " required><br><br>
  <label for='Longitude'>Longitude:</label>
  <input type='number' step ='any' id='Longitude' name='longitude' value=" . $_COOKIE['lon'] . " required><br><br>
  <a href='../../index2.php' onclick='myFunction()'><img src='../../maps.webp' height='80px' width='80px'></a><br><br>
  <label for='Date'>Date:</label>
  <input type='date' id='Date' name='date' required><br><br>
  <label for='Time'>Time:</label>
  <input type='time' id='Time' name='time' required><br><br>
  <label for='Accident_Severity'>Accident Severity:</label>
  <input type='number id='Accident_Severity' name='accidentseverity' required><br><br>
  <label for='Number_of_Vehicles'>Number of Vehicles:</label>
  <input type='number' id='Number_of_Vehicles' name='numberofvehicles' required><br><br>
  <label for='Number_of_Casualties'>Number of Casualties:</label>
  <input type='number' id='Number_of_Casualties' name='numberofcasualties' required><br><br>
  <input type='submit' value='Submit'>
</form>

</div>";

if (isset($_POST['submit']))
{
  echo "Marker Added!";
}

 ?>

<br><br>
<a href ="../../index.php" id='add-marker'>Back to Maps</a>

</body>

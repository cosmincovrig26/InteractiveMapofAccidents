window.onload = function() {
  init();
};

function init() {
  const map = new ol.Map({
    view: new ol.View({   //defines area where the map is displayed
      center: [-631421.9851685409, 7263115.246612376],
      zoom: 6,
      maxZoom: 19,
      minZoom: 4
    }),
    target: 'js-map'    //html element to which you attach your map
  })

  //Vector Layers and Map Layers

  const layerTwo = new ol.layer.Tile({
    source: new ol.source.OSM(),
    visible: false,
    title: 'OSMLayerTwo'
  })

  const layerThree = new ol.layer.Tile({
    source: new ol.source.OSM({
      url: 'https://{a-c}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png',
    }),
    visible: false,
    title: 'OSMLayerThree'
  })

  const layerOne = new ol.layer.Tile({
    source: new ol.source.XYZ({
      url: 'http://tile.stamen.com/terrain/{z}/{x}/{y}.jpg',
      attributions: 'Map tiles by <a href="http://stamen.com">Stamen Design</a>, under <a href="http://creativecommons.org/licenses/by/3.0">CC BY 3.0</a>. Data by <a href="http://openstreetmap.org">OpenStreetMap</a>, under <a href="http://www.openstreetmap.org/copyright">ODbL</a>.'
    }),
    visible: true,
    title: 'OSMLayerOne'
  })

  // Layer Group
  const baseLayerGroup = new ol.layer.Group({
    layers: [
      layerOne, layerTwo, layerThree
    ]
  })
  map.addLayer(baseLayerGroup);

  //Layer Switcher

  const baseLayerElements = document.querySelectorAll('.navbar > input[type=radio]');
  for(let baseLayerElement of baseLayerElements){
    baseLayerElement.addEventListener('change',function(){
      let baseLayerElementVal = (this.value);
      baseLayerGroup.getLayers().forEach(function(element, index, array){
        let baseLayerTitle = element.get('title');
        element.setVisible(baseLayerTitle === baseLayerElementVal);
      })
    })
  }

  const strokeStyle = new ol.style.Stroke({
    color: [46, 45, 45, 1],                   //border around the circle
    width: 1.2
  })

  const circleStyle = new ol.style.Circle({
      fill: new ol.style.Fill({
      color: [245, 49, 5, 1]                  //circle colour
    }),
    radius: 7,
    stroke: strokeStyle
  })



  const MarkersGeoJSON = new ol.layer.VectorImage({
    source: new ol.source.Vector({
      url: './REST_api/marker/read.php', // ./data/vector_data/map.geojson   OR  ./REST_api/marker/read.php
      format: new ol.format.GeoJSON()
    }),
    visible: true,
    title: 'Markers',
    style: new ol.style.Style({
      image: circleStyle
    })
  })

    keys = MarkersGeoJSON.getKeys();
    console.log(keys);

  map.addLayer(MarkersGeoJSON);

  //Vector Popup Logic
  const overlayContainerElement = document.querySelector('.overlay-container');
  const overlayLayer = new ol.Overlay({
    element: overlayContainerElement
  })
  map.addOverlay(overlayLayer);
  const overlayDate = document.getElementById('Date');
  const overlayVehicles = document.getElementById('NumberOfVehicles');
  const overlayCasualties = document.getElementById('NumberOfCasualties');
  const overlaySeverity = document.getElementById('AccidentSeverity');
  const overlaySpeed = document.getElementById('SpeedLimit');

  map.on('click', function(e){
    overlayLayer.setPosition(undefined);
    map.forEachFeatureAtPixel(e.pixel, function(feature,layer){



      let clickedCoordinate = e.coordinate;
      let featureID = feature.get('Accident ID')
      let clickedFeatureDate = feature.get('Date');
      let clickedFeatureTime = feature.get('Time');
      let clickedFeatureVehicles = feature.get('Number of Vehicles');
      let clickedFeatureCasualties = feature.get('Number of Casualties');
      let clickedFeatureSeverity = feature.get('Accident Severity');
      let clickedFeatureSpeed = feature.get('Speed Limit');

      overlayLayer.setPosition(clickedCoordinate);
      overlayDate.innerHTML = 'Date: ' + clickedFeatureDate + " " + clickedFeatureTime;
      overlayVehicles.innerHTML = 'Number of Vehicles: ' + clickedFeatureVehicles;
      overlayCasualties.innerHTML = 'Number of Casualties: ' + clickedFeatureCasualties;
      overlaySeverity.innerHTML = 'Accident Severity: ' + clickedFeatureSeverity;
      overlaySpeed.innerHTML = 'Speed Limit: ' + clickedFeatureSpeed;

    })
  })

  map.on('click', function(f){
      var lonlat = ol.proj.transform(f.coordinate, 'EPSG:3857', 'EPSG:4326');
      var lon = lonlat[0];
      var lat = lonlat[1];
      setCookie('lon',lon,10);
      setCookie('lat',lat,10);
      var isSet = getCookie('coordinates');

      if (isSet) {
            window.location.href = 'REST_api/marker/addmarker.php';
      }
      else {
          window.location.href = 'REST_api/marker/singlemarker.php';
      }


  })




    function deleteAllCookies() {
      var cookies = document.cookie.split(";");

      for (var i = 0; i < cookies.length; i++) {
          var cookie = cookies[i];
          var eqPos = cookie.indexOf("=");
          var name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
          document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT";
      }
  }



    function setCookie(name, value, days) {
    var d = new Date();
    d.setTime(d.getTime() + (days*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = name + "=" + value + ";" + expires + ";path=/";
  }

    function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
  }





}

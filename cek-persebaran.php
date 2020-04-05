<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Check up covid 19</title>

  <!-- Latest compiled and minified CSS & JS -->
  <link rel="stylesheet" media="screen" href="//netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css"
    integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
    crossorigin="" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.3.0/dist/MarkerCluster.css" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.3.0/dist/MarkerCluster.Default.css" />
  <script src="//code.jquery.com/jquery.js"></script>
  <!-- Make sure you put this AFTER Leaflet's CSS -->
  <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>


  <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"
    integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
    crossorigin=""></script>
  <script src="https://unpkg.com/leaflet.markercluster@1.3.0/dist/leaflet.markercluster.js"></script>

  <style>
    #map {
      height: 500px;
    }
  </style>
</head>

<body>

  <div class="container">
    <div class="col-md-12">
      <div class="page-header">
        <h1>DETEKSI DINI COVID-19 ONLINE</h1>
        <small>Cek deteksi dini virus covid 19 pada dirimu</small>
      </div>
    </div>

    <form action="">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-body">
            <div id='map' style='width: 100%'></div>
          </div>
        </div>

      </div>
  </div>
  </div>
  <script>
    var addressPoints = [
      [-37.8210922667, 175.2209316333, "2"],
      [-37.8210819833, 175.2213903167, "3"],
      [-37.8210881833, 175.2215004833, "3A"],
      [-37.8211946833, 175.2213655333, "1"],
      [-37.8209458667, 175.2214051333, "5"],
      [-37.8208292333, 175.2214374833, "7"],
      [-37.8325816, 175.2238798667, "537"],
      [-37.8315855167, 175.2279767, "454"],
      [-37.8096336833, 175.2223743833, "176"],
      [-37.80970685, 175.2221815833, "178"],
      [-37.8102146667, 175.2211562833, "190"],
      [-37.8088037167, 175.2242227, "156"],
      [-37.8112330167, 175.2193425667, "210"],
      [-37.8116368667, 175.2193005167, "212"],
      [-37.80812645, 175.2255449333, "146"],
      [-37.8080231333, 175.2286383167, "125"],
      [-37.8089538667, 175.2222222333, "174"],
      [-37.8080905833, 175.2275400667, "129"]
    ]

    var map = L.map('map').setView([-37.82, 175.23], 13);

    L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
      attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    var markers = L.markerClusterGroup();

    for (var i = 0; i < addressPoints.length; i++) {
      var a = addressPoints[i];
      var title = a[2];
      var marker = L.marker(new L.LatLng(a[0], a[1]), {
        title: title
      });
      marker.bindPopup(title);
      markers.addLayer(marker);
    }

    map.addLayer(markers);
  </script>
</body>

</html>
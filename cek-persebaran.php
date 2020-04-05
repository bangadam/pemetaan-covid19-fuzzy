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
    $(document).ready(function () {
      $.ajax({
        type: "GET",
        url: "aksi.php?operasi=getDataMarkers",
        success: function name(data) {
          var item = JSON.parse(data);
          var map = L.map('map').setView([-7.4664, 112.4338], 6);

          L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
          }).addTo(map);

          var markers = L.markerClusterGroup();
          for (var i = 0; i < item.length; i++) {
            var a = item[i];
            var title = a[3];
            var marker = L.marker(new L.LatLng(a[0], a[1]), {
              title: title.total
            });
            
            marker.bindPopup(
              "Kota :"+ a[2] +"<br>"+
              "Total Pasien :"+ title.total +"<br>"+
              "ODR :"+ title.ODR +"<br>"+
              "ODP :"+ title.ODP +"<br>"+
              "PDP :"+ title.PDP +"<br>"+
              "POSITIF :"+ title.POSITIF +"<br>"
            );
            markers.addLayer(marker);
          }

          map.addLayer(markers);
        }
      })
    })
  </script>
</body>

</html>
<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Check up covid 19</title>

  <!-- Latest compiled and minified CSS & JS -->
  <link rel="stylesheet" media="screen" href="//netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <link href='https://api.mapbox.com/mapbox-gl-js/v1.8.1/mapbox-gl.css' rel='stylesheet' />
  <script src="//code.jquery.com/jquery.js"></script>
  <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
  <script src='https://api.mapbox.com/mapbox-gl-js/v1.8.1/mapbox-gl.js'></script>


  <style>
    #map-persebaran {
      height: 300px;
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
            <div id='map-persebaran' style='width: 100%'></div>
          </div>
        </div>

      </div>
  </div>
  </div>
  <script>
    $(document).ready(function () {
      mapboxgl.accessToken =
        'pk.eyJ1IjoiYmFuZ2FkYW0iLCJhIjoiY2s4bWh1cTZwMGYzMzNnbjFqZ3ZpaGhkbyJ9.oadGEJKx7P3kaYmNzUOLRg';
      var map = new mapboxgl.Map({
        container: 'map-persebaran',
        style: 'mapbox://styles/mapbox/light-v10',
        zoom: 12,
        center: [-122.447303, 37.753574]
      });

      map.on('load', function () {
        /* Sample feature from the `examples.8fgz4egr` tileset:
        {
        "type": "Feature",
        "properties": {
        "ethnicity": "White"
        },
        "geometry": {
        "type": "Point",
        "coordinates": [ -122.447303, 37.753574 ]
        }
        }
        */
        map.addSource('ethnicity', {
          type: 'vector',
          url: 'mapbox://examples.8fgz4egr'
        });
        map.addLayer({
          'id': 'population',
          'type': 'circle',
          'source': 'ethnicity',
          'source-layer': 'sf2010',
          'paint': {
            // make circles larger as the user zooms from z12 to z22
            'circle-radius': {
              'base': 1.75,
              'stops': [
                [12, 2],
                [22, 180]
              ]
            },
            // color circles by ethnicity, using a match expression
            // https://docs.mapbox.com/mapbox-gl-js/style-spec/#expressions-match
            'circle-color': [
              'match',
              ['get', 'ethnicity'],
              'White',
              '#fbb03b',
              'Black',
              '#223b53',
              'Hispanic',
              '#e55e5e',
              'Asian',
              '#3bb2d0',
              /* other */
              '#ccc'
            ]
          }
        });
      });
    })
  </script>
</body>

</html>
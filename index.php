<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Check up covid 19</title>

  <!-- Latest compiled and minified CSS & JS -->
  <link rel="stylesheet" media="screen" href="//netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
   <!-- Load Leaflet from CDN -->
   <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
  integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
  crossorigin=""/>
  <script src="//code.jquery.com/jquery.js"></script>
  <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
  integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
  crossorigin=""></script>

  <!-- Load Esri Leaflet from CDN -->
  <script src="https://unpkg.com/esri-leaflet@2.3.3/dist/esri-leaflet.js"
  integrity="sha512-cMQ5e58BDuu1pr9BQ/eGRn6HaR6Olh0ofcHFWe5XesdCITVuSBiBZZbhCijBe5ya238f/zMMRYIMIIg1jxv4sQ=="
  crossorigin=""></script>


  <!-- Load Esri Leaflet Geocoder from CDN -->
  <link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder@2.3.2/dist/esri-leaflet-geocoder.css"
    integrity="sha512-IM3Hs+feyi40yZhDH6kV8vQMg4Fh20s9OzInIIAc4nx7aMYMfo+IenRUekoYsHZqGkREUgx0VvlEsgm7nCDW9g=="
    crossorigin="">
  <script src="https://unpkg.com/esri-leaflet-geocoder@2.3.2/dist/esri-leaflet-geocoder.js"
    integrity="sha512-8twnXcrOGP3WfMvjB0jS5pNigFuIWj4ALwWEgxhZ+mxvjF5/FBPVd5uAxqT8dd2kUmTVK9+yQJ4CmTmSg/sXAQ=="
    crossorigin=""></script>
  <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
  <style>
    #mapid { height: 300px; }
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
        <div class="panel panel-info">
          <div class="panel-heading">
            <h3 class="panel-title">Identitas diri</h3>
          </div>
          <div class="panel-body">
            <div class="form-group">
              <label for="">Nama</label>
              <input type="text" name="nama_pasien" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="">Usia</label>
              <input type="number" name="usia" class="form-control" min="0" required>
            </div>
            <div class="form-group">
              <label for="">Jenis Kelamin</label>
              <select name="jenis_kelamin" class="form-control" required>
                <option selected disabled>-Pilih Jenis Kelamin-</option>
                <option value="L">Laki-Laki</option>
                <option value="P">Perempuan</option>
              </select>
            </div>
            <div class="form-group">
              <label for="">Tanggal Lahir</label>
              <input type="date" name="tanggal_lahir" class="form-control" required="required">
            </div>
            <div class="form-group">
              <label for="">Telepon</label>
              <input type="text" name="telepon" class="form-control" required>
            </div>
          </div>
        </div>

        
        <div class="panel panel-default">
          <div class="panel-body">
          <div id="mapid"></div>
          </div>
        </div>
        <div class="panel panel-danger">
            <div class="panel-heading">
              <h3 class="panel-title">Deteksi Gejala</h3>
            </div>
            <div class="panel-body">
              <div class="table-responsive">
                <table class="table table-striped">
                  <tbody>
                  <?php
                  $result = $database->query('SELECT * FROM gejala');
                  $no = 1;
                  while ($data = $result->fetch_object()) {
                      ?>
                    <tr>
                      <td><?php echo $data->nmgejala; ?></td>
                      <td>:</td>
                      <td>
                            <input type="radio" name="gj-<?php echo $no; ?>" id="input" value="1">
                            Ya
                            <input type="radio" name="gj-<?php echo $no; ?>" id="input" value="2">
                            Tidak
                        </div>
                      </td>
                    </tr>
                  <?php
                  ++$no;
                  } ?>
                  </tbody>
                </table>
                
              </div>
            </div>
        </div>
        <button class="btn btn-primary btn-block">Check</button>
      </div>
    </form>
  </div>
  <script>
     var map = L.map('mapid').setView([-7.5517, 112.6325], 5);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
  attribution: '&copy; <a href="https://osm.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

var geocodeService = L.esri.Geocoding.geocodeService();

map.on('click', function (e) {
  geocodeService.reverse().latlng(e.latlng).run(function (error, result) {
    if (error) {
      return;
    }

    L.marker(result.latlng).addTo(map).bindPopup(result.address.Match_addr).openPopup();
  });
});
  </script>
</body>
</html>
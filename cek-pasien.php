<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Check up covid 19</title>

  <!-- Latest compiled and minified CSS & JS -->
  <link rel="stylesheet" media="screen" href="//netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <script src="//code.jquery.com/jquery.js"></script>
  <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

</head>
<body>

  <div class="container">
  <div class="col-md-12">
      <div class="page-header">
        <h1>DETEKSI DINI COVID-19 ONLINE</h1>
        <small>Cek deteksi dini virus covid 19 pada dirimu</small>
      </div>
    </div>
    <div class="col-md-12">
      <div class="panel panel-info">
          <div class="panel-heading">
            <h3 class="panel-title">Tambah gejala</h3>
          </div>
          <div class="panel-body">
            
              <div class="table-responsive">
                
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Nama Pasien</th>
                      <th>Usia</th>
                      <th>Jenis Kelamin</th>
                      <th>Tanggal Lahir</th>
                      <th>Telepon</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  include 'koneksi.php';
                  $result = $database->query('SELECT * FROM pasien');
                  while ($data = $result->fetch_object()) {
                      ?>
                    <tr>
                      <td><?php echo $data->nmpasien; ?></td>
                      <td><?php echo $data->usia; ?></td>
                      <td><?php echo 'L' == $data->jk ? 'Laki-Laki' : 'Perempuan'; ?></td>
                      <td><?php echo $data->tgllahir; ?></td>
                      <td><?php echo $data->telepon; ?></td>
                    </tr>
                  <?php
                  } ?>
                  </tbody>
                </table>
              </div>
              
          </div>
      </div>
      
    </div>
  </div>

</body>
</html>
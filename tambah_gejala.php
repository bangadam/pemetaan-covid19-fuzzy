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
            
            <a class="btn btn-primary" data-toggle="modal" href='#modal-id'>Tambah Gejala</a>
            <div class="modal fade" id="modal-id">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Tambah Gejala</h4>
                  </div>
                  <div class="modal-body">
                    <form action="aksi.php?operasi=tambah_gejala" method="POST">
                      <div class="form-group">
                        <label for="">Kode gejala</label>
                        <input type="text" name="kode_gejala" class="form-control" required>
                      </div>
                      <div class="form-group">
                        <label for="">Nama Gejala</label>
                        <input type="text" name="nama_gejala" class="form-control" required>
                      </div>
                      <div class="form-group">
                        <label for="">Keterangan</label>
                        <textarea name="keterangan" class="form-control" rows="10"></textarea>
                      </div>
                      <div class="form-group">
                        <label for="">Jenis</label>
                        <input type="text" name="jenis" class="form-control" required>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            
              <div class="table-responsive">
                
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Kode gejala</th>
                      <th>Nama gejala</th>
                      <th>keterangan</th>
                      <th>jenis</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  include 'koneksi.php';
                  $result = $database->query('SELECT * FROM gejala');
                  while ($data = $result->fetch_object()) {
                      ?>
                    <tr>
                      <td><?php echo $data->kode; ?></td>
                      <td><?php echo $data->nmgejala; ?></td>
                      <td><?php echo $data->keterangan; ?></td>
                      <td><?php echo $data->jenis; ?></td>
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
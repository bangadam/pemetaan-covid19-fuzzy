<?php include 'koneksi.php'; session_start(); ?>
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
  </script>
  <style>
    .list-gejala li {
      margin-bottom: 5px;
    }

    .list-gejala li input {
      margin-top: 5px;
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
    <?php
      if ($_SESSION['pesan']) {
          ?>

    <div class="col-md-12">
      <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        hasil test menunjukkan anda berstatus <b><?php echo $_SESSION['status']; ?></b>
      </div>
    </div>

    <?php
      } ?>
    <form action="aksi.php?operasi=check-pasien" method="POST">
      <div class="col-md-12">
        <div class="panel panel-info">
          <div class="panel-heading">
            <h3 class="panel-title">Identitas diri</h3>
          </div>
          <div class="panel-body">
            <a href="cek-persebaran.php" class="btn btn-primary">Cek persebaran virus corona</a>
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


        <div class="panel panel-info">
          <div class="panel-heading">
            <h3 class="panel-title">Alamat sekarang / tinggal</h3>
          </div>
          <div class="panel-body">
            <div class="form-group">
              <label for="">Provinsi <span style="color: red;font-weight: bold">(Wajib/Diisi)</span></label>
              <input type="text" name="provinsi" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="">Kota <span style="color: red;font-weight: bold">(Wajib/Diisi)</span></label>
              <input type="text" name="kota" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="">Kecamatan <span style="color: red;font-weight: bold">(Wajib/Diisi)</span></label>
              <input type="text" name="kecamatan" class="form-control" required>
            </div>

            <div class="form-group">
              <label for="">Desa/Kel <span style="color: red;font-weight: bold">(Wajib/Diisi)</span></label>
              <input type="text" name="desa" class="form-control" required>
            </div>

          </div>
        </div>


        <div class="panel panel-danger">
          <div class="panel-heading">
            <h3 class="panel-title">Deteksi Gejala</h3>
          </div>
          <div class="panel-body">
            <ol class="list-gejala">
              <?php
                  $result = $database->query('SELECT * FROM gejala');
                  $no = 0;
                  while ($data = $result->fetch_object()) {
                      ?>
              <li>
                <?php echo $data->nmgejala; ?> : <br>
                <input type="radio" name="gj[<?php echo $data->id_gejala; ?>]" value="10">
                Ya
                <input type="radio" name="gj[<?php echo $data->id_gejala; ?>]" value="0">
                Tidak
              </li>
              <hr>
              <?php
                  ++$no;
                  } ?>
            </ol>
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
    $(document).ready(function () {})
  </script>
</body>

</html>
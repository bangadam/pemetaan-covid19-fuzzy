<?php

include 'koneksi.php';
session_start();

switch ($_GET['operasi']) {
  case 'tambah_gejala':
    $kode_gejala = $_POST['kode_gejala'];
    $nama_gejala = $_POST['nama_gejala'];
    $keterangan = $_POST['keterangan'];
    $jenis = $_POST['jenis'];

    $result = $database->query("INSERT INTO gejala VALUES(null, '{$kode_gejala}', '{$nama_gejala}', '{$keterangan}', '{$jenis}')");

    if (!$result) {
        die($database->error);
    }

    header('Location: tambah_gejala.php');

    break;
    case 'check-pasien':
      try {
          $nama_pasien = $_POST['nama_pasien'];
          $usia_pasien = $_POST['usia'];
          $jenis_kelamin = $_POST['jenis_kelamin'];
          $tanggal_lahir = $_POST['tanggal_lahir'];
          $telepon = $_POST['telepon'];

          // kita hanya butuh kota buat dapetin info lat long
          $kota = $_POST['kota'];
          $kecamatan = $_POST['kecamatan'];
          $queryString = http_build_query([
              'auth' => '832171980526706675239x5302',
              'scantext' => $kota,
              'region' => 'ID',
              'geojson' => '1',
          ]);

          $ch = curl_init(sprintf('%s?%s', 'https://geocode.xyz', $queryString));
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

          $json = curl_exec($ch);

          curl_close($ch);

          $apiResult = json_decode($json, true);
          // simpan markers
          $latitude = $apiResult['properties']['lat'];
          $longitude = $apiResult['properties']['lon'];
          $statusCode = null;
          $name = $kota;
          $address = $_POST['desa'];

          /*
            pembobotan pasien berdasarkan gejala yang dialami
            menggunakan algoritma fuzzy

            80-100 dinyatakan positif corona
            60-79 dinyatakan pdp
            40-59 dinyatakan odp
            20-39 dinyatakan odr
            0-19 dinyatakan negatif

            semua gejala bernilai 20 point

            terima kasih untuk yuliana dan faradilah telah membantu melakukan perhitugan fuzzynya
          */
          // penentuan status
          $total_semua = array_sum($_POST['gj']);
          $statusPasien = null;
          if ($total_semua <= 0 && $total_semua <= 19) {
              $statusPasien = 'NEGATIF';
          } elseif ($total_semua >= 20 && $total_semua <= 39) {
              $statusPasien = 'ODR';
          } elseif ($total_semua >= 40 && $total_semua <= 59) {
              $statusPasien = 'ODP';
          } elseif ($total_semua >= 60 && $total_semua <= 79) {
              $statusPasien = 'PDP';
          } elseif ($total_semua >= 80 && $total_semua <= 100) {
              $statusPasien = 'POSITIF';
          }

          // insert data markers
          $marker = $database->query("INSERT INTO markers VALUES(null,'{$statusCode}','{$name}','{$address}','{$latitude}','{$longitude}','{$statusPasien}')");
          if (!$marker) {
              die('error di marker '.$database->error);
          }
          $id_marker = $database->insert_id;
          // // insert data pasien
          $pasien = $database->query("INSERT INTO pasien VALUES(null, '{$id_marker}', '{$nama_pasien}', '{$usia_pasien}', '{$jenis_kelamin}', '{$tanggal_lahir}', '{$telepon}')");
          if (!$pasien) {
              die('error di pasien '.$database->error);
          }
          $id_pasien = $database->insert_id;

          $jawab_gejala = $_POST['gj'];
          foreach ($jawab_gejala as $key => $value) {
              // insert data ngetest
              if (10 == $value) {
                  $database->query("INSERT INTO ngetest VALUES(null, '{$id_pasien}', '{$key}', null, 'ya', null)");
              } elseif (0 == $value) {
                  $database->query("INSERT INTO ngetest VALUES(null, '{$id_pasien}', '{$key}', null, 'tidak', null)");
              }
          }

          $_SESSION['status'] = $statusPasien;
          $_SESSION['pesan'] = true;

          header('Location: index.php');
      } catch (Exception $e) {
          die($e->getMessage());
      }

    break;
    case 'getDataMarker':
      $result = $database->query('SELECT * FROM markers');

      // no break
      default:
  default:
    // code...
    break;
}

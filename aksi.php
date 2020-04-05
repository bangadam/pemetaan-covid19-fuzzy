<?php

include 'koneksi.php';

switch ($_GET['operasi']) {
  case 'tambah_gejala':
    $kode_gejala = $_POST['kode_gejala'];
    $nama_gejala = $_POST['nama_gejala'];
    $keterangan = $_POST['keterangan'];
    $jenis = $_POST['jenis'];

    $result = $database->query("INSERT INTO gejala VALUES(null, '{$kode_gejala}', '{$nama_gejala}', '{$keterangan}', '{$keterangan}')");

    if (!$result) {
        die($database->error);
    }

    header('Location: tambah_gejala.php');

    break;
  default:
    // code...
    break;
}

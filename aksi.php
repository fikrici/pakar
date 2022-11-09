<?php
include 'fungsi/fungsi.php';
$konfig = konfig();
$koneksi = koneksi();
session_start();
if(!isset($_SESSION['username'])) {
    header('location:'.$konfig['url'].'login.php'); 
}elseif ($_SESSION['level'] == 1) {
    header('location:'.$konfig['url'].'admin/index.php');
}

if (@$_GET['i'] == 'inputdiagnosa') {
    $id = kodeotomatis('diagnosa','id_diagnosa',3,'DNS');
    $i = 0;
    foreach ($_POST['gejala'] as $value) {
      $data = array(
        'id' => '',
        'id_diagnosa' => $id,
        'id_gejala' => $value,
        'id_pasien' => $_SESSION['id_pasien'],
        'nilai' => $_POST['nilai'][$i]
      );
      $add = insert('diagnosa',$data);
      // print_r($data);
      $i++;
    }
      if ($add) {
          header("Content-Type: application/json");
        echo json_encode(array('status' => 'sukses', 'url' => 'riwayat.php'), JSON_PRETTY_PRINT);
      } else {
          header("Content-Type: application/json");
        echo json_encode(array('status' => 'gagal'), JSON_PRETTY_PRINT);
      }
  }
<?php
include '../../../fungsi/fungsi.php';
$konfig = konfig();
$koneksi = koneksi();
$urladmin = str_replace('admin/aksi/pasien/','',$konfig['url']);
session_start();
if(!isset($_SESSION['username'])) {
    header('location:'.$urladmin.'admin/login.php'); 
}elseif ($_SESSION['level'] != 1) {
    header('location:'.$urladmin.'index.php');
}


if (@$_GET['i'] == 'delete' && isset($_GET['id'])) {
    $delete = delete('pasien','id_pasien',$_GET['id']);
    delete('users','id_pasien',$_GET['id']);
    delete('diagnosa','id_pasien',$_GET['id']);
    if ($delete) {
        header("Content-Type: application/json");
      echo json_encode(array('status' => 'sukses'), JSON_PRETTY_PRINT);
    } else {
        header("Content-Type: application/json");
      echo json_encode(array('status' => 'gagal'), JSON_PRETTY_PRINT);
    }
}


?>
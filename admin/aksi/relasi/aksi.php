<?php
include '../../../fungsi/fungsi.php';
$konfig = konfig();
$koneksi = koneksi();
$urladmin = str_replace('admin/aksi/penyakit/','',$konfig['url']);
session_start();
if(!isset($_SESSION['username'])) {
    header('location:'.$urladmin.'admin/login.php'); 
}elseif ($_SESSION['level'] != 1) {
    header('location:'.$urladmin.'index.php');
}


if (@$_GET['i'] == 'inputgejala') {
  $i = 0;
  foreach (array_filter($_POST['cf']) as $key => $value) {
    $data = array(
      'id_relasipg' => kodeotomatis('penyakitgejala','id_relasipg',3,'PG'),
      'id_penyakit' => $_POST['id_penyakitgejala'],
      'id_gejala' => $_POST['gejala'][$i],
      'cf' => $value
    );
    $add = insert('penyakitgejala',$data);
    $i++;
  }
    
    if ($add) {
        header("Content-Type: application/json");
      echo json_encode(array('status' => 'sukses'), JSON_PRETTY_PRINT);
    } else {
        header("Content-Type: application/json");
      echo json_encode(array('status' => 'gagal'), JSON_PRETTY_PRINT);
    }
}

elseif (@$_GET['i'] == 'inputsolusi') {
  foreach ($_POST['solusi'] as $value) {
    $data = array(
      'id_relasips' => kodeotomatis('penyakitsolusi','id_relasips',3,'PS'),
      'id_penyakit' => $_POST['id_penyakitsolusi'],
      'id_solusi' => $value
    );
    $add = insert('penyakitsolusi',$data);
  }
    
    if ($add) {
        header("Content-Type: application/json");
      echo json_encode(array('status' => 'sukses'), JSON_PRETTY_PRINT);
    } else {
        header("Content-Type: application/json");
      echo json_encode(array('status' => 'gagal'), JSON_PRETTY_PRINT);
    }
}

elseif (@$_GET['i'] == 'deletegejala' && isset($_GET['id'])) {
    $delete = delete('penyakitgejala','id_relasipg',$_GET['id']);
    if ($delete) {
        header("Content-Type: application/json");
      echo json_encode(array('status' => 'sukses'), JSON_PRETTY_PRINT);
    } else {
        header("Content-Type: application/json");
      echo json_encode(array('status' => 'gagal'), JSON_PRETTY_PRINT);
    }
}

elseif (@$_GET['i'] == 'deletesolusi' && isset($_GET['id'])) {
  $delete = delete('penyakitsolusi','id_relasips',$_GET['id']);
  if ($delete) {
      header("Content-Type: application/json");
    echo json_encode(array('status' => 'sukses'), JSON_PRETTY_PRINT);
  } else {
      header("Content-Type: application/json");
    echo json_encode(array('status' => 'gagal'), JSON_PRETTY_PRINT);
  }
}


?>
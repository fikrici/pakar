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


if (@$_GET['i'] == 'select' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $select = $koneksi->query("SELECT * FROM penyakit WHERE id_penyakit='$id'")->fetch_assoc();
		if (!empty($select['id_penyakit'])) {
			$res = $select;
			$res = array_merge(array('status' => 'sukses'), $res);
		    header("Content-Type: application/json");
		    echo json_encode($res, JSON_PRETTY_PRINT);
		  } else {
		  	header("Content-Type: application/json");
		    echo json_encode(array('status' => 'notfound'), JSON_PRETTY_PRINT);
		  }
}

elseif (@$_GET['i'] == 'input') {
    $data = array(
        'id_penyakit' => kodeotomatis('penyakit','id_penyakit',3,'PK'),
        'nama_penyakit' => $_POST['nama_penyakit'],
        'detail' => $_POST['detail']
    );
    $add = insert('penyakit',$data);
    if ($add) {
        header("Content-Type: application/json");
      echo json_encode(array('status' => 'sukses'), JSON_PRETTY_PRINT);
    } else {
        header("Content-Type: application/json");
      echo json_encode(array('status' => 'gagal'), JSON_PRETTY_PRINT);
    }
}

elseif (@$_GET['i'] == 'update') {
    $data = array(
        'nama_penyakit' => $_POST['nama_penyakit'],
        'detail' => $_POST['detail']
    );
    $update = update('penyakit',$data,'id_penyakit',$_POST['id_penyakit']);
    if ($update) {
        header("Content-Type: application/json");
      echo json_encode(array('status' => 'sukses'), JSON_PRETTY_PRINT);
    } else {
        header("Content-Type: application/json");
      echo json_encode(array('status' => 'gagal'), JSON_PRETTY_PRINT);
    }
}

elseif (@$_GET['i'] == 'delete' && isset($_GET['id'])) {
    $delete = delete('penyakit','id_penyakit',$_GET['id']);
    delete('penyakitgejala','id_penyakit',$_GET['id']);
    delete('penyakitsolusi','id_penyakit',$_GET['id']);
    if ($delete) {
        header("Content-Type: application/json");
      echo json_encode(array('status' => 'sukses'), JSON_PRETTY_PRINT);
    } else {
        header("Content-Type: application/json");
      echo json_encode(array('status' => 'gagal'), JSON_PRETTY_PRINT);
    }
}


?>
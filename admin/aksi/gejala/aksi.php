<?php
include '../../../fungsi/fungsi.php';
$konfig = konfig();
$koneksi = koneksi();
$urladmin = str_replace('admin/aksi/gejala/','',$konfig['url']);
session_start();
if(!isset($_SESSION['username'])) {
    header('location:'.$urladmin.'admin/login.php'); 
}elseif ($_SESSION['level'] != 1) {
    header('location:'.$urladmin.'index.php');
}


if (@$_GET['i'] == 'select' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $select = $koneksi->query("SELECT * FROM gejala WHERE id_gejala='$id'")->fetch_assoc();
		if (!empty($select['id_gejala'])) {
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
        'id_gejala' => kodeotomatis('gejala','id_gejala',3,'GJ'),
        'gejala' => $_POST['gejala']
    );
    $add = insert('gejala',$data);
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
        'gejala' => $_POST['gejala']
    );
    $update = update('gejala',$data,'id_gejala',$_POST['id_gejala']);
    if ($update) {
        header("Content-Type: application/json");
      echo json_encode(array('status' => 'sukses'), JSON_PRETTY_PRINT);
    } else {
        header("Content-Type: application/json");
      echo json_encode(array('status' => 'gagal'), JSON_PRETTY_PRINT);
    }
}

elseif (@$_GET['i'] == 'delete' && isset($_GET['id'])) {
    $delete = delete('gejala','id_gejala',$_GET['id']);
    if ($delete) {
        header("Content-Type: application/json");
      echo json_encode(array('status' => 'sukses'), JSON_PRETTY_PRINT);
    } else {
        header("Content-Type: application/json");
      echo json_encode(array('status' => 'gagal'), JSON_PRETTY_PRINT);
    }
}


?>
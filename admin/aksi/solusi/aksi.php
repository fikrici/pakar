<?php
include '../../../fungsi/fungsi.php';
$konfig = konfig();
$koneksi = koneksi();
$urladmin = str_replace('admin/aksi/solusi/','',$konfig['url']);
session_start();
if(!isset($_SESSION['username'])) {
    header('location:'.$urladmin.'admin/login.php'); 
}elseif ($_SESSION['level'] != 1) {
    header('location:'.$urladmin.'index.php');
}


if (@$_GET['i'] == 'select' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $select = $koneksi->query("SELECT * FROM solusi WHERE id_solusi='$id'")->fetch_assoc();
		if (!empty($select['id_solusi'])) {
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
        'id_solusi' => kodeotomatis('solusi','id_solusi',3,'SL'),
        'solusi' => $_POST['solusi']
    );
    $add = insert('solusi',$data);
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
        'solusi' => $_POST['solusi']
    );
    $update = update('solusi',$data,'id_solusi',$_POST['id_solusi']);
    if ($update) {
        header("Content-Type: application/json");
      echo json_encode(array('status' => 'sukses'), JSON_PRETTY_PRINT);
    } else {
        header("Content-Type: application/json");
      echo json_encode(array('status' => 'gagal'), JSON_PRETTY_PRINT);
    }
}

elseif (@$_GET['i'] == 'delete' && isset($_GET['id'])) {
    $delete = delete('solusi','id_solusi',$_GET['id']);
    if ($delete) {
        header("Content-Type: application/json");
      echo json_encode(array('status' => 'sukses'), JSON_PRETTY_PRINT);
    } else {
        header("Content-Type: application/json");
      echo json_encode(array('status' => 'gagal'), JSON_PRETTY_PRINT);
    }
}


?>
<?php
date_default_timezone_set("Asia/Jakarta");
setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US.8859-1', 'en_US', 'American', 'ENG', 'English');
include "koneksi.php";

	function konfig()
	{
		$konfig['url'] = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
		$konfig['url'] .= "://".$_SERVER['HTTP_HOST'];
		$konfig['url'] .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);

		$konfig['judul'] = 'JUDUL';
		return $konfig;
	}

	function masuk($user,$pass)
	{
		$konek = koneksi();
		$username = mysqli_real_escape_string($konek, $user);
		$password = mysqli_real_escape_string($konek, md5($pass));
		$cekuser = $konek->query("SELECT * FROM users WHERE username = '$username' AND password ='$password'");
		$jumlah = $cekuser->num_rows;
		$hasil = $cekuser->fetch_array(MYSQLI_BOTH);
		if($jumlah == 0) {
			header('location:login.php?login=gagal');
		}elseif ($hasil['password'] != $password) {
			header('location:login.php?login=gagal');
		}elseif ($hasil['level'] == 1) {
			$_SESSION['username'] = $hasil['username'];
			$_SESSION['level'] = $hasil['level'];
			header('location:./index.php');
		}else{
			$_SESSION['username'] = $hasil['username'];
			$_SESSION['level'] = $hasil['level'];
			$_SESSION['id_pasien'] = $hasil['id_pasien'];
			header('location:index.php');
		}
	}

	function register()
	{
		$id = kodeotomatis('pasien','id_pasien',3,'PASIEN');
		$data = array(
			'id_pasien' => $id,
			'nama' => $_POST['nama'],
			'tgl_lahir' => $_POST['tgl_lahir'],
			'jenis_kelamin' => $_POST['jenis_kelamin'],
			'no_telp' => $_POST['no_telp'],
			'alamat' => $_POST['alamat']
		);
		$add = insert('pasien',$data);
		if ($add) {
			$data = array(
				// 'id' => null,
				'username' => $_POST['username'],
				'password' => md5($_POST['password']),
				'level' => 2,
				'id_pasien' => $id
			);
			insert('users',$data);
			header('location:login.php?register=sukses');
		} else {
			header('location:register.php?register=gagal');
		}
	}

	function keluar()
	{
		session_start();
		session_destroy();
		header('location:index.php');
	}

	function kodeotomatis($tabel,$field,$lebar=0,$awalan='') {
		$konek = koneksi();
		 $sqlstr="SELECT $field FROM $tabel order by $field desc limit 1";
		 $hasil = $konek->query($sqlstr);
		 	if(!$hasil) die('gagal auto number query:'.mysqli_error());
		 		$jumlahrecord= $hasil->num_rows;
		 		if($jumlahrecord == 0)
		 			$nomor=1;
		 		else
		 		{
		 	$row= $hasil->fetch_array(MYSQLI_BOTH);
		 	$nomor=intval(substr($row[0],strlen($awalan)))+1;
		 	}
		 	if($lebar>0)
		 		$angka = $awalan.str_pad($nomor,$lebar,"0",STR_PAD_LEFT);
			 	else
			 	$angka = $awalan.$nomor;
			 	return $angka;
		 	}
	
	function waktu($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'Tahun',
        'm' => 'Bulan',
        'w' => 'Minggu',
        'd' => 'Hari',
        'h' => 'Jam',
        'i' => 'Menit',
        's' => 'Detik',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' lalu' : 'Baru Saja';
}





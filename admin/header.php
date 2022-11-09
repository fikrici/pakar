<?php @$uri = basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']);
?>
<!doctype html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?=$title?> - <?=$konfig['judul']?></title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" type="text/css" href="<?=$urladmin?>/assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?=$urladmin?>/assets/css/mdb.min.1.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="<?=$urladmin?>/assets/css/file-upload.css">
    <link rel="stylesheet" type="text/css" href="<?=$urladmin?>/assets/sa/sweetalert.css"> 
    <script type="text/javascript" src="<?=$urladmin?>/assets/js/jquery-3.5.1.js"></script>
    <style>
        body {
            margin: 0;
            padding: 0;
        }
        th{
        	cursor: pointer;
        }
    </style>
    </head>
    <body class="fixed-sn black-skin">
    	<header>
    		<!-- Sidebar navigation -->
		      <div id="slide-out" class="side-nav sn-bg-4 fixed">
		        <ul class="custom-scrollbar">
		          <!-- Side navigation links -->
		          <li>
		            <ul class="collapsible collapsible-accordion">
		              <li class="menu-item menu-item-type-custom menu-item-object-custom waves-effect">
		              	<a class="collapsible-header waves-effect <?=($uri === 'index.php') ? ' active' : ''?>" href="<?=$konfig['url']?>index.php"><i class="fas fa-home"></i>Dashboard</a>
		              	<hr>
		              </li>

					  <li class="menu-item menu-item-type-custom menu-item-object-custom waves-effect">
		              	<a class="collapsible-header waves-effect <?=($uri === 'kepastian.php') ? ' active' : ''?>" href="<?=$konfig['url']?>kepastian.php"><i class="fas fa-list"></i>Data Nilai Kepastian</a>
		              </li>
		              <li class="menu-item menu-item-type-custom menu-item-object-custom waves-effect">
		              	<a class="collapsible-header waves-effect <?=($uri === 'penyakit.php') ? ' active' : ''?>" href="<?=$konfig['url']?>penyakit.php"><i class="fas fa-list"></i>Data Penyakit</a>
		              </li>
                      <li class="menu-item menu-item-type-custom menu-item-object-custom waves-effect">
		              	<a class="collapsible-header waves-effect <?=($uri === 'gejala.php') ? ' active' : ''?>" href="<?=$konfig['url']?>gejala.php"><i class="fas fa-list"></i>Data Gejala</a>
		              </li>
                      <li class="menu-item menu-item-type-custom menu-item-object-custom waves-effect">
		              	<a class="collapsible-header waves-effect <?=($uri === 'solusi.php') ? ' active' : ''?>" href="<?=$konfig['url']?>solusi.php"><i class="fas fa-list"></i>Data Solusi</a>
		              </li>
					  <li class="menu-item menu-item-type-custom menu-item-object-custom waves-effect">
		              	<a class="collapsible-header waves-effect <?=($uri === 'relasi.php') ? ' active' : ''?>" href="<?=$konfig['url']?>relasi.php"><i class="fas fa-database"></i>Data Relasi</a>
		              </li>
                      <li class="menu-item menu-item-type-custom menu-item-object-custom waves-effect">
		              	<a class="collapsible-header waves-effect <?=($uri === 'diagnosa.php') ? ' active' : ''?>" href="<?=$konfig['url']?>diagnosa.php"><i class="fas fa-list"></i>Data Diagnosa</a>
		              </li>
                      <li class="menu-item menu-item-type-custom menu-item-object-custom waves-effect">
		              	<a class="collapsible-header waves-effect <?=($uri === 'pasien.php') ? ' active' : ''?>" href="<?=$konfig['url']?>pasien.php"><i class="fas fa-users"></i>Data Pasien</a>
		              </li>

		            </ul>
		          </li>
		          
		          <!--/. Side navigation links -->
		        </ul>
		        <div class="sidenav-bg mask-strong"></div>
		      </div>
		      <!--/. Sidebar navigation -->

		      <!-- Navbar -->
		      <nav class="navbar fixed-top navbar-toggleable-md navbar-expand-lg scrolling-navbar double-nav">
		        <!-- SideNav slide-out button -->
		        <div class="float-left">
		          <a href="#!" data-activates="slide-out" class="button-collapse white-text"><i class="fas fa-bars"></i></a>
		        </div>
		        <!-- Breadcrumb-->
		        <div class="breadcrumb-dn mr-auto">
		          <p><?=$title?></p>
		        </div>
		        <ul class="nav navbar-nav nav-flex-icons ml-auto">
		          <li class="nav-item">
		            <a class="nav-link waves-effect waves-light" href="<?=$konfig['url']?>login.php?i=keluar">
		              <i class="fas fa-sign-out-alt"></i>
		            </a>
		          </li>
		        </ul>
		      </nav>
		      <!-- /.Navbar -->
    </header>
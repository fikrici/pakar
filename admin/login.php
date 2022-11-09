<?php
include '../fungsi/fungsi.php';
$konfig = konfig();
$konfig['url'] = str_replace('admin/','',$konfig['url']);
session_start();
if(isset($_SESSION['username'])) {
header('location:'.$konfig['url'].'index.php'); 
}
if (@$_GET['i'] == 'keluar') {
    keluar();die;
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="<?=$konfig['url']?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?=$konfig['url']?>assets/css/mdb.min.css">
	<link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css">
<style>

        .intro-2 {
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: 150% 1000px;
        }
        .top-nav-collapse {
            background-color: #3f51b5 !important;
        }
        .navbar:not(.top-nav-collapse) {
            background: transparent !important;
        }
        @media (max-width: 768px) {
            .navbar:not(.top-nav-collapse) {
                background: #3f51b5 !important;
            }
        }

        .card {
            background-color: rgba(229, 228, 255, 0.2);
        }
        .md-form label {
            color: #ffffff;
        }
        h6 {
            line-height: 1.7;
        }
        
        html,
        body,
        header,
        .view {
          height: 100%;
        }

        @media (min-width: 560px) and (max-width: 740px) {
          html,
          body,
          header,
          .view {
            height: 650px;
          }
        }

        @media (min-width: 800px) and (max-width: 850px) {
          html,
          body,
          header,
          .view  {
            height: 650px;
          }
        }

        .card {
            margin-top: 30px;
            /*margin-bottom: -45px;*/

        }

        .md-form input[type=text]:focus:not([readonly]),
        .md-form input[type=password]:focus:not([readonly]) {
            border-bottom: 1px solid #8EDEF8;
            box-shadow: 0 1px 0 0 #8EDEF8;
        }
        .md-form input[type=text]:focus:not([readonly])+label,
        .md-form input[type=password]:focus:not([readonly])+label {
            color: #8EDEF8;
        }

        .md-form .form-control {
            color: #fff;
        }

        .navbar.navbar-dark form .md-form input:focus:not([readonly]) {
            border-color: #8EDEF8;
        }

        @media (min-width: 800px) and (max-width: 850px) {
            .navbar:not(.top-nav-collapse) {
                background: #3f51b5!important;
            }
        }

    </style>
</head>
<body>
    <header>
        <section class="view intro-2">
          <div class="mask rgba-stylish-strong h-100 d-flex justify-content-center align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-6 col-md-10 col-sm-12 mx-auto mt-5">
                        <div class="card wow fadeIn" data-wow-delay="0.3s">
                            <div class="card-body">
                                <div class="form-header success-color">
                                    <h3>Login</h3>
                                </div>
                                <?php
								  if (isset($_GET['login'])) {
								  	echo '<p class="border border-danger p-3 white-text">Login Gagal, Tolong Periksa Username dan Password dengan Benar</p>';
								  }
								  if (isset($_POST['submit'])) {
								  	masuk($_POST['username'],$_POST['password']);
								  }
								  ?>
								<form method="post" class="needs-validation" style="color: #757575;" novalidate>
                                <div class="md-form">
                                    <i class="fa fa-key prefix white-text"></i>
                                    <input type="text" name="username" class="form-control" required autofocus>
                                    <label for="orangeForm-email">Username</label>
                                </div>

                                <div class="md-form">
                                    <i class="fa fa-lock prefix white-text"></i>
                                    <input type="password" name="password" class="form-control" required>
                                    <label for="orangeForm-pass">Password</label>
                                </div>

                                <div class="text-center">
                                    <button class="btn success-color btn-lg white-text" name="submit" type="submit">Login</button>
                                </div>
                            </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
          </div>
        </section>

    </header>

	<script type="text/javascript" src="<?=$konfig['url']?>assets/js/jquery-2.1.0.js"></script>
	<script type="text/javascript" src="<?=$konfig['url']?>assets/js/compiled.min.js"></script>
	<script type="text/javascript">
		// Example starter JavaScript for disabling form submissions if there are invalid fields
		(function() {
		  'use strict';
		  window.addEventListener('load', function() {
		    // Fetch all the forms we want to apply custom Bootstrap validation styles to
		    var forms = document.getElementsByClassName('needs-validation');
		    // Loop over them and prevent submission
		    var validation = Array.prototype.filter.call(forms, function(form) {
		      form.addEventListener('submit', function(event) {
		        if (form.checkValidity() === false) {
		          event.preventDefault();
		          event.stopPropagation();
		        }
		        form.classList.add('was-validated');
		      }, false);
		    });
		  }, false);
		})();
	</script>
</body>
</html>

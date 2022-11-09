<?php
include '../fungsi/fungsi.php';
$konfig = konfig();
$urladmin = str_replace('admin/','',$konfig['url']);
session_start();
if(!isset($_SESSION['username'])) {
    header('location:'.$urladmin.'admin/login.php'); 
}elseif ($_SESSION['level'] != 1) {
    header('location:'.$urladmin.'index.php');
}

$title = 'Dashboard';
include 'header.php';
?>

<!--Main layout-->
<main>

<div class="container-fluid">
  <h3>Selamat Datang di Sistem Pakar Diagnosa Gejala Awal Omicron (COVID-19) </h3>
  <p>Omicron adalah varian terbaru virus corona yang juga menyebabkan penyakit Covid-19.Varian ini menyebar lebih cepat dari varian COVID-19 lainnya, namun dengan gejala lebih ringan atau cenderung tidak bergejala. Varian ini sudah terdeteksi di beberapa negara sejak pertama kali ditemukan di Benua Afrika.Omicron memiliki tingkat penularan yang jauh lebih cepat dibandingkan varian Delta. Sejak ditemukan pertama kali pada 24 November 2021 di Afrika Selatan, kini Omicron telah terdeteksi di lebih dari 110 negara dan diperkirakan akan terus meluas. Di level nasional, pergerakan Omicron juga terus meningkat sejak pertama kali dikonfirmasi pada 16 Desember 2021. perkembangan kasus Covid-19 varian jenis ini (B.1.1.529) di Indonesia telah mencapai 5.106 kasus per Minggu, 13 Februari 2022.</p>
  <p>Beberapa Varian Covid-19 yang sudah masuk ke Indonesia :</p>
  <h4>Alpha</h4>
  <h4>Beta</h4>
  <h4>Delta</h4>
  <h4>Omicron</h4>
</div>

</main>

<script type="text/javascript" src="<?=$urladmin?>/assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?=$urladmin?>/assets/js/mdb.min.js"></script>
<script type="text/javascript" src="<?=$urladmin?>/assets/js/ecommere/popper.min.js"></script>
<script type="text/javascript" src="<?=$urladmin?>/assets/sa/sweetalert.min.js"></script>
<script type="text/javascript" src="<?=$urladmin?>/assets/sa/sweetalert-dev.js"></script>
<script type="text/javascript" src="<?=$urladmin?>/assets/js/jquery.PrintArea.js"></script>
<script type="text/javascript" src="<?=$urladmin?>assets/js/addons/datatables.min.js"></script>


<script type="text/javascript">

  $(document).ready(() => {
          // SideNav Button Initialization
          $(".button-collapse").sideNav();
              // SideNav Scrollbar Initialization
              var sideNavScrollbar = document.querySelector('.custom-scrollbar');
              var ps = new PerfectScrollbar(sideNavScrollbar);

    new WOW().init();
  });

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
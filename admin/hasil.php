<?php
include '../fungsi/fungsi.php';
$konfig = konfig();
$koneksi = koneksi();
$urladmin = str_replace('admin/','',$konfig['url']);
session_start();
if(!isset($_SESSION['username'])) {
    header('location:'.$urladmin.'admin/login.php'); 
}elseif ($_SESSION['level'] != 1) {
    header('location:'.$urladmin.'index.php');
}

if (!isset($_GET['id'])) {
    header('location:'.$urladmin.'admindiagnosa.php');die; 
}

$id = $_GET['id'];
$sql = $koneksi->query("SELECT * FROM diagnosa WHERE id_diagnosa = '$id'");
if ($sql->num_rows == 0) {
    header('location:'.$konfig['url'].'diagnosa.php');die; 
}

$title = 'Hasil Diagnosa #'.$id;
include 'header.php';
?>

<!--Main layout-->
<main>

<div class="container-fluid">
<h2><?=$title?></h2>
        <div class="card">
            <div class="card-body">
            Di bawah ini adalah hasil penyakit berdasarkan gejala yang dipilih :<br>
            <?php
            $sqls = $koneksi->query("SELECT * FROM penyakit");
            $i = 0;
            $data = array();
            while($row3 = $sqls->fetch_assoc()){
                $hasil = $koneksi->query("SELECT penyakitgejala.* FROM diagnosa,penyakitgejala WHERE diagnosa.id_diagnosa = '$id' AND penyakitgejala.id_penyakit='$row3[id_penyakit]' AND penyakitgejala.id_gejala=diagnosa.id_gejala");
              $hitung = ($hasil->num_rows/$sql->num_rows * 100);
              if ($hitung == 0) {
                continue;
              }
              #Simpan Semua data ke array
              $data[$i]['jumlah'] = $hitung;
              $data[$i]['id_penyakit'] = $row3['id_penyakit'];
              $data[$i]['num_rows'] = $hasil->num_rows;
              $i++;
            }

            #Ambil data terbesar
            $data = max($data);
            $sqlpenyakit = $koneksi->query("SELECT * FROM penyakit WHERE id_penyakit='$data[id_penyakit]'")->fetch_assoc();
            $hasil = $koneksi->query("SELECT penyakitgejala.* FROM diagnosa,penyakitgejala WHERE diagnosa.id_diagnosa = '$id' AND penyakitgejala.id_penyakit='$data[id_penyakit]' AND penyakitgejala.id_gejala=diagnosa.id_gejala");
            ?>

            <div class="alert alert-info" role="alert">
                <h3><?=$data['jumlah']?>%</h3>
                (<?=$data['num_rows']?> dari <?=$sql->num_rows?> gejala terpilih)
              </div>
              <h5>Nama Penyakit : <?=$sqlpenyakit['nama_penyakit']?></h5>

              <h5>Gejala</h5>
              <ul>
                <?php
                  while($row = $hasil->fetch_assoc()){
                    $sqlgejala = $koneksi->query("SELECT * FROM gejala WHERE id_gejala='$row[id_gejala]'")->fetch_assoc();
                ?>
                    <li><?=$sqlgejala['gejala']?></li>
                <?php } ?>
            </ul>
              
            <h5>Solusi</h5>
            <ul>
                <?php
                $sqlsolusi = $koneksi->query("SELECT solusi.* FROM solusi,penyakitsolusi WHERE solusi.id_solusi=penyakitsolusi.id_solusi AND penyakitsolusi.id_penyakit='$data[id_penyakit]'");
                    while($row4 = $sqlsolusi->fetch_assoc()){
                ?>
                   <li><?=$row4['solusi']?></li>
                <?php } ?>
            </ul>

        </div>
    </div>
</div>

</main>

<script type="text/javascript" src="<?=$konfig['url']?>/assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?=$konfig['url']?>/assets/js/mdb.min.js"></script>
<script type="text/javascript" src="<?=$konfig['url']?>/assets/js/ecommere/popper.min.js"></script>
<script type="text/javascript" src="<?=$konfig['url']?>/assets/sa/sweetalert.min.js"></script>
<script type="text/javascript" src="<?=$konfig['url']?>/assets/sa/sweetalert-dev.js"></script>
<script type="text/javascript" src="<?=$konfig['url']?>/assets/js/jquery.PrintArea.js"></script>
<script type="text/javascript" src="<?=$konfig['url']?>assets/js/addons/datatables.min.js"></script>

<script>
    // Data Picker Initialization
    $('.datepicker').pickadate();

    // Material Select Initialization
    $(document).ready(function () {
        $('.compiled-select').materialSelect();
    });

    // Tooltips Initialization
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>

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
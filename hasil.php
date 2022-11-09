<?php
include 'fungsi/fungsi.php';
$konfig = konfig();
$koneksi = koneksi();
session_start();
if(!isset($_SESSION['username'])) {
    header('location:'.$konfig['url'].'login.php'); 
}elseif ($_SESSION['level'] == 1) {
    header('location:'.$konfig['url'].'admin/index.php');
}

if (!isset($_GET['id'])) {
    header('location:'.$konfig['url'].'diagnosa.php');die; 
}

$id = $_GET['id'];
$sql = $koneksi->query("SELECT * FROM diagnosa WHERE id_diagnosa = '$id' AND id_pasien='$_SESSION[id_pasien]'");
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
            Di bawah ini adalah beberapa penyakit berdasarkan gejala yang dipilih :<br><br>
            <?php
            $sqls = $koneksi->query("SELECT * FROM penyakit ORDER BY id_penyakit DESC");
            $no = 0;
            $cfarr = array();
            while($row3 = $sqls->fetch_assoc()){
              $hasil = $koneksi->query("SELECT penyakitgejala.* FROM diagnosa,penyakitgejala WHERE diagnosa.id_diagnosa = '$id' AND penyakitgejala.id_penyakit='$row3[id_penyakit]' AND penyakitgejala.id_gejala=diagnosa.id_gejala ORDER BY diagnosa.id_diagnosa DESC");
              $sqlpenyakit = $koneksi->query("SELECT * FROM penyakit WHERE id_penyakit='$row3[id_penyakit]'")->fetch_assoc();
              if ($hasil->num_rows == 0) {
                continue;
              }


                        $arr = array();
                        $hasil = $koneksi->query("SELECT * FROM penyakitgejala WHERE id_penyakit='$row3[id_penyakit]'");
                        while($row = $hasil->fetch_assoc()){
                          $sqlgejala = $koneksi->query("SELECT * FROM gejala WHERE id_gejala='$row[id_gejala]'")->fetch_assoc();
                          $cfe = $koneksi->query("SELECT * FROM diagnosa WHERE id_diagnosa = '$id' AND id_gejala='$sqlgejala[id_gejala]'")->fetch_assoc();
                          $nilaicfe = json_decode($cfe['nilai'], true);
                          if (empty($nilaicfe['nilai'])) {
                            $nilaicfe = 0;
                          }else{
                            $nilaicfe = $nilaicfe['nilai'];
                          }
                          $cfhe = $row['cf']*$nilaicfe;
                          $arr['cfhe'][] = $cfhe;
                        }
                        foreach ($arr['cfhe'] as $key => $value) {
                          if ($key == 0) {
                            $cfold = ($value + $arr['cfhe'][$key+1] * (1-$value));
                          }else{
                            $cfold = $cfold + $arr['cfhe'][$key++] * (1-$cfold);
                          }
                          $cfarr[$no]['cfold'] = $cfold;
                        }

                          $i = 0;
                          $hasil = $koneksi->query("SELECT * FROM penyakitgejala WHERE id_penyakit='$row3[id_penyakit]'");
                          while($row = $hasil->fetch_assoc()){
                            $sqlgejala = $koneksi->query("SELECT * FROM gejala WHERE id_gejala='$row[id_gejala]'")->fetch_assoc();
                            $cfe = $koneksi->query("SELECT * FROM diagnosa WHERE id_diagnosa = '$id' AND id_gejala='$sqlgejala[id_gejala]'")->fetch_assoc();
                            $nilaicfe = json_decode($cfe['nilai'], true);
                            if (empty($nilaicfe['nilai'])) {
                              $nilaicfe = 0;
                            }else{
                              $nilaicfe = $nilaicfe['nilai'];
                            }
                            $cfhe = $row['cf']*$nilaicfe;

                            $cfarr[$no]['data'][$i]['cfhe'] = $cfhe;
                            $cfarr[$no]['data'][$i]['gejala'] = $sqlgejala['gejala'];
                            $cfarr[$no]['data'][$i]['cfh'] = $row['cf'];
                            $cfarr[$no]['data'][$i]['cfe'] = $nilaicfe;
                            $cfarr[$no]['penyakit'] = $sqlpenyakit['nama_penyakit'];
                            $cfarr[$no]['id_penyakit'] = $row3['id_penyakit'];

                            $i++;
                          }
                          $no++;
                        }
                          // print_r($cfarr);die;
                          rsort($cfarr);
                      foreach ($cfarr as $key => $value) {
                      
            ?>

              
              <div class="row">
                <div class="col-md-8">
                <table class="table">
                        <thead>
                          <tr>
                            <th></th>
                            <th>Evidance</th>
                            <th>CF[H] (Pakar)</th>
                            <th>CF[E] (User)</th>
                            <th>CF[H,E] = CF[H]*CF[E]</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
                          $n = 1;
                          foreach ($value['data'] as $value1) {
                        ?>
                            <tr>
                              <td><?=$n?></td>
                              <td><?=$value1['gejala']?></td>
                              <td><?=$value1['cfh']?></td>
                              <td><?=$value1['cfe']?></td>
                              <td><?=$value1['cfhe']?></td>
                            </tr>

                        <?php $n++;} ?>
                        </tbody>
                      </table>
                      <br>
                      <h5>Nama Penyakit : <?=$value['penyakit']?></h5>
                </div>
                <div class="col-md-4">
                  <br>
                  <table class="table">
                      <thead>
                        <tr>
                          <th></th>
                          <th>CF<small>combine</small></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          foreach ($value['data'] as $keys => $values) {
                            if ($keys == 0) {
                              $text = "CF[H,E] <small>".($keys+1).",".($keys+2)."</small>";
                              $cfold = ($values['cfhe'] + $value['data'][$keys+1]['cfhe'] * (1-$values['cfhe']));
                            }else{
                              if ($keys != count($value['data'])-1) {
                                $text = "CF[H,E] <small>"."old".(($keys-1) == 0 ? '':$keys-1).",".($keys+2)."</small>";
                              }else{
                                $text = 'CF<small>persentase</small>';
                              }
                              
                              $cfold = $cfold + $value['data'][$keys++]['cfhe'] * (1-$cfold);
                            }
                        ?>
                        <tr>
                          <td><?=$text?></td>
                          <td>
                          
                            <?php
                            echo $cfold;
                            if ($keys == count($value['data'])) {
                            echo "<br>
                            = $cfold * 100%<br>
                            = <h1>".round($cfold*100)."%</h1>";
                            }
                            ?>
                          </td>
                        </tr>
                        <?php } ?>
                      </tbody>
                  </table>
                </div>
                
              </div>
                      
              
            <h5>Solusi</h5>
            <ul>
                <?php
                $sqlsolusi = $koneksi->query("SELECT solusi.* FROM solusi,penyakitsolusi WHERE solusi.id_solusi=penyakitsolusi.id_solusi AND penyakitsolusi.id_penyakit='$value[id_penyakit]'");
                    while($row4 = $sqlsolusi->fetch_assoc()){
                ?>
                   <li><?=$row4['solusi']?></li>
                <?php } ?>
            </ul>
            <hr>

            <?php } ?>
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
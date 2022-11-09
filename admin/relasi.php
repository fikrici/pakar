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

$title = 'Data Relasi';
include 'header.php';
?>

<!--Main layout-->
    <main>

      <div class="container-fluid">
      	<h2><i class="fas fa-database"></i> <?=$title?></h2>
        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#tambahgejala"><i class="fa fa-plus"></i> Tambah Data Relasi Gejala</button>
        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#tambahsolusi"><i class="fa fa-plus"></i> Tambah Data Relasi Solusi</button>

        <div class="modal fade left" id="tambahgejala" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">


                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title w-100" id="myModalLabel">Tambah Data Relasi Gejala</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                       <form id="forminputgejala">
                            <div class="md-form mb-5">
                                <select name="id_penyakitgejala" id="id_penyakitgejala" class="compiled-select md-form" searchable="Search here.." required>
                                    <option value="" disabled selected>Pilih Penyakit</option>
                                      <?php
                                      $sql = $koneksi->query("SELECT * FROM penyakit ORDER BY id_penyakit DESC");
                                      while ($row = $sql->fetch_assoc()) { ?>
                                      <option value="<?=$row['id_penyakit']?>"><?=$row['nama_penyakit']?></option>
                                      <?php } ?>
                                </select>
                              </div>
                              <h5>Gejala</h5>
                              <div class="md-form mb-5">
                                <?php
                                  $sql = $koneksi->query("SELECT * FROM gejala ORDER BY id_gejala DESC");
                                  while ($row = $sql->fetch_assoc()) { ?>
                                  <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-check">
                                          <input class="form-check-input" type="checkbox" name="gejala[]" value="<?=$row['id_gejala']?>" id="<?=$row['id_gejala']?>" />
                                          <label class="form-check-label" for="<?=$row['id_gejala']?>" onclick='cf("CF<?=$row['id_gejala']?>");'><?=$row['gejala']?></label>
                                      </div>
                                    </div>
                                    <div class="col-md-6 inputan" id="CF<?=$row['id_gejala']?>" style="display:none;">
                                      <div class="md-form mb-5">
                                      <select name="cf[]" class="compiled-select">
                                        <option value="" disabled selected>Pilih</option>
                                          <?php
                                          $sql2 = $koneksi->query("SELECT * FROM kepastian");
                                          $jumlahdata = $sql2->num_rows;
                                          $awal = 1;
                                          while ($row2 = $sql2->fetch_assoc()) { ?>
                                          <option value='<?=str_replace(',','.',round($awal, 2))?>'><?=$row2['kepastian']?></option>
                                          <?php $awal -= 1/($jumlahdata-1);} ?>
                                    </select>
                                      </div>
                                    </div>
                                    </div>
                              <?php } ?>
                            </div>
                              <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit">Tambah</button>
                        </form>
                    </div>
                  </div>
                </div>
              </div>

              <div class="modal fade left" id="tambahsolusi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">


                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title w-100" id="myModalLabel">Tambah Data Relasi Solusi</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                       <form id="forminputsolusi">
                            <div class="md-form mb-5">
                                <select name="id_penyakitsolusi" id="id_penyakitsolusi" class="compiled-select md-form" searchable="Search here.." required>
                                    <option value="" disabled selected>Pilih Penyakit</option>
                                      <?php
                                      $sql = $koneksi->query("SELECT * FROM penyakit ORDER BY id_penyakit DESC");
                                      while ($row = $sql->fetch_assoc()) { ?>
                                      <option value="<?=$row['id_penyakit']?>"><?=$row['nama_penyakit']?></option>
                                      <?php } ?>
                                </select>
                              </div>
                              <h5>Solusi</h5>
                              <div class="md-form mb-5">
                              <?php
                                $sql = $koneksi->query("SELECT * FROM solusi ORDER BY id_solusi DESC");
                                while ($row = $sql->fetch_assoc()) { ?>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="solusi[]" value="<?=$row['id_solusi']?>" id="<?=$row['id_solusi']?>" />
                                    <label class="form-check-label" for="<?=$row['id_solusi']?>"><?=$row['solusi']?></label>
                                </div>
                            <?php } ?>
                            </div>
                              <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit">Tambah</button>
                        </form>
                    </div>
                  </div>
                </div>
              </div>

           <div class="card">
            <div class="card-body">
              <div id="tabel"></div>
            </div>
          </div>
      </div>

  </main>

  	<script type="text/javascript" src="<?=$urladmin?>/assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?=$urladmin?>/assets/js/mdb.min.js"></script>
    <script type="text/javascript" src="<?=$urladmin?>/assets/js/ecommere/popper.min.js"></script>
    <script type="text/javascript" src="<?=$urladmin?>/assets/sa/sweetalert.min.js"></script>
    <script type="text/javascript" src="<?=$urladmin?>/assets/sa/sweetalert-dev.js"></script>

    <script>
      $('#tabel').load('aksi/relasi/tabel.php');


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

        function cf(id){
          var x = document.getElementById(id);
          if (x.style.display === "none") {
            x.style.display = "block";
          } else {
            x.style.display = "none";
          }
        }
        

    </script>

    <script>
  $(document).ready(function(){

    $('#forminputgejala').on('submit', function (e) {

                    e.preventDefault();

                  var datas= $("#forminputgejala").serialize();

                  $.ajax({
                     type: "POST",
                     url: "aksi/relasi/aksi.php?i=inputgejala",
                     dataType: "json",
                     data: datas
                  }).done(function( data ) {
                    if (data.status == 'sukses') {
                    toastr.success('Berhasil di Tambahkan');
                    $('#tabel').load('aksi/relasi/tabel.php');
                  } else {
                  toastr.error('Gagal di Tambahkan');
                  }
                    document.getElementById("forminputgejala").reset();
                    $('#tambahgejala').modal('hide');
                    var divsToHide = document.getElementsByClassName("inputan"); //divsToHide is an array
                    for(var i = 0; i < divsToHide.length; i++){
                        divsToHide[i].style.display = "none"; // depending on what you're doing
                    }
                 });
                });

                $('#forminputsolusi').on('submit', function (e) {

                e.preventDefault();

                var datas= $("#forminputsolusi").serialize();

                $.ajax({
                type: "POST",
                url: "aksi/relasi/aksi.php?i=inputsolusi",
                dataType: "json",
                data: datas
                }).done(function( data ) {
                if (data.status == 'sukses') {
                toastr.success('Berhasil di Tambahkan');
                $('#tabel').load('aksi/relasi/tabel.php');
                } else {
                toastr.error('Gagal di Tambahkan');
                }
                document.getElementById("forminputsolusi").reset();
                $('#tambahsolusi').modal('hide') 
                });
                });

  });

  function deletegejala(str){
        var id = str;
        swal({
    title: "Peringatan!!",
    text: "Apakah Anda Yakin Ingin Menghapusnya??",
    type: "warning",
    showCancelButton: true,
    closeOnConfirm: false,
    showLoaderOnConfirm: true,
  },function(){
            
        $.ajax({
           type: "POST",
           dataType: "json",
           url: "aksi/relasi/aksi.php?i=deletegejala&id="+id
        }).done(function( data ) {
          if (data.status == 'sukses') {
          swal({
          type: 'success',
          title: 'Berhasil di Hapus',
          timer: 1500
        });
          $('#tabel').load('aksi/relasi/tabel.php');
        } else {
        swal({
          type: 'error',
          title: 'Gagal di Hapus',
          timer: 1500
        });
        }
        setTimeout(() => {
          $('.modal-backdrop').hide();
        }, 1600);
      });
        
      });
    } 

    function deletesolusi(str){
        var id = str;
        swal({
    title: "Peringatan!!",
    text: "Apakah Anda Yakin Ingin Menghapusnya??",
    type: "warning",
    showCancelButton: true,
    closeOnConfirm: false,
    showLoaderOnConfirm: true,
  },function(){
            
        $.ajax({
           type: "POST",
           dataType: "json",
           url: "aksi/relasi/aksi.php?i=deletesolusi&id="+id
        }).done(function( data ) {
          if (data.status == 'sukses') {
          swal({
          type: 'success',
          title: 'Berhasil di Hapus',
          timer: 1500
        });
          $('#tabel').load('aksi/relasi/tabel.php');
        } else {
        swal({
          type: 'error',
          title: 'Gagal di Hapus',
          timer: 1500
        });
        }
          
      });
        
      });
    } 
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
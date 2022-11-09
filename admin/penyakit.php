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

$title = 'Data Penyakit';
include 'header.php';
?>

<!--Main layout-->
    <main>

      <div class="container-fluid">
      	<h2><i class="fas fa-list"></i> <?=$title?></h2>
        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#tambah"><i class="fa fa-plus"></i> Tambah Data</button>

        <div class="modal fade left" id="tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">


                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title w-100" id="myModalLabel">Tambah Data</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                       <form id="forminput">
                              <div class="md-form mb-5">
                                  <input type="text" id="nama_penyakit" name="nama_penyakit" class="form-control" required autofocus>
                                  <label>Nama Penyakit</label>
                                  <div class="invalid-feedback">
                                    Tolong Diisi.
                                  </div>
                              </div>
                              <div class="md-form mb-5">
                                  <textarea class="md-textarea form-control" name="detail" id="detail" required></textarea>
                                  <label>Detail Penyakit</label>
                                  <div class="invalid-feedback">
                                    Tolong Diisi.
                                  </div>
                              </div>
                              <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit">Tambah</button>
                        </form>
                    </div>
                  </div>
                </div>
              </div>

              <div class="modal fade left" id="update" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">


                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title w-100" id="myModalLabel">Update Data</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form id="formupdate">
                              <input type="hidden" id="editid_penyakit" name="id_penyakit">
                              <div class="md-form mb-5">
                                  <input type="text" id="editnama_penyakit" name="nama_penyakit" class="form-control" required autofocus>
                                  <label>Nama Penyakit</label>
                                  <div class="invalid-feedback">
                                    Tolong Diisi.
                                  </div>
                              </div>
                              <div class="md-form mb-5">
                                  <textarea class="md-textarea form-control" name="detail" id="editdetail" required></textarea>
                                  <label>Detail Penyakit</label>
                                  <div class="invalid-feedback">
                                    Tolong Diisi.
                                  </div>
                              </div>
                              <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit">Edit</button>
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
      $('#tabel').load('aksi/penyakit/tabel.php');

      function editdata(value) {
      $.get('aksi/penyakit/aksi.php?i=select&id='+value, function(data, status){
        if (data.status == 'sukses') {
            $('#editid_penyakit').val(value);
            $('#editnama_penyakit').val(data.nama_penyakit);
            $('#editdetail').val(data.detail);
          }
        });
      
    }

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

    <script>
  $(document).ready(function(){

    $('#forminput').on('submit', function (e) {

                    e.preventDefault();

                  var datas= $("#forminput").serialize();

                  $.ajax({
                     type: "POST",
                     url: "aksi/penyakit/aksi.php?i=input",
                     dataType: "json",
                     data: datas
                  }).done(function( data ) {
                    if (data.status == 'sukses') {
                    toastr.success('Berhasil di Tambahkan');
                    $('#tabel').load('aksi/penyakit/tabel.php');
                  } else {
                  toastr.error('Gagal di Tambahkan');
                  }
                    document.getElementById("forminput").reset();
                 });
                });

    $('#formupdate').on('submit', function (e) {

                    e.preventDefault();

                  var datas= $("#formupdate").serialize();

                  $.ajax({
                     type: "POST",
                     url: "aksi/penyakit/aksi.php?i=update",
                     dataType: "json",
                     data: datas
                  }).done(function( data ) {
                    if (data.status == 'sukses') {
                    toastr.success('Berhasil di Update');
                    $('#tabel').load('aksi/penyakit/tabel.php');
                  } else {
                  toastr.error('Gagal di Update');
                  }
                   $('#update').modal('hide') 
                 });
                });

  });

  function deletedata(str){
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
           url: "aksi/penyakit/aksi.php?i=delete&id="+id
        }).done(function( data ) {
          if (data.status == 'sukses') {
          swal({
          type: 'success',
          title: 'Berhasil di Hapus',
          timer: 1500
        });
          $('#tabel').load('aksi/penyakit/tabel.php');
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
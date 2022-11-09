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

$title = 'Data Diagnosa';
include 'header.php';
?>

<!--Main layout-->
    <main>

      <div class="container-fluid">
      	<h2><i class="fas fa-list"></i> <?=$title?></h2>

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
      $('#tabel').load('aksi/diagnosa/tabel.php');

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
           url: "aksi/diagnosa/aksi.php?i=delete&id="+id
        }).done(function( data ) {
          if (data.status == 'sukses') {
          swal({
          type: 'success',
          title: 'Berhasil di Hapus',
          timer: 1500
        });
          $('#tabel').load('aksi/diagnosa/tabel.php');
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
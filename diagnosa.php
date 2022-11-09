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

$title = 'Diagnosa';
include 'header.php';
?>

<!--Main layout-->
<main>

<div class="container-fluid">
<h2><?=$title?></h2>
        <div class="card">
            <div class="card-body">
              <form id="formdiagnosa">
              <table  class="table table-striped table-bordered" style="width:100%">
					        <thead>
					            <tr>
					                <th>ID Gejala</th>
					                <th>Gejala</th>
					                <th>Aksi</th>
					            </tr>
					        </thead>
					        <tbody>
					        	<?php
					        		
					        		$sql = $koneksi->query("SELECT * FROM gejala");
									    while ($row = $sql->fetch_assoc()) 
									    { 
									    ?>
									        <tr>
									        	<td><?=$row['id_gejala']?></td>
									        	<td><?=$row['gejala']?></td>
									        	<td>
                            <input type="checkbox" name="gejala[]" value="<?=$row['id_gejala']?>" id="<?=$row['id_gejala']?>" />
                                <select name="nilai[]" class="compiled-select" onchange='cek("<?=$row['id_gejala']?>")'>
                                    <option value="" disabled selected>Pilih</option>
                                      <?php
                                      $sql2 = $koneksi->query("SELECT * FROM kepastian");
                                      $jumlahdata = $sql2->num_rows;
									                    $awal = 1;
                                      while ($row2 = $sql2->fetch_assoc()) { ?>
                                      <option value='{"kepastian":"<?=$row2['kepastian']?>","nilai":"<?=str_replace(',','.',round($awal, 2))?>"}'><?=$row2['kepastian']?></option>
                                      <?php $awal -= 1/($jumlahdata-1);} ?>
                                </select>
                            </td>
									        </tr>
									   <?php }?>
					        </tbody>
					    </table>

                    <div class="md-form mb-5 text-center">
		      			<button class="btn btn-lg btn-success">Cek Hasil</button>
		      		</div>
              </form>
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
<!--
<script type="text/javascript">
							$(document).ready(function() {
								setTimeout(function() {
								// Material Design example
								$('#example').DataTable();
								$('#example_wrapper').find('label').each(function () {
								$(this).parent().append($(this).children());
								});
								$('#example_wrapper .dataTables_filter').find('input').each(function () {
								$(this).attr("placeholder", "Search");
								$(this).removeClass('form-control-sm');
								});
								$('#example_wrapper .dataTables_length').addClass('d-flex flex-row');
								$('#example_wrapper .dataTables_filter').addClass('md-form');
								$('#example_wrapper select').removeClass(
								'custom-select custom-select-sm form-control form-control-sm');
								$('#example_wrapper select').addClass('mdb-select');
								$('#example_wrapper .mdb-select').materialSelect();
								$('#example_wrapper .dataTables_filter').find('label').remove();
							}, 100);
							} );
						</script>
            -->




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

    function cek(id){
      $('#'+id).prop('checked', true);
    }

    $(document).ready(function(){
    

        $('#formdiagnosa').on('submit', function (e) {

                e.preventDefault();

              var datas= $("#formdiagnosa").serialize();

              $.ajax({
                 type: "POST",
                 url: "aksi.php?i=inputdiagnosa",
                 dataType: "json",
                 data: datas
              }).done(function( data ) {
                if (data.status == 'sukses') {
                    swal({
                        type: 'success',
                        title: 'Berhasil di Input',
                        timer: 1500
                    });
                    setTimeout(function() {
                        location = data.url;
                    }, 1700);
              } else {
                toastr.error('Gagal di Tambahkan');
              }
                
             });
            });
        });
</script>







<!--
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
-->
</body>
</html>
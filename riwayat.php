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

$title = 'Data Riwayat Diagnosa';
include 'header.php';
?>

<!--Main layout-->
    <main>

      <div class="container-fluid">
      	<h2><i class="fas fa-list"></i> <?=$title?></h2>
           <div class="card">
            <div class="card-body">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
					        <thead>
					            <tr>
					                <th>No</th>
					                <th>ID Diagnosa</th>
					                <th>Aksi</th>
					            </tr>
					        </thead>
					        <tbody>
					        	<?php
					        		
					        		$no = 1;
					        		$sql = $koneksi->query("SELECT DISTINCT id_diagnosa FROM diagnosa WHERE id_pasien='$_SESSION[id_pasien]' ORDER BY id_diagnosa DESC");
									    while ($row = $sql->fetch_assoc()) 
									    { 
									    ?>
									        <tr>
									        	<td><?=$no?></td>
									        	<td><?=$row['id_diagnosa']?></td>
									        	<td> <a href="<?=$konfig['url']?>hasil.php?id=<?=$row['id_diagnosa']?>" class="badge badge-info">Lihat Detail</a> </td>
									        </tr>
									   <?php $no++;}?>
					        </tbody>
					    </table>
            </div>
          </div>
      </div>

  </main>

  	<script type="text/javascript" src="<?=$konfig['url']?>/assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?=$konfig['url']?>/assets/js/mdb.min.js"></script>
    <script type="text/javascript" src="<?=$konfig['url']?>/assets/js/ecommere/popper.min.js"></script>
    <script type="text/javascript" src="<?=$konfig['url']?>/assets/sa/sweetalert.min.js"></script>
    <script type="text/javascript" src="<?=$konfig['url']?>/assets/sa/sweetalert-dev.js"></script>
    <script type="text/javascript" src="<?=$konfig['url']?>assets/js/addons/datatables.min.js"></script>
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
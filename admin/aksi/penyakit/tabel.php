<?php
include '../../../fungsi/fungsi.php';
$konfig = konfig();
$koneksi = koneksi();
$urladmin = str_replace('admin/aksi/penyakit/','',$konfig['url']);
session_start();
if(!isset($_SESSION['username'])) {
    header('location:'.$urladmin.'admin/login.php'); 
}elseif ($_SESSION['level'] != 1) {
    header('location:'.$urladmin.'index.php');
}
?>
				<table id="example" class="table table-striped table-bordered" style="width:100%">
					        <thead>
					            <tr>
					                <th>No</th>
					                <th>ID Penyakit</th>
					                <th>Nama Penyakit</th>
									<th>Detail</th>
					                <th>Aksi</th>
					            </tr>
					        </thead>
					        <tbody>
					        	<?php
					        		
					        		$no = 1;
					        		$sql = $koneksi->query("SELECT * FROM penyakit ORDER BY id_penyakit DESC");
									    while ($row = $sql->fetch_assoc()) 
									    { 
									    ?>
									        <tr>
									        	<td><?=$no?></td>
									        	<td><?=$row['id_penyakit']?></td>
									        	<td><?=$row['nama_penyakit']?></td>
												<td><?=$row['detail']?></td>
									        	<td><span class="badge badge-danger" onclick='deletedata("<?=$row['id_penyakit']?>")' style="cursor: pointer;">Hapus</span> <span class="badge badge-info" data-toggle="modal" data-target="#update" onclick='editdata("<?=$row['id_penyakit']?>")' style="cursor: pointer;"> Update</span></td>
									        </tr>
									   <?php $no++;}?>
					        </tbody>
					    </table>
					    <script type="text/javascript" src="<?=$urladmin?>assets/js/addons/datatables.min.js"></script>
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
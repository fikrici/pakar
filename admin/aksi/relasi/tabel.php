<?php
include '../../../fungsi/fungsi.php';
$konfig = konfig();
$koneksi = koneksi();
$urladmin = str_replace('admin/aksi/relasi/','',$konfig['url']);
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
									<th>ID<br>Penyakit</th>
					                <th>Nama Penyakit</th>
									<th>Rule</th>
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
												<td>
													<table>
													 <thead>
														<tr>
															<th><b>ID<br>Gejala</b></th>
															<th><b>Gejala</b></th>
															<th><b>CF Pakar</b></th>
															<th></th>
														</tr>
													</thead>
													<tbody>
												<?php
													$sql2 = $koneksi->query("SELECT * FROM penyakitgejala WHERE id_penyakit = '$row[id_penyakit]' ORDER BY id_gejala");
													while ($row2 = $sql2->fetch_assoc()) 
													{ 
														$gejala = $koneksi->query("SELECT * FROM gejala WHERE id_gejala = '$row2[id_gejala]'")->fetch_assoc();
									   			?>	
														<tr>
															<td><?=$gejala['id_gejala']?></td>
															<td><?=$gejala['gejala']?></td>
															<td><?=str_replace(',','.',round($row2['cf'], 2))?></td>
															<td><span class="badge badge-danger" onclick='deletegejala("<?=$row2['id_relasipg']?>")' style="cursor: pointer;">Hapus</span> </td>
														</tr>
												<?php } ?>
												</tbody>
												</table>
												</td>
												<td>
													<span class="badge badge-info" data-toggle="modal" data-target="#solusi<?=$row['id_penyakit']?>" style="cursor: pointer;"> Data Solusi</span>

													<div class="modal fade left" id="solusi<?=$row['id_penyakit']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
													<div class="modal-dialog modal-lg" role="document">


															<div class="modal-content">
																<div class="modal-header">
																<h4 class="modal-title w-100" id="myModalLabel">Data Solusi</h4>
																<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																	<span aria-hidden="true">&times;</span>
																</button>
																</div>
																<div class="modal-body">
																<table>
																	<?php
																		$sql3 = $koneksi->query("SELECT * FROM penyakitsolusi WHERE id_penyakit = '$row[id_penyakit]' ORDER BY id_penyakit DESC");
																		while ($row3 = $sql3->fetch_assoc()) 
																		{ 
																			$solusi = $koneksi->query("SELECT * FROM solusi WHERE id_solusi = '$row3[id_solusi]' ORDER BY id_solusi DESC")->fetch_assoc();
																	?>	
																		<tr>
																	<td><?=$solusi['solusi']?></td>
																	<td><span class="badge badge-danger" onclick='deletesolusi("<?=$row3['id_relasips']?>")' style="cursor: pointer;">Hapus</span> </td>
																</tr>
																	<?php } ?>
																	</table>
																</div>
															</div>
															</div>
														</div>
												</td>
									        </tr>
									   <?php $no++;}?>
					        </tbody>
					    </table>
					    <script type="text/javascript" src="<?=$urladmin?>assets/js/addons/datatables.min.js"></script>
					    <script type="text/javascript">
							$(document).ready(function() {
								setTimeout(function() {
									$('.modal-backdrop').hide();
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
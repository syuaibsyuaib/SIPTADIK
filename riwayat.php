<?php
$title = "Riwayat";
include("layout/header.php");
segarkan($_SESSION['user'], $_SESSION['pass']);
$_SESSION['role'] != 1 ? pindahko("/") : "";
$data = $_SESSION['data']['dataTamu'];
// print_r($_SESSION['data']['dataBidang']);
?>

<!-- ISI MULAI -->
<div class="container">
	<h2 class="my-4">Riwayat Tamu</h2>

	<div class="container mt-3 mb-4">
		<div class="col mt-4 mt-lg-0">
			<div class="row">
				<div class="col-md-12">
					<div class="user-dashboard-info-box table-responsive mb-0 bg-white p-4 shadow-sm">

						<!-- MAIN TABLE -->
						<table class="table manage-candidates-top mb-0" id="table_id">
							<thead>
								<tr>
									<th width="10%">Tanggal</th>
									<th width="35%">Nama Tamu</th>
									<th width="20%">Instansi</th>
									<th width="20%">Bidang Tujuan</th>
									<th width="10%">Tujuan</th>
								</tr>
							</thead>
							<tbody>

								<?php
								if (count($data) > 1) {
									foreach ($data as $value) {
										if ($value[0] <> "") {
											$id_raw = $value[0];
											$id_enc = encrypt_decrypt("e", $id_raw);
											$timestamp = $value[8];
											$e = explode("_", $timestamp);
											$timestamp = empty($e[4]) == 0 ? date("d/m/Y H:i", strtotime($e[0] . "-" . $e[1] . "-" . $e[2] . " " . $e[3] . ":" . $e[4])) : $value[8];
											$nama = $value[1];
											$no_id = $value[2];
											$instansi_asal = $value[3];
											$bidang_tujuan = $value[4];
											$bidang_tujuan = array_search_multi($_SESSION['data']['dataBidang'], 0, $bidang_tujuan, false)[0][1];
											// print_r($bidang_tujuan);
											$subbidang_tujuan = $value[5];
											$jabatan_tujuan = $value[6];
											$tujuan = $value[7];
											$user_piket = $value[9];
											$foto = $value[10];
								?>
											<!-- DATA TAMU -->
											<tr class="candidates-list">
												<td><?= $timestamp ?></td>
												<td class="title">
													<div class="thumb">
														<img class="img-fluid tunggu" src="<?= $foto != "" ? $foto : "img/p.webp" ?>" alt="" data-bs-toggle="modal" data-bs-target="#foto_<?= $id_raw ?>" title="Perbesar gambar">
													</div>
													<div class="candidate-list-details">
														<div class="candidate-list-info">
															<div class="candidate-list-title">
																<h5 class="mb-0"><a href="#" data-bs-toggle="modal" data-bs-target="#data_<?= $id_raw ?>"><?= $nama ?></a>
																</h5>
															</div>
															<div class="candidate-list-option">
																<ul class="list-unstyled">
																	<li><i class="bi bi-person-badge me-1"></i><?= $no_id ?>
																	</li>
																</ul>
															</div>
														</div>
													</div>
												</td>
												<td><?= $instansi_asal ?></td>
												<td><?= $bidang_tujuan ?></td>
												<td><?= $tujuan ?></td>
											</tr>

											<!-- MODAL FOTO TAMU -->
											<div class="modal fade" id="foto_<?= $id_raw ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<h5 class="modal-title" id="exampleModalLabel">Foto: <?= $nama ?></h5>
															<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
														</div>
														<div class="modal-body">
															<!-- ISI MODAL START HERE -->
															<img class="modal-foto" src="<?= $foto != "" ? $foto : "img/p.webp" ?>" alt="">
															<!-- ISI MODAL END HERE -->
														</div>
													</div>
												</div>
											</div>

											<!-- MODAL DATA TAMU -->
											<div class="modal fade" id="data_<?= $id_raw ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
												<div class="modal-dialog modal-lg">
													<div class="modal-content">
														<div class="modal-header">
															<h5 class="modal-title" id="exampleModalLabel">Detail: <?= $nama ?></h5>
														</div>
														<div class="modal-body">
															<!-- ISI MODAL START HERE -->
															<div class="mb-3 row">
																<label class="col-sm-4 col-form-label">Nama</label>
																<div class="col-sm-8">
																	<input type="text" readonly class="form-control-plaintext" value="<?= $nama ?>">
																</div>
															</div>
															<div class="mb-3 row">
																<label class="col-sm-4 col-form-label">NIK/NIP</label>
																<div class="col-sm-8">
																	<input type="text" readonly class="form-control-plaintext" value="<?= $no_id ?>">
																</div>
															</div>
															<div class="mb-3 row">
																<label class="col-sm-4 col-form-label">Instansi</label>
																<div class="col-sm-8">
																	<input type="text" readonly class="form-control-plaintext" value="<?= $instansi_asal ?>">
																</div>
															</div>
															<div class="mb-3 row">
																<label class="col-sm-4 col-form-label">Sub Bidang Tujuan</label>
																<div class="col-sm-8">
																	<input type="text" readonly class="form-control-plaintext" value="<?= $subbidang_tujuan ?>">
																</div>
															</div>
															<div class="mb-3 row">
																<label class="col-sm-4 col-form-label">Tujuan</label>
																<div class="col-sm-8">
																	<input type="text" readonly class="form-control-plaintext" value="<?= $tujuan ?>">
																</div>
															</div>
															<!-- <div class="mb-3 row">
														<label class="col-sm-4 col-form-label">Status</label>
														<div class="col-sm-8">
															<input type="text" readonly class="form-control-plaintext" value="Diterima">
														</div>
													</div> -->
															<!-- ISI MODAL END HERE -->
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
														</div>
													</div>
												</div>
											</div>
								<?php
										}
									}
								}
								?>

							</tbody>
						</table>

					</div>
				</div>
			</div>
		</div>
	</div>

</div>
<!-- ISI SELESAI -->

<script>
	$(document).ready(function() {
		$('#table_id').DataTable({
			order: [[0, "desc"]],
			buttons: [{
				extend: 'csv',
				text: 'Uncuh CSV',
				exportOptions: {
					modifier: {
						search: 'none'
					}
				}
			}],
			"language": {
				"zeroRecords": "Tidak ada data!",
				"lengthMenu": "Lihat _MENU_ data",
				"search": "Cari:",
				"info": "Menampilkan _PAGE_ dari _PAGES_",
				"paginate": {
					"next": "Maju",
					"previous": "Mundur",
					"first": "Awal",
					"last": "Akhir"
				}
			},
			dom: 'Blfrtip'
		});
	});
</script>

<?php
include("layout/footer.php");
?>
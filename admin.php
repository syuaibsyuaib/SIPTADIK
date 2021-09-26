<?php
$title = "Admin";
include("layout/header.php");
$_SESSION['role'] != 1 ? pindahko("/") : "";
$data = $_SESSION['data']['dataPjb'];
$dataBidang = $_SESSION['data']['dataBidang'];

// UNTUK PAGINATION START
$page = $_GET['p'] ?? 1;
$limit = 8;
$offset = ($page - 1) * $limit;
$total_data = count($data);
$total_pages = ceil($total_data / $limit);
$total_number = 2;
$start_number = ($page > $total_number) ? ($page - $total_number) : 1;
$end_number = ($page < ($total_pages - $total_number)) ? ($page + $total_number) : $total_pages;
// JIKA OVERFLOW, KE LAST PAGE
if ($page > $total_pages) {
	$_GET['p'] = $total_pages;
	pindahko("?" . http_build_query($_GET));
}
$data = array_slice($data, $offset, $limit);
// UNTUK PAGINATION END

// print_r($dataBidang);
?>

<!-- MODAL SLIDER -->
<div class="modal fade" id="slider_edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<form class="m-0 p-0" method="POST" enctype="multipart/form-data">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Pengaturan Gambar Slider</h5>
				</div>
				<!-- ISI MODAL START HERE -->
				<div class="modal-body">
					<div class="px-3 text-center">

						<!-- THUMBNAIL VIEWER -->
						<div class="mb-1 row d-block text-center coba">
							<div class="col-sm-2 d-inline-block rounded p-0">
								<img class="align-top" src="img/slide1.jpg" alt="">
							</div>
							<div class="col-sm-2 d-inline-block rounded p-0">
								<img class="align-top" src="img/slide2.jpg" alt="">
							</div>
							<div class="col-sm-2 d-inline-block rounded p-0">
								<img class="align-top" src="img/slide3.jpg" alt="">
							</div>
							<div class="col-sm-2 d-inline-block rounded p-0">
								<img class="align-top" src="img/slide4.jpg" alt="">
							</div>
							<div class="col-sm-2 d-inline-block rounded p-0">
								<img class="align-top" src="img/slide5.jpg" alt="">
							</div>
						</div>
						<div class="row d-block text-center">
							<div class="col-sm-2 d-inline-block">
								<input class="form-control d-none" type="file" name="slider_1" id="slider_1" accept="image/*">
								<label for="slider_1" class="btn btn-sm btn-primary">Ganti</label>
							</div>
							<div class="col-sm-2 d-inline-block">
								<input class="form-control d-none" type="file" name="slider_2" id="slider_2" accept="image/*">
								<label for="slider_2" class="btn btn-sm btn-primary">Ganti</label>
							</div>
							<div class="col-sm-2 d-inline-block">
								<input class="form-control d-none" type="file" name="slider_3" id="slider_3" accept="image/*">
								<label for="slider_3" class="btn btn-sm btn-primary">Ganti</label>
							</div>
							<div class="col-sm-2 d-inline-block">
								<input class="form-control d-none" type="file" name="slider_4" id="slider_4" accept="image/*">
								<label for="slider_4" class="btn btn-sm btn-primary">Ganti</label>
							</div>
							<div class="col-sm-2 d-inline-block">
								<input class="form-control d-none" type="file" name="slider_5" id="slider_5" accept="image/*">
								<label for="slider_5" class="btn btn-sm btn-primary">Ganti</label>
							</div>
						</div>
						<i class="text-muted mt-3 d-block">Recommended image ratio: 1625 x 900 pixel (65:36)</i>

					</div>
				</div>
				<!-- ISI MODAL END HERE -->
				<div class="modal-footer">
					<button type="button" class="btn btn-primary">Simpan</button>
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- MODAL TAMBAH PEJABAT -->
<div class="modal fade" id="modal_tambah_pengguna" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<form class="m-0 p-0" id="formTambahUser">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Tambah Pejabat</h5>
				</div>
				<div class="modal-body">
					<!-- ISI MODAL START HERE -->
					<div class="mb-3 row">
						<label class="col-sm-3 col-form-label"><i>Username</i></label>
						<div class="col-sm-9">
							<input name="pengguna_pjb" type="text" class="form-control" required>
						</div>
					</div>
					<div class="mb-3 row">
						<label class="col-sm-3 col-form-label"><i>Password</i></label>
						<div class="col-sm-9">
							<input name="pass_pjb_1" type="password" class="form-control pass" required>
							<div class="mt-1">
								<small class="text-danger"><i>Disarankan paduan huruf, angka dan/atau simbol</i></small>
							</div>
						</div>
					</div>
					<div class="mb-3 row">
						<label class="col-sm-3 col-form-label">Foto</label>
						<div class="col-sm-9">
							<input name="foto_pjb" type="file" class="form-control" accept=".png,.jpg,.jpeg" required>
							<div class="mt-1">
								<small class="text-danger">
									<i>Disarankan rasio 1:1 (persegi)</i>
								</small>
							</div>
						</div>
					</div>
					<div class="mb-3 row">
						<label class="col-sm-3 col-form-label">Nama</label>
						<div class="col-sm-9">
							<input name="nama_pjb" type="text" class="form-control" required>
						</div>
					</div>
					<div class="mb-3 row">
						<label class="col-sm-3 col-form-label">NIP</label>
						<div class="col-sm-9">
							<input name="nip_pjb" type="text" class="form-control" required>
						</div>
					</div>
					<div class="mb-3 row">
						<label class="col-sm-3 col-form-label">Bidang</label>
						<div class="col-sm-9">
							<select id="bid" class="form-select" name="edit_nama_bagian_pengguna" required>
								<option value="" selected></option>
								<?php foreach ($dataBidang as $val) { ?>
									<option value="<?= $val[0] ?>"><?= $val[1] ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="mb-3 row">
						<label class="col-sm-3 col-form-label">Sub-Bidang</label>
						<div class="col-sm-9">
							<select id="subbid" class="form-select" name="edit_nama_subbagian_pengguna" disabled>
								<option value="" selected></option>
								<?php
								foreach ($dataBidang as $val) {
									if ($val[3] == "") {
										continue;
									}
								?>
									<option value="<?= $val[2] ?>"><?= $val[3] ?></option>
								<?php
								}
								?>
							</select>
						</div>
					</div>
					<div class="mb-3 row">
						<label class="col-sm-3 col-form-label">Jabatan</label>
						<div class="col-sm-9">
							<select id="jabat" class="form-select" name="edit_nama_jabatan_pengguna" disabled required>
								<option value="" selected></option>
								<option value="jp">PENGELOLA</option>
							</select>
						</div>
					</div>
					<div class="mb-3 row">
						<label class="col-sm-3 col-form-label">No. HP</label>
						<div class="col-sm-9">
							<input name="hp_pjb" type="text" class="form-control" required>
						</div>
					</div>
					<div class="mb-3 row">
						<label class="col-sm-3 col-form-label">Alamat</label>
						<div class="col-sm-9">
							<input name="alamat_pjb" type="text" class="form-control" required>
						</div>
					</div>
					<!-- ISI MODAL END HERE -->
				</div>
				<div class="modal-footer">
					<button type="submit" name="tambah_user" class="btn btn-primary">Simpan</button>
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- MODAL TAMBAH PIKET -->
<div class="modal fade" id="modal_tambah_piket" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<form class="m-0 p-0" id="formTambahPiket">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Tambah Piket</h5>
				</div>
				<div class="modal-body">
					<!-- ISI MODAL START HERE -->
					<div class="mb-3 row">
						<label class="col-sm-3 col-form-label"><i>Username</i></label>
						<div class="col-sm-9">
							<input name="pengguna_piket" type="text" class="form-control" required>
						</div>
					</div>
					<div class="mb-3 row">
						<label class="col-sm-3 col-form-label"><i>Password</i></label>
						<div class="col-sm-9">
							<input name="pass_piket_1" type="password" class="form-control pass" required>
							<div class="mt-1">
								<small class="text-danger"><i>Disarankan paduan huruf, angka dan/atau simbol</i></small>
							</div>
						</div>
					</div>


					<!-- ISI MODAL END HERE -->
				</div>
				<div class="modal-footer">
					<button type="submit" name="tambah_piket" class="btn btn-primary">Simpan</button>
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- MODAL BAGIAN -->
<div class="modal fade" id="modal_bagian_edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<form class="m-0 p-0" id="formTambahBagian">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Pengaturan Bagian</h5>
				</div>
				<!-- ISI MODAL START HERE -->
				<div class="modal-body px-4">
					<table class="table td-vmiddle">
						<thead>
							<tr>
								<th width="8%">#</th>
								<th width="72%">Nama Bagian</th>
								<th width="20%">Pilihan</th>
							</tr>
						</thead>
						<tbody>

							<?php
							$num = 0;
							foreach ($dataBidang as $value) {
								if ($value[0] != "") {
									$num++;
							?>

									<tr>
										<th><?= $num ?></th>
										<td>
											<input id="bagian_<?= $value[0] ?>" name="bagian_<?= $value[0] ?>" type="text" class="form-control" required="" value="<?= $value[1] ?>" readonly="readonly">
										</td>
										<td>
											<button class="btn btn-primary col-5" type="button" id="tombol_<?= $value[0] ?>"><i id="ikon_tombol_<?= $value[0] ?>" class="bi bi-pencil-square"></i></button>
											<button class="btn btn-danger col-5"><i class="bi bi-trash"></i></button>
										</td>
									</tr>

									<!-- JQUERY PENGATUR INPUT -->
									<script>
										$("#tombol_<?= $value[0] ?>").click(function() {
											$('#bagian_<?= $value[0] ?>').attr('readonly', function(index, attr) {
												return attr == 'readonly' ? null : 'readonly';
											});
											$('#ikon_tombol_<?= $value[0] ?>').attr('class', function(index, attr) {
												return attr == 'bi bi-pencil-square' ? 'bi bi-check-lg' : 'bi bi-pencil-square';
											});
											$('#tombol_<?= $value[0] ?>').attr('class', function(index, attr) {
												return attr == 'btn btn-primary col-5' ? 'btn btn-success col-5' : 'btn btn-primary col-5';
											});
										});
									</script>

							<?php
								}
							}
							?>

							<tr>
								<td>Tambah</td>
								<td><input name="tambah_bagian" type="text" class="form-control" required></td>
								<td>
									<button class="col-5 btn btn-success"><i class="bi bi-plus-lg"></i></button>
								</td>
							</tr>

						</tbody>
					</table>
				</div>
				<!-- ISI MODAL END HERE -->
				<div class="modal-footer">
					<button type="button" class="btn btn-primary">Simpan</button>
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- MODAL SUBBAGIAN -->
<div class="modal fade" id="modal_subbagian_edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<form class="m-0 p-0" method="POST" action="">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Pengaturan Sub-Bagian</h5>
				</div>
				<!-- ISI MODAL START HERE -->
				<div class="modal-body px-4">
					<table class="table td-vmiddle">
						<thead>
							<tr>
								<th width="7%">#</th>
								<th width="43%">Nama Sub-Bagian</th>
								<th width="30%">Bagian</th>
								<th width="20%">Pilihan</th>
							</tr>
						</thead>
						<tbody>

							<?php
							$num = 0;
							foreach ($dataBidang as $value) {
								if ($value[2] != '') {
									$num++;
									$id = $value[2];
									$id_bidang = array_search_multi($dataBidang, 0, substr($value[2], 0, 2), false)[0][0];
									$nama_bidang = array_search_multi($dataBidang, 0, substr($value[2], 0, 2), false)[0][1];
							?>
									<tr>
										<th><?= $num ?></th>
										<td>
											<input id="subbagian_<?= $id ?>" name="subbagian_<?= $id ?>" type="text" class="form-control class_subbagian_<?= $id ?>" required="" value="<?= $value[3] ?>" readonly="readonly">
										</td>
										<td>
											<select id="edit_nama_bagian_<?= $id ?>" class="form-select" name="edit_nama_bagian_<?= $id ?>" required disabled="disabled">
												<option value="" selected="">== Pilih jenis bagian ==</option>
												<?php
												foreach ($dataBidang as $val) {
													if ($val[0] != "") {
												?>
														<option value="<?= $val[0] ?>" <?= $val[0] == $id_bidang ? "selected" : "" ?>><?= $val[1] ?></option>
												<?php
													}
												}
												?>
											</select>
										</td>
										<td>
											<button class="btn btn-primary col-5" id="tombol_subbagian_<?= $id ?>" type="button" data-bs-toggle="collapse" data-bs-target="#edit_subbagian_1" aria-expanded="false" aria-controls="edit_subbagian_1"><i id="ikon_tombol_<?= $id ?>" class="bi bi-pencil-square"></i></button>
											<button class="btn btn-danger col-5"><i class="bi bi-trash"></i></button>
										</td>
									</tr>

									<!-- JQUERY PENGATUR INPUT -->
									<script>
										$("#tombol_subbagian_<?= $id ?>").click(function() {
											$('#subbagian_<?= $id ?>').attr('readonly', function(index, attr) {
												return attr == 'readonly' ? null : 'readonly';
											});
											$('#edit_nama_bagian_<?= $id ?>').attr('disabled', function(index, attr) {
												return attr == 'disabled' ? null : 'disabled';
											});
											$('#ikon_tombol_<?= $id ?>').attr('class', function(index, attr) {
												return attr == 'bi bi-pencil-square' ? 'bi bi-check-lg' : 'bi bi-pencil-square';
											});
											$('#tombol_subbagian_<?= $id ?>').attr('class', function(index, attr) {
												return attr == 'btn btn-primary col-5' ? 'btn btn-success col-5' : 'btn btn-primary col-5';
											});
										});
									</script>

							<?php
								}
							}
							?>

							<tr>
								<td>Tambah</td>
								<td><input name="tambah_subbagian" type="text" class="form-control" required></td>
								<td>
									<select class="form-select" name="tambah_subbagian" required>
										<option value="" selected="">== Pilih jenis bagian ==</option>
										<?php
										foreach ($dataBidang as $val) {
											if ($val[0] != "") {
										?>
												<option value="<?= $val[0] ?>"><?= $val[1] ?></option>
										<?php
											}
										}
										?>
									</select>
								</td>
								<td>
									<button class="col-5 btn btn-success"><i class="bi bi-plus-lg"></i></button>
								</td>
							</tr>

						</tbody>
					</table>
				</div>
				<!-- ISI MODAL END HERE -->
				<div class="modal-footer">
					<button type="button" class="btn btn-primary">Simpan</button>
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- MODAL JABATAN -->
<div class="modal fade" id="modal_jabatan_edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<form class="m-0 p-0" method="POST" action="">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Pengaturan Jabatan</h5>
				</div>
				<!-- ISI MODAL START HERE -->
				<div class="modal-body px-4">
					<table class="table td-vmiddle">
						<thead>
							<tr>
								<th width="8%">#</th>
								<th width="72%">Nama Jabatan</th>
								<th width="20%">Pilihan</th>
							</tr>
						</thead>
						<tbody>

							<?php
							$num = 0;
							foreach ($dataBidang as $value) {
								if ($value[4] != '') {
									$num++;
									$id_j = $value[4];
									$nama_j = $value[5];
							?>

									<tr>
										<th><?= $num ?></th>
										<td>
											<input id="jabatan_<?= $id_j ?>" name="jabatan_<?= $id_j ?>" type="text" class="form-control" required="" value="<?= $nama_j ?>" readonly="readonly">
										</td>
										<td>
											<button class="btn btn-primary col-5" type="button" id="tombol_j_<?= $id_j ?>"><i id="ikon_tombol_j_<?= $id_j ?>" class="bi bi-pencil-square"></i></button>
											<button class="btn btn-danger col-5"><i class="bi bi-trash"></i></button>
										</td>
									</tr>

									<!-- JQUERY PENGATUR INPUT -->
									<script>
										$("#tombol_j_<?= $id_j ?>").click(function() {
											$('#jabatan_<?= $id_j ?>').attr('readonly', function(index, attr) {
												return attr == 'readonly' ? null : 'readonly';
											});
											$('#ikon_tombol_j_<?= $id_j ?>').attr('class', function(index, attr) {
												return attr == 'bi bi-pencil-square' ? 'bi bi-check-lg' : 'bi bi-pencil-square';
											});
											$('#tombol_j_<?= $id_j ?>').attr('class', function(index, attr) {
												return attr == 'btn btn-primary col-5' ? 'btn btn-success col-5' : 'btn btn-primary col-5';
											});
										});
									</script>

							<?php
								}
							}
							?>

							<tr>
								<td>Tambah</td>
								<td><input name="tambah_jabatan" type="text" class="form-control" required></td>
								<td>
									<button class="col-5 btn btn-success"><i class="bi bi-plus-lg"></i></button>
								</td>
							</tr>

						</tbody>
					</table>
				</div>
				<!-- ISI MODAL END HERE -->
				<div class="modal-footer">
					<button type="button" class="btn btn-primary">Simpan</button>
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- MAIN CONTENT -->
<main>
	<div class="pt-4 pb-3">
		<!-- DAFTAR PEJABAT -->
		<div class="container-sm pb-3">
			<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3">

				<?php
				foreach ($data as $value) {
					$id = encrypt_decrypt("e", $value[0]);
				?>

					<div class="col">
						<div class="card shadow-sm">

							<!-- NAMA -->
							<div class="card-header warna-dasar">
								<?= $value[3] ?>
							</div>

							<!-- FOTO -->
							<div class="tunggu" style="height: 310px; overflow: hidden;">
								<img style="cursor:pointer; width: 100%; min-height: 310px; min-width: 310px;" src="<?= $value[7] != "" ? $value[7] : "img/p.webp" ?>" data-bs-toggle="modal" data-bs-target="#foto_<?= $value[0] ?>">
							</div>

							<!-- MODAL FOTO -->
							<div class="modal fade" id="foto_<?= $value[0] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Foto: <?= $value[3] ?></h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										</div>
										<div class="modal-body">
											<!-- ISI MODAL START HERE -->
											<img class="modal-foto" src="<?= $value[7] != "" ? $value[7] : "img/p.webp" ?>" alt="">
											<!-- ISI MODAL END HERE -->
										</div>
									</div>
								</div>
							</div>

							<!-- CARD BODY -->
							<div class="card-body">
								<!-- JABATAN -->
								<p class="card-text">
									<!-- <?= $value[2] ?> -->
								</p>
								<!-- TOMBOL -->
								<div class="d-flex justify-content-between align-items-center">
									<div class="btn-group">
										<a href="detail.php?id=<?= $id ?>" type="button" class="btn btn-sm btn-outline-primary">Detail</a>
										<a href="#" type="button" class="btn btn-sm btn-outline-danger" onclick="return tanya_hapus()">Hapus</a>
									</div>
									<!-- <small class="text-muted">Status keberadaan</small> -->
								</div>
							</div>

						</div>
					</div>

				<?php
				}
				?>

			</div>
		</div>

		<!-- PAGINATION MULAI -->
		<?php if ($total_data > $limit) : ?>
			<nav aria-label="Page navigation example">
				<ul class="pagination justify-content-center">

					<!-- SEBELUMNYA -->
					<li class="page-item <?= $page == 1 ? "disabled" : "" ?>">
						<a class="page-link" href="?p=1" aria-label="Previous">
							<span aria-hidden="true">&laquo;</span>
						</a>
					</li>

					<!-- TENGAH-TENGAH -->
					<?php
					for ($start_number; $start_number <= $end_number; $start_number++) {
						$active = $page == $start_number ? "active" : "";
					?>
						<li class="page-item <?= $active ?>">
							<?php if (!isset($_GET['p']) && $start_number == 1) { ?>
								<span class="page-link"><?= $start_number ?></span>
							<?php } elseif ($page != $start_number) { ?>
								<a class="page-link" href="?p=<?= $start_number ?>"><?= $start_number ?></a>
							<?php } else { ?>
								<span class="page-link"><?= $start_number ?></span>
							<?php } ?>
						</li>
					<?php
					}
					?>

					<!-- SELANJUTNYA -->
					<li class="page-item <?= $page == $end_number ? "disabled" : "" ?>">
						<a class="page-link" href="?p=<?= $total_pages ?>" aria-label="Next">
							<span aria-hidden="true">&raquo;</span>
						</a>
					</li>

				</ul>
			</nav>
		<?php endif; ?>
		<!-- PAGINATION SELESAI -->

	</div>
</main>

<script>
	let modalTambahPengguna = new bootstrap.Modal(document.getElementById('modal_tambah_pengguna'));
	$('#bid').on('change', function(e) {
		switch ($('#bid').prop('selectedIndex')) {
			case 0:
				$('#subbid, #jabat').prop('selectedIndex', 0);
				$('#subbid, #jabat').prop('disabled', true);
				break;
			case 1:
				$('#subbid').prop('disabled', false);
				$('#jabat').prop('disabled', true);
				$('#subbid, #jabat').prop('selectedIndex', 0);
				break;
			default:
				$('#subbid').prop('disabled', true);
				$('#jabat').prop('disabled', false);
				$('#subbid, #jabat').prop('selectedIndex', 0);
				break;
		}
	})

	$('#subbid').on('change', function(e) {
		switch ($('#subbid').prop('selectedIndex')) {
			case 0:
				$('#jabat').prop('disabled', true);
				$('#jabat').prop('selectedIndex', 0);
				break;
			default:
				$('#jabat').prop('disabled', false);
				$('#jabat').prop('selectedIndex', 0);
				break;
		}
	})
	// TAMBAH PENGGUNA
	$('#formTambahUser').submit(function(e) {
		let foto, valArr = [];
		$(`#modal_tambah_pengguna input,#modal_tambah_pengguna select`).filter((ind, el) => {
			valArr.push(el.value);
		});

		let reader = new FileReader();
		reader.onload = function() {
			foto = new Uint8Array(reader.result);

			const data = `tambahUser=&username=${valArr[0]}&password=${valArr[1]}&nama=${valArr[3]}&nip=${valArr[4]}&bidang=${valArr[5]}&subbidang=${valArr[6]}&jabatan=${valArr[7]}&nohp=${valArr[8]}&alamat=${valArr[9]}&foto=${foto}`;

			tanya_simpan("Tambah Pengguna", "Yakin akan simpan?", data);
			responProses().then(res => { ///////////// PROMISE ====================+
				if (res != 'Username sudah digunakan') {
					notif('Data tersimpan');
					modalTambahPengguna.hide()
					$(`#modal_tambah_pengguna input,#modal_tambah_pengguna select`).filter((ind, el) => {
						el.value = "";
					});
				} else {
					notif(res);
					$(`#modal_tambah_pengguna input`)[0].click()
				}
			})
		}
		reader.readAsArrayBuffer($(`#modal_tambah_pengguna input`)[2].files[0]);
		e.preventDefault()
	});

	<?php
	if (isset($_POST['data'])) {
		unset($data);
		unset($_SESSION['data']);
		$data = $_POST['data']['dataPjb'];
	}
	?>

	$('#formTambahPiket').submit(function(e) {
		e.preventDefault();
		alert('Under Maintenance');
	})
</script>

<?php
include("layout/footer.php");
?>
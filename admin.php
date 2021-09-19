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
	$_GET['p'] = encrypt_decrypt("e", $total_pages);
	pindahko("?" . http_build_query($_GET));
}
$data = array_slice($data, $offset, $limit);
// UNTUK PAGINATION END
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
						<!-- FORM UPLOAD GAMBAR -->
						<!-- <div class="mb-3 row">
							<form action="" method="post" enctype="multipart/form-data">
								<input class="form-control" type="file" id="formFile" accept="image/*">
								<input class="mt-3 btn btn-primary" type="submit" value="Simpan Gambar" name="submit">
							</form>
						</div> -->
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
								<button class="btn btn-primary btn-sm">Ganti</button>
							</div>
							<div class="col-sm-2 d-inline-block">
								<button class="btn btn-primary btn-sm">Ganti</button>
							</div>
							<div class="col-sm-2 d-inline-block">
								<button class="btn btn-primary btn-sm">Ganti</button>
							</div>
							<div class="col-sm-2 d-inline-block">
								<button class="btn btn-primary btn-sm">Ganti</button>
							</div>
							<div class="col-sm-2 d-inline-block">
								<button class="btn btn-primary btn-sm">Ganti</button>
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
						<label class="col-sm-3 col-form-label"><i>Ulangi Password</i></label>
						<div class="col-sm-9">
							<input name="pass_pjb_2" type="password" class="form-control pass" required>
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
							<select id="bidang" class="form-select" name="edit_nama_bagian_pengguna">
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
							<select id="subbidang" class="form-select" name="edit_nama_subbagian_pengguna" disabled>
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
							<select id="jabatan" class="form-select" name="edit_nama_jabatan_pengguna" required>
								<option value="" selected></option>
								<?php
								foreach ($dataBidang as $val) {
								?>
									<option value="<?= $val[4] ?>"><?= $val[5] ?></option>
								<?php
								}
								?>
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
					<div class="mb-3 row">
						<label class="col-sm-3 col-form-label"><i>Ulangi Password</i></label>
						<div class="col-sm-9">
							<input name="pass_piket_2" type="password" class="form-control pass" required>
						</div>
					</div>
					<!-- <div class="mb-3 row">
						<label class="col-sm-3 col-form-label">Foto</label>
						<div class="col-sm-9">
							<input name="foto_pjb" type="file" class="form-control" accept=".png,.jpg,.jpeg" required>
							<div class="mt-1">
								<small class="text-danger">
									<i>Disarankan rasio 1:1 (persegi)</i>
								</small>
							</div>
						</div>
					</div> -->

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
			<form class="m-0 p-0" method="POST" action="">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Pengaturan Bagian</h5>
				</div>
				<!-- ISI MODAL START HERE -->
				<div class="modal-body px-4">
					<table class="table">
						<thead>
							<tr>
								<th>#</th>
								<th>Nama Bagian</th>
								<th>Pilihan</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th>1</th>
								<td>Kepala Dinas</td>
								<td>
									<button type="button" class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#edit_bagian_1" aria-expanded="false" aria-controls="edit_bagian_1"><i class="bi bi-pencil-square"></i></button>
									<button class="btn btn-danger"><i class="bi bi-trash"></i></button>
								</td>
							</tr>
							<tr>
								<td colspan="3" class="collapse" id="edit_bagian_1">
									<div class="row">
										<div class="col-sm-11">
											<input name="bagian_1" type="text" class="form-control" required="" value="Kepala Dinas">
										</div>
										<button class="col-sm-1 btn btn-success"><i class="bi bi-check-lg"></i></button>
									</div>
								</td>
							</tr>
							<tr>
								<th>2</th>
								<td>Pembinaan PKPLK Bahasa dan Sastra</td>
								<td>
									<button type="button" class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#edit_bagian_2" aria-expanded="false" aria-controls="edit_bagian_2"><i class="bi bi-pencil-square"></i></button>
									<button class="btn btn-danger"><i class="bi bi-trash"></i></button>
								</td>
							</tr>
							<tr>
								<td colspan="3" class="collapse" id="edit_bagian_2">
									<div class="row">
										<div class="col-sm-11">
											<input name="bagian_6" type="text" class="form-control" required="" value="Pembinaan PKPLK Bahasa dan Sastra">
										</div>
										<button class="col-sm-1 btn btn-success"><i class="bi bi-check-lg"></i></button>
									</div>
								</td>
							</tr>
							<tr>
								<th>3</th>
								<td>Pembinaan PTK Fasilitasi Paud Dikdas Dikti dan Dikmas</td>
								<td>
									<button type="button" class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#edit_bagian_3" aria-expanded="false" aria-controls="edit_bagian_3"><i class="bi bi-pencil-square"></i></button>
									<button class="btn btn-danger"><i class="bi bi-trash"></i></button>
								</td>
							</tr>
							<tr>
								<td colspan="3" class="collapse" id="edit_bagian_3">
									<div class="row">
										<div class="col-sm-11">
											<input name="bagian_5" type="text" class="form-control" required="" value="Pembinaan PTK Fasilitasi Paud Dikdas Dikti dan Dikmas">
										</div>
										<button class="col-sm-1 btn btn-success"><i class="bi bi-check-lg"></i></button>
									</div>
								</td>
							</tr>
							<tr>
								<th>4</th>
								<td>Pembinaan SMA</td>
								<td>
									<button type="button" class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#edit_bagian_4" aria-expanded="false" aria-controls="edit_bagian_4"><i class="bi bi-pencil-square"></i></button>
									<button class="btn btn-danger"><i class="bi bi-trash"></i></button>
								</td>
							</tr>
							<tr>
								<td colspan="3" class="collapse" id="edit_bagian_4">
									<div class="row">
										<div class="col-sm-11">
											<input name="bagian_3" type="text" class="form-control" required="" value="Pembinaan SMA">
										</div>
										<button class="col-sm-1 btn btn-success"><i class="bi bi-check-lg"></i></button>
									</div>
								</td>
							</tr>
							<tr>
								<th>5</th>
								<td>Pembinaan SMK</td>
								<td>
									<button type="button" class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#edit_bagian_5" aria-expanded="false" aria-controls="edit_bagian_5"><i class="bi bi-pencil-square"></i></button>
									<button class="btn btn-danger"><i class="bi bi-trash"></i></button>
								</td>
							</tr>
							<tr>
								<td colspan="3" class="collapse" id="edit_bagian_5">
									<div class="row">
										<div class="col-sm-11">
											<input name="bagian_4" type="text" class="form-control" required="" value="Pembinaan SMK">
										</div>
										<button class="col-sm-1 btn btn-success"><i class="bi bi-check-lg"></i></button>
									</div>
								</td>
							</tr>
							<tr>
								<th>6</th>
								<td>Sekretariat</td>
								<td>
									<button type="button" class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#edit_bagian_6" aria-expanded="false" aria-controls="edit_bagian_6"><i class="bi bi-pencil-square"></i></button>
									<button class="btn btn-danger"><i class="bi bi-trash"></i></button>
								</td>
							</tr>
							<tr>
								<td colspan="3" class="collapse" id="edit_bagian_6">
									<div class="row">
										<div class="col-sm-11">
											<input name="bagian_2" type="text" class="form-control" required="" value="Sekretariat">
										</div>
										<button class="col-sm-1 btn btn-success"><i class="bi bi-check-lg"></i></button>
									</div>
								</td>
							</tr>
							<tr>
								<th>7</th>
								<td>UPT PTIKP</td>
								<td>
									<button type="button" class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#edit_bagian_7" aria-expanded="false" aria-controls="edit_bagian_7"><i class="bi bi-pencil-square"></i></button>
									<button class="btn btn-danger"><i class="bi bi-trash"></i></button>
								</td>
							</tr>
							<tr>
								<td colspan="3" class="collapse" id="edit_bagian_7">
									<div class="row">
										<div class="col-sm-11">
											<input name="bagian_7" type="text" class="form-control" required="" value="UPT PTIKP">
										</div>
										<button class="col-sm-1 btn btn-success"><i class="bi bi-check-lg"></i></button>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
					<div class="mb-3 row">
						<label class="col-sm-3 col-form-label">Tambah Bagian</label>
						<div class="col-sm-8">
							<input name="tambah_bagian" type="text" class="form-control" required>
						</div>
						<button class="col-sm-1 btn btn-success"><i class="bi bi-plus-lg"></i></button>
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
					<table class="table">
						<thead>
							<tr>
								<th>#</th>
								<th>Nama Sub-Bagian</th>
								<th>Bagian</th>
								<th>Pilihan</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th>1</th>
								<td>Umum Kepegawaian dan Hukum</td>
								<td>Sekretariat</td>
								<td>
									<button type="button" class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#edit_subbagian_1" aria-expanded="false" aria-controls="edit_subbagian_1"><i class="bi bi-pencil-square"></i></button>
									<button class="btn btn-danger"><i class="bi bi-trash"></i></button>
								</td>
							</tr>
							<tr>
								<td colspan="4" class="collapse" id="edit_subbagian_1">
									<div class="row">
										<div class="col-sm-7">
											<input name="subbagian_2" type="text" class="form-control" required="" value="Umum Kepegawaian dan Hukum">
										</div>
										<div class="col-sm-4">
											<select class="form-select" name="edit_nama_bagian_2" required>
												<option value="" selected="">== Pilih jenis bagian ==</option>
												<option value="1">Kepala Dinas</option>
												<option value="6">Pembinaan PKPLK Bahasa dan Sastra</option>
												<option value="5">Pembinaan PTK Fasilitasi Paud Dikdas Dikti dan Dikmas</option>
												<option value="3">Pembinaan SMA</option>
												<option value="4">Pembinaan SMK</option>
												<option value="2" selected="">Sekretariat</option>
												<option value="7">UPT PTIKP</option>
											</select>
										</div>
										<button class="col-sm-1 btn btn-success"><i class="bi bi-check-lg"></i></button>
									</div>
								</td>
							</tr>
							<tr>
								<th>2</th>
								<td>Keuangan</td>
								<td>Sekretariat</td>
								<td>
									<button type="button" class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#edit_subbagian_2" aria-expanded="false" aria-controls="edit_subbagian_2"><i class="bi bi-pencil-square"></i></button>
									<button class="btn btn-danger"><i class="bi bi-trash"></i></button>
								</td>
							</tr>
							<tr>
								<td colspan="4" class="collapse" id="edit_subbagian_2">
									<div class="row">
										<div class="col-sm-7">
											<input name="subbagian_2" type="text" class="form-control" required="" value="Keuangan">
										</div>
										<div class="col-sm-4">
											<select class="form-select" name="edit_nama_bagian_2" required>
												<option value="" selected="">== Pilih jenis bagian ==</option>
												<option value="1">Kepala Dinas</option>
												<option value="6">Pembinaan PKPLK Bahasa dan Sastra</option>
												<option value="5">Pembinaan PTK Fasilitasi Paud Dikdas Dikti dan Dikmas</option>
												<option value="3">Pembinaan SMA</option>
												<option value="4">Pembinaan SMK</option>
												<option value="2" selected="">Sekretariat</option>
												<option value="7">UPT PTIKP</option>
											</select>
										</div>
										<button class="col-sm-1 btn btn-success"><i class="bi bi-check-lg"></i></button>
									</div>
								</td>
							</tr>
							<tr>
								<th>3</th>
								<td>Program</td>
								<td>Sekretariat</td>
								<td>
									<button type="button" class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#edit_subbagian_3" aria-expanded="false" aria-controls="edit_subbagian_3"><i class="bi bi-pencil-square"></i></button>
									<button class="btn btn-danger"><i class="bi bi-trash"></i></button>
								</td>
							</tr>
							<tr>
								<td colspan="4" class="collapse" id="edit_subbagian_3">
									<div class="row">
										<div class="col-sm-7">
											<input name="subbagian_2" type="text" class="form-control" required="" value="Program">
										</div>
										<div class="col-sm-4">
											<select class="form-select" name="edit_nama_bagian_2" required>
												<option value="" selected="">== Pilih jenis bagian ==</option>
												<option value="1">Kepala Dinas</option>
												<option value="6">Pembinaan PKPLK Bahasa dan Sastra</option>
												<option value="5">Pembinaan PTK Fasilitasi Paud Dikdas Dikti dan Dikmas</option>
												<option value="3">Pembinaan SMA</option>
												<option value="4">Pembinaan SMK</option>
												<option value="2" selected="">Sekretariat</option>
												<option value="7">UPT PTIKP</option>
											</select>
										</div>
										<button class="col-sm-1 btn btn-success"><i class="bi bi-check-lg"></i></button>
									</div>
								</td>
							</tr>
							<tr>
								<th>4</th>
								<td>Subbidang Pembinaan SMA</td>
								<td>Pembinaan SMA</td>
								<td>
									<button type="button" class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#edit_subbagian_4" aria-expanded="false" aria-controls="edit_subbagian_4"><i class="bi bi-pencil-square"></i></button>
									<button class="btn btn-danger"><i class="bi bi-trash"></i></button>
								</td>
							</tr>
							<tr>
								<td colspan="4" class="collapse" id="edit_subbagian_4">
									<div class="row">
										<div class="col-sm-7">
											<input name="subbagian_3" type="text" class="form-control" required="" value="Subbidang Pembinaan SMA">
										</div>
										<div class="col-sm-4">
											<select class="form-select" name="edit_nama_bagian_3" required>
												<option value="" selected="">== Pilih jenis bagian ==</option>
												<option value="1">Kepala Dinas</option>
												<option value="6">Pembinaan PKPLK Bahasa dan Sastra</option>
												<option value="5">Pembinaan PTK Fasilitasi Paud Dikdas Dikti dan Dikmas</option>
												<option value="3" selected="">Pembinaan SMA</option>
												<option value="4">Pembinaan SMK</option>
												<option value="2">Sekretariat</option>
												<option value="7">UPT PTIKP</option>
											</select>
										</div>
										<button class="col-sm-1 btn btn-success"><i class="bi bi-check-lg"></i></button>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
					<div class="mb-3 row">
						<label class="col-sm-3 col-form-label">Tambah Bagian</label>
						<div class="col-sm-8">
							<input name="tambah_subbagian" type="text" class="form-control" required>
						</div>
						<button class="col-sm-1 btn btn-success"><i class="bi bi-plus-lg"></i></button>
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
					<table class="table">
						<thead>
							<tr>
								<th>#</th>
								<th>Nama Jabatan</th>
								<th>Sub-Bagian</th>
								<th>Bagian</th>
								<th>Pilihan</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th>1</th>
								<td>Kasubag Keuangan</td>
								<td>Keuangan</td>
								<td>Sekretariat</td>
								<td>
									<button type="button" class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#edit_jabatan_1" aria-expanded="false" aria-controls="edit_jabatan_1"><i class="bi bi-pencil-square"></i></button>
									<button class="btn btn-danger"><i class="bi bi-trash"></i></button>
								</td>
							</tr>
							<tr>
								<td colspan="5" class="collapse" id="edit_jabatan_1">
									<div class="row">
										<div class="col-sm-5">
											<input name="jabatan_3" type="text" class="form-control" required="" value="Kasubag Keuangan">
										</div>
										<div class="col-sm-3">
											<select class="form-select" name="edit_nama_subbagian_3">
												<option value="" selected="">== Pilih jenis sub bagian ==</option>
												<option value="2" selected="">Keuangan</option>
												<option value="3">Program</option>
												<option value="4">Subbidang Pembinaan SMA</option>
												<option value="1">Umum Kepegawaian dan Hukum</option>
											</select>
										</div>
										<div class="col-sm-3">
											<select class="form-select" name="edit_nama_bagian_3" required>
												<option value="" selected="">== Pilih jenis bagian ==</option>
												<option value="1">Kepala Dinas</option>
												<option value="6">Pembinaan PKPLK Bahasa dan Sastra</option>
												<option value="5">Pembinaan PTK Fasilitasi Paud Dikdas Dikti dan Dikmas</option>
												<option value="3">Pembinaan SMA</option>
												<option value="4">Pembinaan SMK</option>
												<option value="2" selected="">Sekretariat</option>
												<option value="7">UPT PTIKP</option>
											</select>
										</div>
										<button class="col-sm-1 btn btn-success"><i class="bi bi-check-lg"></i></button>
									</div>
								</td>
							</tr>
							<tr>
								<th>2</th>
								<td>Kepala Dinas</td>
								<td>-</td>
								<td>Kepala Dinas</td>
								<td>
									<button type="button" class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#edit_jabatan_2" aria-expanded="false" aria-controls="edit_jabatan_2"><i class="bi bi-pencil-square"></i></button>
									<button class="btn btn-danger"><i class="bi bi-trash"></i></button>
								</td>
							</tr>
							<tr>
								<td colspan="5" class="collapse" id="edit_jabatan_2">
									<div class="row">
										<div class="col-sm-5">
											<input name="jabatan_1" type="text" class="form-control" required="" value="Kepala Dinas">
										</div>
										<div class="col-sm-3">
											<select class="form-select" name="edit_nama_subbagian_1">
												<option value="" selected="">== Pilih jenis sub bagian ==</option>
												<option value="2">Keuangan</option>
												<option value="3">Program</option>
												<option value="4">Subbidang Pembinaan SMA</option>
												<option value="1">Umum Kepegawaian dan Hukum</option>
											</select>
										</div>
										<div class="col-sm-3">
											<select class="form-select" name="edit_nama_bagian_1" required>
												<option value="" selected="">== Pilih jenis bagian ==</option>
												<option value="1" selected="">Kepala Dinas</option>
												<option value="6">Pembinaan PKPLK Bahasa dan Sastra</option>
												<option value="5">Pembinaan PTK Fasilitasi Paud Dikdas Dikti dan Dikmas</option>
												<option value="3">Pembinaan SMA</option>
												<option value="4">Pembinaan SMK</option>
												<option value="2">Sekretariat</option>
												<option value="7">UPT PTIKP</option>
											</select>
										</div>
										<button class="col-sm-1 btn btn-success"><i class="bi bi-check-lg"></i></button>
									</div>
								</td>
							</tr>
							<tr>
								<th>3</th>
								<td>Sekretaris</td>
								<td>-</td>
								<td>Sekretariat</td>
								<td>
									<button type="button" class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#edit_jabatan_3" aria-expanded="false" aria-controls="edit_jabatan_3"><i class="bi bi-pencil-square"></i></button>
									<button class="btn btn-danger"><i class="bi bi-trash"></i></button>
								</td>
							</tr>
							<tr>
								<td colspan="5" class="collapse" id="edit_jabatan_3">
									<div class="row">
										<div class="col-sm-5">
											<input name="jabatan_2" type="text" class="form-control" required="" value="Sekretaris">
										</div>
										<div class="col-sm-3">
											<select class="form-select" name="edit_nama_subbagian_2">
												<option value="" selected="">== Pilih jenis sub bagian ==</option>
												<option value="2">Keuangan</option>
												<option value="3">Program</option>
												<option value="4">Subbidang Pembinaan SMA</option>
												<option value="1">Umum Kepegawaian dan Hukum</option>
											</select>
										</div>
										<div class="col-sm-3">
											<select class="form-select" name="edit_nama_bagian_2" required>
												<option value="" selected="">== Pilih jenis bagian ==</option>
												<option value="1">Kepala Dinas</option>
												<option value="6">Pembinaan PKPLK Bahasa dan Sastra</option>
												<option value="5">Pembinaan PTK Fasilitasi Paud Dikdas Dikti dan Dikmas</option>
												<option value="3">Pembinaan SMA</option>
												<option value="4">Pembinaan SMK</option>
												<option value="2" selected="">Sekretariat</option>
												<option value="7">UPT PTIKP</option>
											</select>
										</div>
										<button class="col-sm-1 btn btn-success"><i class="bi bi-check-lg"></i></button>
									</div>
								</td>
							</tr>


						</tbody>
					</table>
					<div class="mb-3 row">
						<label class="col-sm-3 col-form-label">Tambah Bagian</label>
						<div class="col-sm-8">
							<input name="tambah_jabatan" type="text" class="form-control" required>
						</div>
						<button class="col-sm-1 btn btn-success"><i class="bi bi-plus-lg"></i></button>
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
							<div style="height: 265px; overflow: hidden;">
								<img style="width: 100%;" src="./img/orang-1.jpeg">
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
							<?php if ($page != $start_number) { ?>
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

	// TAMBAH PENGGUNA
	$('#formTambahUser').submit(function(e) {
		let foto;
		let valArr = $('input,select').slice(4, 15);

		let reader = new FileReader();
		reader.onload = function() {
			foto = new Uint8Array(reader.result);

			// console.log(foto);
			const data = `tambahUser=&username=${valArr.eq(0).val()}&password=${valArr.eq(1).val()}&nama=${valArr.eq(4).val()}&nip=${valArr.eq(5).val()}&bidang=${valArr.eq(6).val()}&subbidang=${valArr.eq(7).val()}&jabatan=${valArr.eq(8).val()}&nohp=${valArr.eq(9).val()}&alamat=${valArr.eq(10).val()}&foto=${foto}`;
			tanya_simpan("Tambah Pengguna", "Yakin akan simpan?", data, modalTambahPengguna);
		}
		reader.readAsArrayBuffer($('input')[7].files[0]);
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
<?php
$title = "Admin";
include("layout/header.php");
$_SESSION['role'] != 1 ? header("Location: /") : "";
$data = $_SESSION['data']['dataPjb'];
?>

<style>
	.coba img {
		min-width: 100%;
		width: 100%;
		height: 5rem;
	}

	.coba>div {
		overflow: hidden;
	}
</style>

<!-- SECONDARY NAVBAR -->
<div class="nav-scroller bg-light shadow-sm">
	<div class="container">
		<nav class="nav nav-underline py-1" aria-label="Secondary navigation">
			<span class="navbar-brand">Daftar Pengguna</span>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
					Tambah
				</a>
				<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
					<li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#tambah">Pengguna</a></li>
					<li>
						<hr class="dropdown-divider">
					</li>
					<li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modal_bagian_edit">Bagian</a></li>
					<li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modal_subbagian_edit">Sub-Bagian</a></li>
					<li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modal_jabatan_edit">Jabatan</a></li>
				</ul>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
					Pengaturan
				</a>
				<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
					<li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#slider_edit">Slider</a></li>
					<!-- <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#jabatan_edit">Bagian/Sub-bagian/Jabatan</a></li> -->
				</ul>
			</li>
			<a class="nav-link" href="riwayat.php">Riwayat</a>
			<section class="ms-auto">
				<input class="form-control" type="search" placeholder="Cari Pejabat" aria-label="Search">
			</section>
		</nav>
	</div>
</div>

<!-- MODAL SLIDER -->
<div class="modal fade" id="slider_edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<form class="m-0 p-0" method="POST" action="">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Pengaturan Gambar Slider</h5>
				</div>
				<!-- ISI MODAL START HERE -->
				<div class="modal-body text-center">
					<div class="px-3">
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
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- MODAL TAMBAH PENGGUNA -->
<div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<form class="m-0 p-0" method="POST" enctype="multipart/form-data">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Ubah Data</h5>
				</div>
				<div class="modal-body">
					<!-- ISI MODAL START HERE -->
					<div class="mb-3 row">
						<label class="col-sm-2 col-form-label">Pengguna</label>
						<div class="col-sm-10">
							<input name="pengguna_pjb" type="text" class="form-control" required>
							<div class="mt-1">
								<small class="text-danger"><i>Gunakan huruf kecil dan angka tanpa simbol dan diawali huruf</i></small>
							</div>
						</div>
					</div>
					<div class="mb-3 row">
						<label class="col-sm-2 col-form-label">Foto</label>
						<div class="col-sm-10">
							<input name="foto_pjb" type="file" class="form-control" accept="image/*" required>
							<div class="mt-1">
								<small class="text-danger">
									<i>Disarankan menggunakan gambar rasio 1:1 (persegi)</i>
								</small>
							</div>
						</div>
					</div>
					<div class="mb-3 row">
						<label class="col-sm-2 col-form-label">Nama</label>
						<div class="col-sm-10">
							<input name="nama_pjb" type="text" class="form-control" required>
						</div>
					</div>
					<div class="mb-3 row">
						<label class="col-sm-2 col-form-label">NIP</label>
						<div class="col-sm-10">
							<input name="nip_pjb" type="text" class="form-control" required>
						</div>
					</div>
					<div class="mb-3 row">
						<label class="col-sm-2 col-form-label">Jabatan</label>
						<div class="col-sm-10">
							<input name="jabatan_pjb" type="text" class="form-control" required>
						</div>
					</div>
					<div class="mb-3 row">
						<label class="col-sm-2 col-form-label">No. HP</label>
						<div class="col-sm-10">
							<input name="hp_pjb" type="text" class="form-control" required>
						</div>
					</div>
					<div class="mb-3 row">
						<label class="col-sm-2 col-form-label">Alamat</label>
						<div class="col-sm-10">
							<input name="alamat_pjb" type="text" class="form-control" required>
						</div>
					</div>
					<!-- ISI MODAL END HERE -->
				</div>
				<div class="modal-footer">
					<button type="submit" name="simpan_data" class="btn btn-primary">Simpan</button>
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
											<select class="form-select" name="edit_nama_bagian_2">
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
											<select class="form-select" name="edit_nama_bagian_2">
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
											<select class="form-select" name="edit_nama_bagian_2">
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
											<select class="form-select" name="edit_nama_bagian_3">
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
											<select class="form-select" name="edit_nama_bagian_3">
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
											<select class="form-select" name="edit_nama_bagian_1">
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
											<select class="form-select" name="edit_nama_bagian_2">
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
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
				</div>
			</form>
		</div>
	</div>
</div>

<main>
	<div class="pt-4 pb-3">
		<div class="container-sm pb-3">
			<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3">

				<?php
				foreach ($data as $value) {
					$id = encrypt_decrypt("e", $value[0]);
				?>

					<div class="col">
						<div class="card shadow-sm">
							<div class="card-header warna-dasar">
								<?= $value[3] ?>
							</div>
							<div style="height: 265px; overflow: hidden;">
								<img style="width: 100%;" src="./img/orang-1.jpeg">
							</div>
							<div class="card-body">
								<p class="card-text">
									<!-- <?= $value[2] ?> -->
								</p>
								<div class="d-flex justify-content-between align-items-center">
									<div class="btn-group">
										<a href="detail.php?id=<?= $id ?>" type="button" class="btn btn-sm btn-outline-primary">Detail</a>
										<button type="button" class="btn btn-sm btn-outline-danger">Hapus</button>
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

		<!-- Pagination Mulai -->
		<nav aria-label="Page navigation example">
			<ul class="pagination justify-content-center">
				<li class="page-item">
					<a class="page-link" href="#" aria-label="Previous">
						<span aria-hidden="true">&laquo;</span>
					</a>
				</li>
				<li class="page-item"><a class="page-link" href="#">1</a></li>
				<li class="page-item"><a class="page-link" href="#">2</a></li>
				<li class="page-item"><a class="page-link" href="#">3</a></li>
				<li class="page-item">
					<a class="page-link" href="#" aria-label="Next">
						<span aria-hidden="true">&raquo;</span>
					</a>
				</li>
			</ul>
		</nav>
		<!-- Pagination Selesai -->

	</div>
</main>

<?php
include("layout/footer.php");
?>
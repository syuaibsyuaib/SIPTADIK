<?php
$title = "Admin";
include("layout/header.php");
$_SESSION['role'] != 1 ? header("Location: /") : "";
?>

<style>
	.coba img {
		min-width: 100%;
		width: 100%;
		height: 5rem;
		/* cursor: move; */
	}

	.coba>div {
		overflow: hidden;
	}
</style>

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
					<li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#bagian_edit">Bagian</a></li>
					<li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#subbagian_edit">Sub-Bagian</a></li>
					<li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#jabatan_edit">Jabatan</a></li>
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

<!-- MODAL TAMBAH PENGGUNA START -->
<div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<form method="POST" action="proses.php" enctype="multipart/form-data">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Tambah Pengguna</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body px-4">
					<!-- ISI MODAL START HERE -->
					<div class="mb-3 row">
						<label class="col-sm-2 col-form-label">Nama</label>
						<div class="col-sm-10">
							<input name="nama_pejabat" type="text" class="form-control" required>
						</div>
					</div>
					<div class="mb-3 row">
						<label class="col-sm-2 col-form-label">NIP</label>
						<div class="col-sm-10">
							<input name="nip_pejabat" type="text" class="form-control" required>
						</div>
					</div>
					<div class="mb-3 row">
						<label class="col-sm-2 col-form-label">Jabatan</label>
						<div class="col-sm-10">
							<input name="jabatan_pejabat" type="text" class="form-control" required>
						</div>
					</div>
					<div class="mb-3 row">
						<label class="col-sm-2 col-form-label">No. HP</label>
						<div class="col-sm-10">
							<input name="hp_pejabat" type="text" class="form-control" required>
						</div>
					</div>
					<div class="mb-3 row">
						<label class="col-sm-2 col-form-label">Alamat</label>
						<div class="col-sm-10">
							<input name="alamat_pejabat" type="text" class="form-control" required>
						</div>
					</div>
					<div class="mb-3 row">
						<label class="col-sm-2 col-form-label">Foto Profil</label>
						<div class="col-sm-10">
							<input name="foto_pejabat" class="form-control" type="file" id="formFile" accept="image/*" required>
						</div>
					</div>
					<!-- ISI MODAL END HERE -->
				</div>
				<div class="modal-footer">
					<input type="submit" class="btn btn-primary" name="tambah" value="Simpan">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- MODAL TAMBAH PENGGUNA END -->

<!-- MODAL SLIDER START -->
<div class="modal fade" id="slider_edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<form method="POST" action="">
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
<!-- MODAL SLIDER END -->

<!-- MODAL BAGIAN START -->
<div class="modal fade" id="bagian_edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<form method="POST" action="">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Pengaturan Bagian</h5>
				</div>
				<!-- ISI MODAL START HERE -->
				<div class="modal-body px-4">
					<table class="table">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Nama Bagian</th>
								<th scope="col">Pilihan</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th scope="row">1</th>
								<td>Kepala Dinas</td>
								<td>
									<button class="btn btn-primary"><i class="bi bi-pencil-square"></i></button>
									<button class="btn btn-danger"><i class="bi bi-trash"></i></button>
								</td>
							</tr>
							<tr>
								<th scope="row">2</th>
								<td>Sekretariat</td>
								<td>
									<button class="btn btn-primary"><i class="bi bi-pencil-square"></i></button>
									<button class="btn btn-danger"><i class="bi bi-trash"></i></button>
								</td>
							</tr>
							<tr>
								<th scope="row">3</th>
								<td>Pembinaan SMA</td>
								<td>
									<button class="btn btn-primary"><i class="bi bi-pencil-square"></i></button>
									<button class="btn btn-danger"><i class="bi bi-trash"></i></button>
								</td>
							</tr>
						</tbody>
					</table>
					<div class="mb-3 row">
						<label class="col-sm-3 col-form-label">Tambah Bagian</label>
						<div class="col-sm-7">
							<input name="jabatan_pejabat" type="text" class="form-control" required>
						</div>
						<button class="col-sm-2 btn btn-success">Tambah</button>
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
<!-- MODAL BAGIAN END -->

<!-- MODAL SUBBAGIAN START -->
<div class="modal fade" id="subbagian_edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<form method="POST" action="">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Pengaturan Bagian/Sub-bagian/Jabatan</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<!-- ISI MODAL START HERE -->
				<div class="modal-body px-4">
					<div class="mb-3 row">
						<label class="col-sm-2 col-form-label">Bagian</label>
						<div class="col-sm-10">
							<input name="jabatan_pejabat" type="text" class="form-control" required>
						</div>
					</div>
					<div class="mb-3 row">
						<label class="col-sm-2 col-form-label">Sub Bagian</label>
						<div class="col-sm-10">
							<input name="jabatan_pejabat" type="text" class="form-control" required>
						</div>
					</div>
					<div class="mb-3 row">
						<label class="col-sm-2 col-form-label">Jabatan</label>
						<div class="col-sm-10">
							<input name="jabatan_pejabat" type="text" class="form-control" required>
						</div>
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
<!-- MODAL SUBBAGIAN END -->

<!-- MODAL JABATAN START -->
<div class="modal fade" id="jabatan_edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<form method="POST" action="">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Pengaturan Bagian/Sub-bagian/Jabatan</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<!-- ISI MODAL START HERE -->
				<div class="modal-body px-4">
					<div class="mb-3 row">
						<label class="col-sm-2 col-form-label">Bagian</label>
						<div class="col-sm-10">
							<input name="jabatan_pejabat" type="text" class="form-control" required>
						</div>
					</div>
					<div class="mb-3 row">
						<label class="col-sm-2 col-form-label">Sub Bagian</label>
						<div class="col-sm-10">
							<input name="jabatan_pejabat" type="text" class="form-control" required>
						</div>
					</div>
					<div class="mb-3 row">
						<label class="col-sm-2 col-form-label">Jabatan</label>
						<div class="col-sm-10">
							<input name="jabatan_pejabat" type="text" class="form-control" required>
						</div>
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
<!-- MODAL JABATAN END -->

<main>
	<div class="pt-4 pb-3">
		<div class="container-sm pb-3">
			<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3">

				<!-- --------------------------------card user -->
				<div class="col">
					<div class="card shadow-sm">
						<div class="card-header warna-dasar">
							Pejabat Satu, M.Si
						</div>
						<div style="height: 265px; overflow: hidden;">
							<img style="width: 100%;" src="./img/orang-1.jpeg">
						</div>
						<div class="card-body">
							<!-- <p class="card-text">
								<table>
								<tr>
									<td>Nama</td>
									<td class="px-1">:</td>
									<td>Pejabat Satu, M.Si</td>
								</tr>
								<tr>
									<td>NIP</td>
									<td class="px-1">:</td>
									<td>123456</td>
								</tr>
								<tr>
									<td>Jabatan</td>
									<td class="px-1">:</td>
									<td>Guild master</td>
								</tr>
								</table>
							</p> -->
							<div class="d-flex justify-content-between align-items-center">
								<div class="btn-group">
									<a href="detail.php" type="button" class="btn btn-sm btn-outline-primary">Detail</a>
									<button type="button" class="btn btn-sm btn-outline-danger">Hapus</button>
								</div>
								<small class="text-success">Ada</small>
							</div>
						</div>
					</div>
				</div>

				<div class="col">
					<div class="card shadow-sm">
						<div class="card-header warna-sibuk">
							Pejabat Dua, S.Sos
						</div>
						<div style="height: 265px; overflow: hidden;">
							<img style="width: 100%;" src="./img/orang-2.jpeg">
						</div>
						<div class="card-body">
							<div class="d-flex justify-content-between align-items-center">
								<div class="btn-group">
									<a href="detail.php" type="button" class="btn btn-sm btn-outline-primary">Detail</a>
									<button type="button" class="btn btn-sm btn-outline-danger">Hapus</button>
								</div>
								<small class="text-danger">Sibuk</small>
							</div>
						</div>
					</div>
				</div>

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
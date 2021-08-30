<?php
$title = "Admin";
include("layout/header.php");
$_SESSION['role'] != 1 ? header("Location: /") : "";
?>

<div class="nav-scroller bg-light shadow-sm">
	<div class="container">
		<nav class="nav nav-underline py-1" aria-label="Secondary navigation">
			<span class="navbar-brand">Daftar Pejabat</span>
			<!-- <a class="nav-link active" aria-current="page" href="#">Dashboard</a> -->
			<!-- <a class="nav-link" href="#"> -->
			<!-- Friends -->
			<!-- <span class="badge bg-dark text-light rounded-pill align-text-bottom">27</span> -->
			<!-- </a> -->
			<!-- <a class="nav-link" href="#">Explore</a> -->
			<!-- <a class="nav-link" href="#">Suggestions</a> -->
			<!-- <a class="nav-link" href="#">Link</a> -->
			<!-- <a class="nav-link" href="#">Link</a> -->
			<!-- <a class="nav-link" href="#">Link</a> -->
			<!-- <a class="nav-link" href="#">Link</a> -->
			<a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#tambah">Tambah Pengguna</a>
			<section class="ms-auto">
				<input class="form-control" type="search" placeholder="Cari Pejabat" aria-label="Search">
			</section>
		</nav>
	</div>
</div>


<!-- MODAL TAMBAH -->
<div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="POST" action="">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Tambah Pengguna</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<!-- ISI MODAL START HERE -->
					<div class="mb-3 row">
						<label class="col-sm-2 col-form-label">Nama</label>
						<div class="col-sm-10">
							<input name="nama_pejabat" type="text" class="form-control" require>
						</div>
					</div>
					<div class="mb-3 row">
						<label class="col-sm-2 col-form-label">NIP</label>
						<div class="col-sm-10">
							<input name="nip_pejabat" type="text" class="form-control" require>
						</div>
					</div>
					<div class="mb-3 row">
						<label class="col-sm-2 col-form-label">Jabatan</label>
						<div class="col-sm-10">
							<input name="jabatan_pejabat" type="text" class="form-control" require>
						</div>
					</div>
					<div class="mb-3 row">
						<label class="col-sm-2 col-form-label">No. HP</label>
						<div class="col-sm-10">
							<input name="hp_pejabat" type="text" class="form-control" require>
						</div>
					</div>
					<div class="mb-3 row">
						<label class="col-sm-2 col-form-label">Alamat</label>
						<div class="col-sm-10">
							<input name="alamat_pejabat" type="text" class="form-control" require>
						</div>
					</div>
					<!-- ISI MODAL END HERE -->
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Simpan</button>
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- MODAL TAMBAH -->

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
									<a href="detail.html" type="button" class="btn btn-sm btn-outline-primary">Detail</a>
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
							<!-- <p class="card-text">
                <table>
                  <tr>
                    <td>Nama</td>
                    <td class="px-1">:</td>
                    <td>Pejabat Dua, S.Sos</td>
                  </tr>
                  <tr>
                    <td>NIP</td>
                    <td class="px-1">:</td>
                    <td>98763465</td>
                  </tr>
                  <tr>
                    <td>Jabatan</td>
                    <td class="px-1">:</td>
                    <td>Supervisor</td>
                  </tr>
                </table>
                </p> -->
							<div class="d-flex justify-content-between align-items-center">
								<div class="btn-group">
									<a href="detail.html" type="button" class="btn btn-sm btn-outline-primary">Detail</a>
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
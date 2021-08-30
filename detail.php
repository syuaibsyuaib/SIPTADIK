<?php
$title = "Admin";
include("layout/header.php");
$_SESSION['role'] != 1 && $_SESSION['role'] != 3 ? header("Location: /") : "";
?>

<!-- ISINYA MULAI DI SINI -->
<div class="container">

	<div class="container my-4">
		<div class="main-body">

			<div class="row gutters-sm">
				<div class="col-md-4 mb-3">
					<div class="card">
						<div class="card-body">
							<div class="d-flex flex-column align-items-center text-center">
								<img src="./img/orang-1.jpeg" alt="Admin" class="rounded-circle" width="150">
								<div class="mt-3">
									<h4>Pejabat Satu, M.Si</h4>
									<p class="text-secondary mb-1">Supervisor Divisi 1</p>
									<p class="text-muted font-size-sm">Jl. Sam Ratulangi, No. 18, Kota Makassar</p>
								</div>
							</div>
						</div>
					</div>
					<div class="card mt-3">
						<ul class="list-group list-group-flush">
							<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
								<h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter me-2 icon-inline text-info">
										<path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z">
										</path>
									</svg>Twitter</h6>
								<span class="text-secondary">@mohpoe</span>
							</li>
							<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
								<h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-instagram me-2 icon-inline text-danger">
										<rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
										<path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
										<line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
									</svg>Instagram</h6>
								<span class="text-secondary">mohpoe</span>
							</li>
							<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
								<h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook me-2 icon-inline text-primary">
										<path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z">
										</path>
									</svg>Facebook</h6>
								<span class="text-secondary">mohpoe</span>
							</li>
						</ul>
					</div>
				</div>

				<div class="col-md-8">
					<div class="card mb-3">
						<div class="card-body">

							<div class="row">
								<div class="col-sm-3">
									<h6 class="mb-0">Nama Lengkap</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									Pejabat Satu, M.Si
								</div>
							</div>

							<hr>

							<div class="row">
								<div class="col-sm-3">
									<h6 class="mb-0">NIP</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									1234567890
								</div>
							</div>

							<hr>

							<div class="row">
								<div class="col-sm-3">
									<h6 class="mb-0">Jabatan</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									Supervisor Divisi 1
								</div>
							</div>

							<hr>

							<div class="row">
								<div class="col-sm-3">
									<h6 class="mb-0">No. Telepon</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									+62 812-3456-7890
								</div>
							</div>

							<hr>

							<div class="row">
								<div class="col-sm-3">
									<h6 class="mb-0">Alamat</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									Jl. Sam Ratulangi, No. 18, Kota Makassar
								</div>
							</div>

							<hr>

							<div class="row">
								<div class="col-sm-12">
									<a class="btn btn-info text-light" href="#" data-bs-toggle="modal" data-bs-target="#ubah">Ubah</a>
								</div>
							</div>
						</div>
					</div>
					<!-- MODAL UBAH -->
					<div class="modal fade" id="ubah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<form method="POST" action="">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Ubah Data</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>
									<div class="modal-body">
										<!-- ISI MODAL START HERE -->
										<div class="mb-3 row">
											<label class="col-sm-2 col-form-label">Nama</label>
											<div class="col-sm-10">
												<input name="nama_pejabat" type="text" class="form-control" value="Pejabat Satu, M.Si">
											</div>
										</div>
										<div class="mb-3 row">
											<label class="col-sm-2 col-form-label">NIP</label>
											<div class="col-sm-10">
												<input name="nip_pejabat" type="text" class="form-control" value="1234567890">
											</div>
										</div>
										<div class="mb-3 row">
											<label class="col-sm-2 col-form-label">Jabatan</label>
											<div class="col-sm-10">
												<input name="jabatan_pejabat" type="text" class="form-control" value="Supervisor Divisi 1">
											</div>
										</div>
										<div class="mb-3 row">
											<label class="col-sm-2 col-form-label">No. HP</label>
											<div class="col-sm-10">
												<input name="hp_pejabat" type="text" class="form-control" value="+62 812-3456-7890">
											</div>
										</div>
										<div class="mb-3 row">
											<label class="col-sm-2 col-form-label">Alamat</label>
											<div class="col-sm-10">
												<input name="alamat_pejabat" type="text" class="form-control" value="Jl. Sam Ratulangi, No. 18, Kota Makassar">
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
					<!-- MODAL UBAH -->

					<div class="row gutters-sm">
						<div class="col-sm-6 mb-3">
							<div class="card h-100">
								<div class="card-body">
									<h6 class="d-flex align-items-center mb-3">Tamu Bulan Ini</h6>
									<small>Laki-laki : Perempuan</small>
									<div class="progress mb-3" style="height: 5px">
										<div class="progress-bar bg-male" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
										<div class="progress-bar bg-famale" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
									<small>Diterima : Ditolak</small>
									<div class="progress mb-3" style="height: 5px">
										<div class="progress-bar bg-success" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
										<div class="progress-bar bg-danger" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
									<small>Total</small>
									<b>567 orang</b>
								</div>
							</div>
						</div>
						<div class="col-sm-6 mb-3">
							<div class="card h-100">
								<div class="card-body">
									<h6 class="d-flex align-items-center mb-3">Tamu Total</h6>
									<small>Laki-laki : Perempuan</small>
									<div class="progress mb-3" style="height: 5px">
										<div class="progress-bar bg-male" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
										<div class="progress-bar bg-famale" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
									<small>Diterima : Ditolak</small>
									<div class="progress mb-3" style="height: 5px">
										<div class="progress-bar bg-success" role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
										<div class="progress-bar bg-danger" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
									<small>Total</small>
									<b>2311 orang</b>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>

		</div>
	</div>

</div>
<!-- ISINYA BERAKHIR DI SINI -->

<?php
include("layout/footer.php");
?>
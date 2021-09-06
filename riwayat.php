<?php
$title = "Riwayat";
include("layout/header.php");
$_SESSION['role'] != 1 && $_SESSION['role'] != 2 ? header("Location: /") : "";
?>

<style>
	.modal-foto {
		display: block;
		width: 100%;
	}

	.thumb img {
		cursor: zoom-in;
	}
</style>

<!-- ISI MULAI -->
<div class="container">
	<h2 class="my-4">Riwayat Tamu</h2>

	<div class="container mt-3 mb-4">
		<div class="col mt-4 mt-lg-0">
			<div class="row">
				<div class="col-md-12">
					<div class="user-dashboard-info-box table-responsive mb-0 bg-white p-4 shadow-sm">
						<div class="row g-3 mb-4">
							<div class="col-auto">
								<button class="btn btn-success"><i class="bi bi-download"></i> Unduh CSV</button>
							</div>
							<div class="col-auto">
								<input class="form-control" style="width: 20%;min-width: 200px;" type="search" placeholder="Search" aria-label="Search">
							</div>
							<div class="col-auto">
								<button class="btn" data-bs-toggle="collapse" data-bs-target="#filter_cari" aria-expanded="false" aria-controls="filter_cari"><i class="bi bi-filter-square-fill" style="font-size: 1.5rem;color: #ababab"></i></button>
								<button class="btn"><i class="bi bi-arrow-right-square" style="font-size: 1.5rem;color: #ababab"></i></button>
								<button class="btn"><i class="bi bi-arrow-left-square" style="font-size: 1.5rem;color: #ababab"></i></button>
							</div>
						</div>
						<div class="collapse mb-4" id="filter_cari">
							<div class="card">
								<div class="card-body">
									<div class="col-lg-6 col-md-6 col-sm">
										<!-- ISI START -->
										<div class="mb-3 row">
											<label class="col-sm-5 col-form-label">Rentang Waktu</label>
											<div class="col-sm-7">
												sss
											</div>
										</div>
										<div class="mb-3 row">
											<label class="col-sm-5 col-form-label">Bidang Tujuan</label>
											<div class="col-sm-7">
												<select class="form-select" aria-label="Pilih Jabatna Tujuan">
													<option value="" selected></option>
													<option value="1">Jabatan One</option>
													<option value="2">Jabatan Two</option>
													<option value="3">Jabatan Three</option>
												</select>
											</div>
										</div>
										<div class="mb-3 row">
											<label class="col-sm-5 col-form-label">Sub-Bidang Tujuan</label>
											<div class="col-sm-7">
												<select class="form-select" aria-label="Pilih Jabatna Tujuan">
													<option value="" selected></option>
													<option value="1">Jabatan One</option>
													<option value="2">Jabatan Two</option>
													<option value="3">Jabatan Three</option>
												</select>
											</div>
										</div>
										<div class="mb-3 row">
											<label class="col-sm-5 col-form-label">Jabatan Tujuan</label>
											<div class="col-sm-7">
												<select class="form-select" aria-label="Pilih Jabatna Tujuan">
													<option value="" selected></option>
													<option value="1">Jabatan One</option>
													<option value="2">Jabatan Two</option>
													<option value="3">Jabatan Three</option>
												</select>
											</div>
										</div>
										<!-- ISI END -->
									</div>
									<button class="btn btn-primary">Saring</button>
								</div>
							</div>
						</div>
						<table class="table manage-candidates-top mb-0">
							<thead>
								<tr>
									<th>Tanggal</th>
									<th>Nama Tamu</th>
									<th>Instansi</th>
									<th>Bidang Tujuan</th>
									<th>Tujuan</th>
								</tr>
							</thead>
							<tbody>

								<!-- TAMU 1 START -->
								<tr class="candidates-list">
									<td>05/09/2021 06.30 PM</td>
									<td class="title">
										<div class="thumb">
											<img class="img-fluid" src="./img/tamu1.jpg" alt="" data-bs-toggle="modal" data-bs-target="#fototamu1" title="Perbesar gambar">
										</div>
										<div class="candidate-list-details">
											<div class="candidate-list-info">
												<div class="candidate-list-title">
													<h5 class="mb-0"><a href="#" data-bs-toggle="modal" data-bs-target="#tamu1">NAMA TAMU 1</a>
													</h5>
												</div>
												<div class="candidate-list-option">
													<ul class="list-unstyled">
														<li><i class="bi bi-person-badge me-1"></i>6472134516890001
														</li>
													</ul>
												</div>
											</div>
										</div>
									</td>
									<td>Instansi Tamu 1</td>
									<td>Bidang Tujuan 1</td>
									<td>Tujuan Tamu 1</td>
								</tr>
								<!-- TAMU 1 END -->
								<!-- MODAL FOTO TAMU 1 -->
								<div class="modal fade" id="fototamu1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLabel">Foto: NAMA TAMU 1</h5>
												<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
											</div>
											<div class="modal-body">
												<!-- ISI MODAL START HERE -->
												<img class="modal-foto" src="./img/tamu1.jpg" alt="">
												<!-- ISI MODAL END HERE -->
											</div>
										</div>
									</div>
								</div>
								<!-- MODAL FOTO TAMU 1 -->
								<!-- MODAL TAMU 1 -->
								<div class="modal fade" id="tamu1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-lg">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLabel">Detail Tamu 1</h5>
											</div>
											<div class="modal-body">
												<!-- ISI MODAL START HERE -->
												<div class="mb-3 row">
													<label class="col-sm-4 col-form-label">Nama</label>
													<div class="col-sm-8">
														<input type="text" readonly class="form-control-plaintext" value="Nama Tamu">
													</div>
												</div>
												<div class="mb-3 row">
													<label class="col-sm-4 col-form-label">NIK/NIP</label>
													<div class="col-sm-8">
														<input type="text" readonly class="form-control-plaintext" value="123456">
													</div>
												</div>
												<div class="mb-3 row">
													<label class="col-sm-4 col-form-label">Instansi</label>
													<div class="col-sm-8">
														<input type="text" readonly class="form-control-plaintext" value="Dinas Pendidikan Kabupaten Pinrang">
													</div>
												</div>
												<div class="mb-3 row">
													<label class="col-sm-4 col-form-label">Sub Bidang Tujuan</label>
													<div class="col-sm-8">
														<input type="text" readonly class="form-control-plaintext" value="Sub Bidang Tujuan">
													</div>
												</div>
												<div class="mb-3 row">
													<label class="col-sm-4 col-form-label">Tujuan</label>
													<div class="col-sm-8">
														<input type="text" readonly class="form-control-plaintext" value="Kunjungan Dinas">
													</div>
												</div>
												<div class="mb-3 row">
													<label class="col-sm-4 col-form-label">Status</label>
													<div class="col-sm-8">
														<input type="text" readonly class="form-control-plaintext" value="Diterima">
													</div>
												</div>
												<!-- ISI MODAL END HERE -->
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
											</div>
										</div>
									</div>
								</div>
								<!-- MODAL TAMU 1 -->

								<!-- TAMU 2 START -->
								<tr class="candidates-list">
									<td>05/09/2021 06.30 PM</td>
									<td class="title">
										<div class="thumb">
											<img class="img-fluid" src="./img/tamu2.jpg" alt="" data-bs-toggle="modal" data-bs-target="#fototamu2" title="Perbesar gambar">
										</div>
										<div class="candidate-list-details">
											<div class="candidate-list-info">
												<div class="candidate-list-title">
													<h5 class="mb-0"><a href="#" data-bs-toggle="modal" data-bs-target="#tamu2">NAMA TAMU 2</a>
													</h5>
												</div>
												<div class="candidate-list-option">
													<ul class="list-unstyled">
														<li><i class="bi bi-person-badge me-1"></i>6472134516890001
														</li>
													</ul>
												</div>
											</div>
										</div>
									</td>
									<td>Instansi Tamu 2</td>
									<td>Bidang Tujuan Tamu 2</td>
									<td>Tujuan Tamu 2</td>
								</tr>
								<!-- TAMU 2 END -->
								<!-- MODAL FOTO TAMU 2 -->
								<div class="modal fade" id="fototamu2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLabel">Foto: NAMA TAMU 1</h5>
												<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
											</div>
											<div class="modal-body">
												<!-- ISI MODAL START HERE -->
												<img class="modal-foto" src="./img/tamu2.jpg" alt="">
												<!-- ISI MODAL END HERE -->
											</div>
										</div>
									</div>
								</div>
								<!-- MODAL FOTO TAMU 2 -->
								<!-- MODAL TAMU 2 -->
								<div class="modal fade" id="tamu2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-lg">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLabel">Detail Tamu 2</h5>
											</div>
											<div class="modal-body">
												<!-- ISI MODAL START HERE -->
												<div class="mb-3 row">
													<label class="col-sm-4 col-form-label">Nama</label>
													<div class="col-sm-8">
														<input type="text" readonly class="form-control-plaintext" value="Nama Tamu">
													</div>
												</div>
												<div class="mb-3 row">
													<label class="col-sm-4 col-form-label">NIK/NIP</label>
													<div class="col-sm-8">
														<input type="text" readonly class="form-control-plaintext" value="98767654">
													</div>
												</div>
												<div class="mb-3 row">
													<label class="col-sm-4 col-form-label">Instansi</label>
													<div class="col-sm-8">
														<input type="text" readonly class="form-control-plaintext" value="Pemkab Pinrang">
													</div>
												</div>
												<div class="mb-3 row">
													<label class="col-sm-4 col-form-label">Sub Bidang Tujuan</label>
													<div class="col-sm-8">
														<input type="text" readonly class="form-control-plaintext" value="Sub Bidang Tujuan">
													</div>
												</div>
												<div class="mb-3 row">
													<label class="col-sm-4 col-form-label">Tujuan</label>
													<div class="col-sm-8">
														<input type="text" readonly class="form-control-plaintext" value="Kunjungan Dinas">
													</div>
												</div>
												<div class="mb-3 row">
													<label class="col-sm-4 col-form-label">Status</label>
													<div class="col-sm-8">
														<input type="text" readonly class="form-control-plaintext" value="Ditolak">
													</div>
												</div>
												<!-- ISI MODAL END HERE -->
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
											</div>
										</div>
									</div>
								</div>
								<!-- MODAL TAMU 2 -->

							</tbody>
						</table>

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
<!-- ISI SELESAI -->

<?php
include("layout/footer.php");
?>
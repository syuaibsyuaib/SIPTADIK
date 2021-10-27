<?php
$title = "Admin";
include("layout/header.php");
$_SESSION['role'] != 1 ? pindahko("/") : "";
$data = $_SESSION['data']['dataPjb'];
$dataBidang = $_SESSION['data']['dataBidang'];
$dataUser = $_SESSION['data']['dataUser'];
$slide = $_SESSION['data']['slide'][0];

// foreach ($dataBidang as $isi) {
// 	print_r($isi);
// }
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

?>

<!-- MODAL SLIDER -->
<div class="modal fade" id="slider_edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<form class="m-0 p-0" id="formSlider">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Pengaturan Gambar Slider</h5>
				</div>
				<!-- ISI MODAL START HERE -->
				<div class="modal-body">
					<div class="px-3 text-center">

						<!-- THUMBNAIL VIEWER -->
						<div class="mb-1 row d-block text-center coba">
							<?php
							$n = 1;
							foreach ($slide as $value) {
								$val = $value <> "" ? $value : "img/slide-none.jpg";
							?>
								<div class="col-sm-2 d-inline-block rounded p-0">
									<img class="align-top" src="<?= $val ?>" alt="Gambar Slider">
								</div>
							<?php
								$n++;
							}
							?>
						</div>
						<div class="row d-block text-center">
							<div class="col-sm-2 d-inline-block">
								<input class="form-control d-none" type="file" name="slider_1" id="slider_1" value="" accept="image/*">
								<label for="slider_1" class="btn btn-sm btn-primary">Ganti</label>
							</div>
							<div class="col-sm-2 d-inline-block">
								<input class="form-control d-none" type="file" name="slider_2" id="slider_2" value="" accept="image/*">
								<label for="slider_2" class="btn btn-sm btn-primary">Ganti</label>
							</div>
							<div class="col-sm-2 d-inline-block">
								<input class="form-control d-none" type="file" name="slider_3" id="slider_3" value="" accept="image/*">
								<label for="slider_3" class="btn btn-sm btn-primary">Ganti</label>
							</div>
							<div class="col-sm-2 d-inline-block">
								<input class="form-control d-none" type="file" name="slider_4" id="slider_4" value="" accept="image/*">
								<label for="slider_4" class="btn btn-sm btn-primary">Ganti</label>
							</div>
							<div class="col-sm-2 d-inline-block">
								<input class="form-control d-none" type="file" name="slider_5" id="slider_5" value="" accept="image/*">
								<label for="slider_5" class="btn btn-sm btn-primary">Ganti</label>
							</div>
						</div>
						<i class="text-muted mt-3 d-block">Recommended image ratio: 1625 x 900 pixel (65:36)</i>

					</div>
				</div>
				<!-- ISI MODAL END HERE -->
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary" name="ubahSlide" disabled>Simpan</button>
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- MODAL TAMBAH PEJABAT -->
<div class="modal fade" id="modalTambahPejabat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<form class="m-0 p-0" id="formTambahPejabat">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel"><i class="bi bi-person-plus-fill"></i> Tambah Pejabat</h5>
				</div>
				<div class="modal-body">
					<!-- ISI MODAL START HERE -->

					<div class="row px-4">

						<div class="col-6 mb-3">
							<div class="form-group">
								<label class="required-field mb-1" for="pengguna_pjb"><i>Username</i></label>
								<input name="username" id="pengguna_pjb" type="text" class="form-control" placeholder="Nama pengguna" required>
								<div class="mt-1">
									<small class="text-danger"><i>Hanya huruf kecil dan angka, diawali dengan huruf</i></small>
								</div>
							</div>
						</div>

						<div class="col-6 mb-3">
							<div class="form-group">
								<label class="required-field mb-1" for="pass_pjb_1"><i>Password</i></label>
								<input name="password" id="pass_pjb_1" type="password" class="form-control pass" placeholder="Kata Sandi" required>
								<div class="mt-1">
									<small class="text-danger"><i>Disarankan paduan huruf, angka dan/atau simbol</i></small>
								</div>
							</div>
						</div>

						<div class="col-6 mb-3">
							<div class="form-group">
								<label class="required-field mb-1" for="nama_pjb">Nama Lengkap</label>
								<input name="nama" id="nama_pjb" type="text" class="form-control" placeholder="Nama Lengkap" required>
							</div>
						</div>
						<div class="col-6 mb-3">
							<div class="form-group">
								<label class="required-field mb-1" for="nip_pjb">NIP / NIK</label>
								<input name="nip" id="nip_pjb" type="text" class="form-control" placeholder="NIP/NIK" required>
							</div>
						</div>

						<div class="col-12 mb-3">
							<div class="form-group">
								<label class="required-field mb-1" for="foto_pjb">Foto Profil</label>
								<input name="foto" id="foto_pjb" type="file" class="form-control" accept=".png,.jpg,.jpeg" required>
								<div class="mt-1">
									<small class="text-danger">
										<i>Disarankan rasio 1:1 (persegi)</i>
									</small>
								</div>
							</div>
						</div>

						<div class="col-6 mb-3">
							<div class="form-group">
								<label class="mb-1" for="hp_pjb">Nomor HP</label>
								<input name="nohp" id="hp_pjb" type="text" class="form-control" placeholder="Nomor Handphone" required>
							</div>
						</div>
						<div class="col-6 mb-3">
							<div class="form-group">
								<label class="mb-1" for="alamat_pjb">Alamat</label>
								<input name="alamat" id="alamat_pjb" type="text" class="form-control" placeholder="Alamat Lengkap" required>
							</div>
						</div>

						<div class="col-12 mb-3">
							<div class="form-group">
								<label class="required-field mb-1" for="bid">Bidang</label>
								<select id="bid" class="form-select" name="bidang" required>
									<option value="" selected></option>
									<?php foreach ($dataBidang as $val) { ?>
										<option value="<?= $val[0] ?>"><?= $val[1] ?></option>
									<?php } ?>
								</select>
							</div>
						</div>

						<div class="col-12 mb-3">
							<div class="form-group">
								<label class="required-field mb-1" for="subbid">Sub-Bidang</label>
								<select id="subbid" class="form-select" name="subbidang" readonly>
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

						<div class="col-12 mb-3">
							<div class="form-group">
								<label class="required-field mb-1" for="jabat">Jabatan</label>
								<select id="jabat" class="form-select" name="jabatan" readonly required>
									<option value="" selected></option>
									<option value="j3">PENGELOLA</option>
									<option value="j5">STAF</option>
								</select>
							</div>
						</div>

					</div>
					<!-- ISI MODAL END HERE -->
				</div>
				<div class="modal-footer">
					<button type="submit" name="tambahPejabat" class="btn btn-primary">Simpan</button>
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
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
					<h5 class="modal-title" id="exampleModalLabel"><i class="bi bi-person-plus-fill"></i> Tambah Piket</h5>
				</div>
				<div class="modal-body">
					<!-- ISI MODAL START HERE -->
					<div class="px-4">
						<table class="table td-vmiddle">
							<thead>
								<tr>
									<th width="5%">#</th>
									<th width="20%"><i>Username</i></th>
									<th width="20%"><i>Password</i> <i>(Hanya Edit)</i></th>
									<th width="10%">Foto</th>
									<th width="15%">Register</th>
									<th width="10%">ANJAB</th>
									<th width="20%">Pilihan</th>
								</tr>
							</thead>
							<tbody>

								<?php
								$num = 0;
								$piketArr;
								$piketArrPassKosong;
								foreach ($dataUser as $value) {
									if ($value[0] != "" && $value[2] == 2) {
										$piketArr['username' . $num] = $value[0];
										$piketArr['pass' . $num] = $value[1];
										$piketArrPassKosong['username' . $num] = $value[0];
										$piketArrPassKosong['pass' . $num] = "";
										$num++;
								?>

										<tr class="barisCurrentPiket">
											<th><?= $num ?></th>
											<td>
												<input name="username<?= $num - 1 ?>" type="text" class="form-control piket_u_current" value="<?= $value[0] ?>" readonly>
											</td>
											<td>
												<input name="pass<?= $num - 1 ?>" type="password" class="form-control piket_p_current" value="<?= $value[1] ?>" readonly placeholder="Kata sandi">
											</td>
											<td>
												<label for="piket_foto">
													<span class="btn btn-sm btn-secondary">Foto</span>
												</label>
												<input type="file" name="piket_foto" id="piket_foto" class="form-control d-none" accept=".png,.jpg,.jpeg" required>
											</td>
											<td><input type="text" name="piket_register" id="piket_register" class="form-control" required></td>
											<td><input type="text" name="piket_anjab" id="piket_anjab" class="form-control" required></td>
											<td>
												<button class="btn btn-primary piket_btn_edit" type="button">
													<i class="bi bi-pencil-square ikon_piket_btn_current"></i>
												</button>
												<button type="button" class="btn btn-danger piket_btn_hapus">
													<i class="bi bi-trash"></i>
												</button>
											</td>
										</tr>
								<?php
									}
								}
								echo '<script> localStorage.setItem("listPiket", JSON.stringify(' . json_encode($piketArr) . '))</script>';
								echo '<script> localStorage.setItem("listPiketPassKosong", JSON.stringify(' . json_encode($piketArrPassKosong) . '))</script>';
								?>

								<tr id="rowInputTambahPiket">
									<td>Tambah</td>
									<!-- name="tambah_username_piket"     name="tambah_password_piket"-->
									<td colspan="2"><input id='tambahUsernamePiket' type="text" class="form-control" placeholder="Username"></td>
									<td colspan="2"><input id='tambahPasswordPiket' type="text" class="form-control" placeholder="Password"></td>
									<td colspan="2">
										<button id="tblTambahPiket" type="button" class="col-5 btn btn-success tambahInput" disabled><i class="bi bi-plus-lg"></i></button>
									</td>
								</tr>

							</tbody>
						</table>
					</div>
					<!-- ISI MODAL END HERE -->
				</div>
				<div class="modal-footer">
					<button type="submit" name="tambahPiket" class="btn btn-primary" disabled>Simpan</button>
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- MODAL BIDANG -->
<div class="modal fade" id="modal_bidang_edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<form class="m-0 p-0" id="formTambahBidang">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel"><i class="bi bi-tools" style="font-size:1rem;"></i> Pengaturan Bidang</h5>
				</div>
				<!-- ISI MODAL START HERE -->
				<div class="modal-body px-4">
					<table class="table td-vmiddle">
						<thead>
							<tr>
								<th width="10%">#</th>
								<th width="70%">Nama Bidang</th>
								<th width="30%">Pilihan</th>
							</tr>
						</thead>
						<tbody>

							<?php
							$num = 0;
							foreach ($dataBidang as $value) {
								if ($value[0] != "") {
									$num++;
							?>

									<tr class="row_input_bidang">
										<th><?= $num ?></th>
										<td>
											<input type="text" class="form-control inputCurrentBidang" required value="<?= $value[1] ?>" readonly>
										</td>
										<td>
											<button class="btn btn-primary btnEditBidang" type="button">
												<i class="bi bi-pencil-square ikon_tombol_e_bidang"></i>
											</button>
											<button type="button" class="btn btn-danger btnHapusBidang"><i class="bi bi-trash"></i></button>
										</td>
									</tr>
							<?php
								}
							}
							?>

							<tr>
								<td>Tambah</td>
								<td><input id="inputTambahBidang" type="text" class="form-control"></td>
								<td>
									<button id="tblTambahBidang" type="button" class="col-5 btn btn-success" disabled><i class="bi bi-plus-lg"></i></button>
								</td>
							</tr>

						</tbody>
					</table>
				</div>
				<!-- ISI MODAL END HERE -->
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Simpan</button>
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- MODAL SUBBIDANG -->
<div class="modal fade" id="modal_subbidang_edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<form class="m-0 p-0" id="formTambahSubbidang">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel"><i class="bi bi-tools" style="font-size:1rem;"></i> Pengaturan Sub-Bidang</h5>
				</div>
				<!-- ISI MODAL START HERE -->
				<div class="modal-body px-4">
					<table class="table td-vmiddle">
						<thead>
							<tr>
								<th width="7%">#</th>
								<th colspan="2" width="80%">
									<select class="form-select" id="selectBidangSubbidang">

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
								</th>
							</tr>
						</thead>
						<tbody>

							<?php
							/*$num = 0;
							foreach ($dataBidang as $value) {
								if ($value[2] != '') {
									$num++;
									$id = $value[2];
							?>
									<tr class="row_input_subbidang">
										<th><?= $num ?></th>
										<td>
											<input type="hidden" class="currentKodeSubbidang" value="<?= $value[2] ?>">
											<input type="text" class="form-control inputCurrentSubbidang" required value="<?= $value[3] ?>" readonly>
										</td>
										<td>
											<button class="btn btn-primary btnEditSubbidang" type="button">
												<i class="bi bi-pencil-square ikon_tombol_e_subbidang"></i>
											</button>
											<button type="button" class="btn btn-danger btnHapusSubbidang"><i class="bi bi-trash"></i></button>
										</td>
									</tr>

							<?php
								}
							}*/
							?>

							<tr>
								<th>Tambah</th>
								<td width="60%">
									<input id="inputTambahSubbidang" type="text" class="form-control">
								</td>
								<td>
									<button id="tblTambahSubbidang" type="button" class="col-5 btn btn-success" disabled><i class="bi bi-plus-lg"></i></button>
								</td>
							</tr>

						</tbody>
					</table>
				</div>
				<!-- ISI MODAL END HERE -->
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Simpan</button>
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- MODAL JABATAN -->
<div class="modal fade" id="modal_jabatan_edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<form class="m-0 p-0" id="formTambahJabatan">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel"><i class="bi bi-tools" style="font-size:1rem;"></i> Pengaturan Jabatan</h5>
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
							$jabatanArr;
							// $jabatanArrKosong;
							foreach ($dataBidang as $value) {
								// print_r($value);
								if ($value[4] != '' && $value[4] != 'kd' && $value[4] != 'sd') {
									$num++;
									$id_j = $value[4];
									$nama_j = $value[5];
									$jabatanArr[$id_j] = $nama_j;
									// $jabatanArrKosong[$id_j] = "";
							?>

									<tr class="row_input_jabatan">
										<th><?= $num ?></th>
										<td>
											<input name="<?= $id_j ?>" type="text" class="form-control inputCurrentJabatan" value="<?= $nama_j ?>" required readonly>
										</td>
										<td>
											<button type="button" class="btn btn-primary col-5 btnEditJabatan">
												<i class="bi bi-pencil-square ikon_tombol_e_jabatan"></i>
											</button>
											<button type="button" class="btn btn-danger col-5 btnHapusJabatan"><i class="bi bi-trash"></i></button>
										</td>
									</tr>

							<?php
								}
							}
							echo '<script> localStorage.setItem("listJabatan", JSON.stringify(' . json_encode($jabatanArr) . '))</script>';
							// echo '<script> localStorage.setItem("listJabatanKosong", JSON.stringify(' . json_encode($jabatanArrKosong) . '))</script>';
							?>

							<tr id="rowInputTambahJabatan">
								<th>Tambah</th>
								<td><input id="inputTambahJabatan" type="text" class="form-control"></td>
								<td>
									<button id="tblTambahJabatan" type="button" class="col-5 btn btn-success" disabled><i class="bi bi-plus-lg"></i></button>
								</td>
							</tr>

						</tbody>
					</table>
				</div>
				<!-- ISI MODAL END HERE -->
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Simpan</button>
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- MAIN CONTENT -->
<main id="admin-page">
	<div class="pt-4 pb-3">

		<!-- DAFTAR PEJABAT -->
		<div class="container-sm pb-3">
			<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3" id="myList">

				<?php
				foreach ($data as $value) {
					$id = encrypt_decrypt("e", $value[0]);
					$jab = convert_bidang($value[2]);
					$subbid = convert_bidang($value[1]);
					// print_r($value[1]);
					preg_match('/b\d+/', $value[1], $arrBid);
					array_push($arrBid, "");
					// print_r($arrBid);
					$bid = convert_bidang($arrBid[0]);

				?>

					<div class="col">
						<div class="card shadow-sm">

							<!-- JABATAN -->
							<div class="card-header warna-dasar">
								<?= "<span>$jab $subbid </span>" ?>
							</div>

							<!-- FOTO -->
							<div class="tunggu" style="cursor:zoom-in;height: 310px; overflow: hidden; background-image:url('<?= $value[7] != "" ? $value[7] : "img/p.webp" ?>'); background-size:cover;background-position: center center" data-bs-toggle="modal" data-bs-target="#foto_<?= $value[0] ?>">
								<!-- <img style="cursor:zoom-in; width: 100%;background-size: fill" src="<?= $value[7] != "" ? $value[7] : "img/p.webp" ?>" data-bs-toggle="modal" data-bs-target="#foto_<?= $value[0] ?>"> -->
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
											<?= "<div class='text-center mb-3 warna-dasar'>$jab $bid $subbid</div>" ?>
											<img class="modal-foto" src="<?= $value[7] != "" ? $value[7] : "img/p.webp" ?>" alt="">
											<!-- ISI MODAL END HERE -->
										</div>
									</div>
								</div>
							</div>

							<!-- CARD BODY -->
							<div class="card-body">
								<!-- NAMA -->
								<p class="card-text">
									<?= $value[3] ?>
									<!-- <?= $value[2] ?> -->
								</p>
								<!-- TOMBOL -->
								<div class="d-flex justify-content-between align-items-center">
									<div class="btn-group">
										<a href="detail.php?id=<?= $id ?>" type="button" class="btn btn-sm btn-outline-primary">Detail</a>
										<a class="d-none" href="detail.php?id=<?= $value[0] ?>"></a>
										<a href="#" type="button" class="btn btn-sm btn-outline-danger hapus">Hapus</a>
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

		<!-- PAGINATION -->
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

	</div>
</main>

<script>
	//$('img')[1].src = URL.createObjectURL($('input:file')[0].files[0])


	/*
	let scriptCurrentPiket = function(noUrut, usernamePiket, passPiket) {
		return `<tr class="barisCurrentPiket">
					<th>${noUrut}</th>
						<td>
							<input name="piket_u_${usernamePiket}" type="text" class="form-control piket_u_current" required value="${usernamePiket}" readonly="readonly">
						</td>
						<td>
							<input name="piket_p_${usernamePiket}" type="password" class="form-control piket_p_current"  value="${passPiket}" required readonly="readonly" placeholder="Kata sandi">
						</td>
						<td>
							<button class="btn btn-primary piket_btn_edit" type="button">
								<i class="bi bi-pencil-square ikon_piket_btn_current"></i>
							</button>
							<button class="btn btn-danger piket_btn_hapus" type="button">
								<i class="bi bi-trash"></i>
							</button>
						</td>
				</tr>`
	}
	*/
	let scriptCurrentBidang = function(noUrut, valueBidang) {
		return `<tr class="row_input_bidang">
					<th>${noUrut}</th>
					<td>
						<input type="text" class="form-control inputCurrentBidang"  value="${valueBidang}" required readonly>
					</td>
					<td>
						<button class="btn btn-primary btnEditBidang" type="button">
							<i class="bi bi-pencil-square ikon_tombol_e_bidang"></i>
						</button>
						<button type="button" class="btn btn-danger btnHapusBidang"><i class="bi bi-trash"></i></button>
					</td>
				</tr>`
	}
	let scriptCurrentSubbidang = function(noUrut, kodeSubbidang, namaSubbidang) {
		return `<tr class="row_input_subbidang">
                <th>${noUrut}</th>
                <td>
					<input type="hidden" class="currentKodeSubbidang" value="${kodeSubbidang}">
                    <input type="text" class="form-control inputCurrentSubbidang" value="${namaSubbidang}" required readonly>
                </td>
                <td>
                    <button class="btn btn-primary btnEditSubbidang" type="button">
                        <i class="bi bi-pencil-square ikon_tombol_e_subbidang"></i>
                    </button>
                    <button type="button" class="btn btn-danger btnHapusSubbidang"><i class="bi bi-trash"></i></button>
                </td>
            </tr>`
	}
	let scriptCurrentJabatan = function(noUrut, valueJabatan) {
		return `<tr class="row_input_jabatan">
					<th>${noUrut}</th>
					<td>
						<input type="text" class="form-control inputCurrentJabatan" value="${valueJabatan}" required readonly>
					</td>
					<td>
						<button class="btn btn-primary col-5 btnEditJabatan" type="button">
							<i class="bi bi-pencil-square ikon_tombol_e_jabatan"></i>
						</button>
						<button class="btn btn-danger col-5 btnHapusJabatan"><i class="bi bi-trash"></i></button>
					</td>
				</tr>`
	}

	function hapusRow(classBtnHapus, classRowCurrent) {
		for (let i = 0; i < $(classBtnHapus).length; i++) {
			$(classBtnHapus)[i].onclick = function(e) {
				warning("Hapus", "Yakin akan menghapus data tersebut?", function() {
					$(classRowCurrent).eq(i).prop('hidden', true);
					$(classRowCurrent + ':hidden input').prop('disabled', true);
					// $(classRowCurrent).eq(i).remove();
					$(classRowCurrent).parents("form").children().eq(2).children("button:submit").prop("disabled", false);
					hapusRow(classBtnHapus, classRowCurrent)
				})
			}
		}
	}

	// TAMBAH BIDANG
	function templateUbahBidang(index, valueBidang) {
		return `<tr class="row_input_bidang">
					<th>${index}</th>
					<td>
						<input name="namaBidang${index}" type="text" class="form-control inputCurrentBidang" required="" value="${valueBidang}" readonly>
					</td>
					<td>
						<button class="btn btn-primary btnEditBidang" type="button">
							<i class="bi bi-pencil-square ikon_tombol_e_bidang"></i>
						</button>
						<button type="button" class="btn btn-danger btnHapusBidang"><i class="bi bi-trash"></i></button>
					</td>
				</tr>`
	}

	function ulangi_bidang_btn_edit() {
		for (let i = 0; i < $(".btnEditBidang").length; i++) {
			$(".btnEditBidang")[i].onclick = function(e) {
				$('.inputCurrentBidang').eq(i).attr('readonly', function(index, attr) {
					return attr == 'readonly' ? null : 'readonly';
				});

				$('.ikon_tombol_e_bidang').eq(i).attr('class', function(index, attr) {
					return attr == 'bi bi-pencil-square ikon_tombol_e_bidang' ? 'bi bi-check-lg ikon_tombol_e_bidang' : 'bi bi-pencil-square ikon_tombol_e_bidang';

				});
				$('.btnEditBidang').eq(i).attr('class', function(index, attr) {
					return attr == 'btn btn-primary btnEditBidang' ? 'btn btn-success btnEditBidang' : 'btn btn-primary btnEditBidang';
				});
				ulangi_bidang_btn_edit()
			};
		}
	}
	ulangi_bidang_btn_edit();

	hapusRow('.btnHapusBidang', '.row_input_bidang');
	$('#formTambahBidang button:submit').prop('disabled', true);

	$('#inputTambahBidang').keyup(function(e) {
		if ($('#inputTambahBidang').val() !== "") {
			$('#tblTambahBidang').prop('disabled', false);
		} else {
			$('#tblTambahBidang').prop('disabled', true);
		}
	})

	$('#tblTambahBidang').on('click', function(e) {
		if ($('#inputTambahBidang').val() == "") {
			$('#tblTambahBidang').prop('disabled', true)
			return;
		}
		let trigger = true;
		$('#formTambahBidang .inputCurrentBidang').filter(function(index, item, arr) {
			if ($('#inputTambahBidang').val() == $(item).val()) {
				trigger = false
			}
		})

		if (trigger) {
			$('#formTambahBidang tr').last().before(scriptCurrentBidang($('#formTambahBidang tr').length - 1, $('#inputTambahBidang').val()))
			$('#inputTambahBidang').val("");
			$('#formTambahBidang button:submit').prop('disabled', false);
			$('#tblTambahBidang').prop('disabled', true)
			ulangi_bidang_btn_edit()
			hapusRow('.btnHapusBidang', '.row_input_bidang');
		} else {
			notif('Bidang sudah ada');
			$('#inputTambahBidang').val("");
		}
	})

	$('#formTambahBidang').submit(function(e) {
		// alert('tes')
		let bidangData = new URLSearchParams('tambahBidang=')
		$('#formTambahBidang .inputCurrentBidang').filter((index, item, arr) => {
			bidangData.append(`namaBidang${index}`, `${$(item).val()}`);
		});
		tanya_simpan('Ubah Bidang', 'Yakin akan mengubah bidang ini?', bidangData);
		e.preventDefault()
	});

	// TAMBAH SUBBIDANG
	let indexBidangSubbidang = $('#selectBidangSubbidang').val()
	let arrSubbidangFilter = []
	let arraySubbidang = []
	let tempTrigger = 0
	let prevSelect = ""

	<?php foreach ($dataBidang as $nilai) {
		if ($nilai[2] <> "") { ?>
			arraySubbidang.push({
				"kode": "<?= $nilai[2] ?>",
				"nama": "<?= $nilai[3] ?>"
			});
	<?php }
	} ?>

	function filterSubbidang(e = 0) {
		// indexBidangSubbidang = $('#selectBidangSubbidang option:selected').index();
		if (e === 1) {
			notif("Belum menyimpan data!")
			$('#selectBidangSubbidang').val(prevSelect)
			return
		}
		indexBidangSubbidang = $('#selectBidangSubbidang').val();
		arrSubbidangFilter = []
		$(".row_input_subbidang").remove();
		for (let i = 0; i < arraySubbidang.length; i++) {
			if (arraySubbidang[i].kode.substr(0, 2) == indexBidangSubbidang) {
				arrSubbidangFilter.push({
					"kode": arraySubbidang[i].kode,
					"nama": arraySubbidang[i].nama
				})
				$('#formTambahSubbidang tr').last().before(scriptCurrentSubbidang(i + 1, arraySubbidang[i].kode, arraySubbidang[i].nama))
				ulangi_subbidang_btn_edit()
			}
		}
	}
	filterSubbidang()

	function ulangi_subbidang_btn_edit() {
		for (let i = 0; i < $(".btnEditSubbidang").length; i++) {
			$(".btnEditSubbidang")[i].onclick = function(e) {
				$('.inputCurrentSubbidang').eq(i).attr('readonly', function(index, attr) {
					return attr == 'readonly' ? null : 'readonly';
				});

				$('.ikon_tombol_e_subbidang').eq(i).attr('class', function(index, attr) {
					return attr == 'bi bi-pencil-square ikon_tombol_e_subbidang' ? 'bi bi-check-lg ikon_tombol_e_subbidang' : 'bi bi-pencil-square ikon_tombol_e_subbidang';

				});
				$('.btnEditSubbidang').eq(i).attr('class', function(index, attr) {
					return attr == 'btn btn-primary btnEditSubbidang' ? 'btn btn-success btnEditSubbidang' : 'btn btn-primary btnEditSubbidang';
				});
				ulangi_subbidang_btn_edit()
			};
		}
	}
	ulangi_subbidang_btn_edit()

	$('#selectBidangSubbidang').on('focus', function() {
		prevSelect = this.value
	}).change(function() {
		filterSubbidang(tempTrigger)
	})

	hapusRow('.btnHapusSubbidang', '.row_input_subbidang');

	$('#inputTambahSubbidang').keydown(function() {
		$('#tblTambahSubbidang').prop('disabled', false)
	})

	$('.inputCurrentSubbidang').change(function() {
		tempTrigger = 1
	})

	$('#tblTambahSubbidang').on('click', function(e) {
		if ($('#inputTambahSubbidang').val() == "") {
			$('#tblTambahSubbidang').prop('disabled', true)
			return;
		}
		let trigger = true;
		$('#formTambahSubbidang .inputCurrentSubbidang').filter(function(index, item, arr) {
			if ($('#inputTambahSubbidang').val() == $(item).val()) {
				trigger = false
			}
		})

		if (trigger) {
			let kodePrev = arrSubbidangFilter.length > 0 ? arrSubbidangFilter.at(-1).kode.substr(0, 3) + ($('#formTambahSubbidang .btnEditSubbidang').length + 1) : `${indexBidangSubbidang}s1`;
			$('#formTambahSubbidang tr').last().before(scriptCurrentSubbidang($('#formTambahSubbidang tr').length - 1, kodePrev, $('#inputTambahSubbidang').val()))
			$('#inputTambahSubbidang').val("");
			$('#formTambahSubbidang button:submit').prop('disabled', false);
			$('#tblTambahSubbidang').prop('disabled', true)
			ulangi_subbidang_btn_edit()
			hapusRow('.btnHapusSubbidang', '.row_input_subbidang')
			tempTrigger = 1
		} else {
			notif('Bidang sudah ada');
			$('#inputTambahSubbidang').val("");
		}
	})

	$('#formTambahSubbidang').submit(function(e) {
		// alert('tes')
		let subbidangData = new URLSearchParams('tambahSubbidang=')

		$('#formTambahSubbidang .currentKodeSubbidang').filter((index, item, arr) => {
			subbidangData.append(`kodeSubbidang${index}`, `${$(item).val()}`);
		});

		$('#formTambahSubbidang .inputCurrentSubbidang').filter((index, item, arr) => {
			subbidangData.append(`namaSubbidang${index}`, `${$(item).val()}`);
		});

		tempTrigger = 0
		// for (let hadi of subbidangData.values()) {
		// 	console.log(hadi);
		// }
		tanya_simpan('Tambah Subbidang', 'Yakin akan menambahkan Subbidang ini?', subbidangData);
		e.preventDefault()
	});

	// TAMBAH JABATAN
	let modalJabatan = $('#modal_jabatan_edit')[0];

	function templateRowJabatan(index, value) {
		return `<tr class="row_input_jabatan">
					<th>${index + 1}</th>
					<td>
						<input name="j${index}" type="text" class="form-control inputCurrentJabatan" value="${value}" required readonly>
					</td>
					<td>
						<button type="button" class="btn btn-primary col-5 btnEditJabatan" >
							<i class="bi bi-pencil-square ikon_tombol_e_jabatan"></i>
						</button>
						<button type="button" class="btn btn-danger col-5 btnHapusJabatan">
							<i class="bi bi-trash"></i>
						</button>
					</td>
				</tr>`;
	}

	modalJabatan.addEventListener('shown.bs.modal', function() {
		$('#formTambahJabatan button:submit').prop('disabled', true);
		let listJabatan = JSON.parse(localStorage.getItem('listJabatan'));
		$('.row_input_jabatan').remove();
		let lengthJabatanStorage = Object.keys(listJabatan).length;
		for (let i = 0; i < lengthJabatanStorage; i++) {
			$('#rowInputTambahJabatan').before(templateRowJabatan(i, listJabatan[`j${i}`]))
		}
		ulangi_jabatan_btn_edit()
		hapusRow('.btnHapusJabatan', '.row_input_jabatan');
	})

	function ulangi_jabatan_btn_edit() {
		for (let i = 0; i < $(".btnEditJabatan").length; i++) {
			$(".btnEditJabatan")[i].onclick = function(e) {
				$('.inputCurrentJabatan').eq(i).attr('readonly', function(index, attr) {
					return attr == 'readonly' ? null : 'readonly';
				});

				$('.ikon_tombol_e_jabatan').eq(i).attr('class', function(index, attr) {
					return attr == 'bi bi-pencil-square ikon_tombol_e_jabatan' ? 'bi bi-check-lg ikon_tombol_e_jabatan' : 'bi bi-pencil-square ikon_tombol_e_jabatan';

				});
				$('.btnEditJabatan').eq(i).attr('class', function(index, attr) {
					return attr == 'btn btn-primary col-5 btnEditJabatan' ? 'btn btn-success col-5 btnEditJabatan' : 'btn btn-primary col-5 btnEditJabatan';
				});
				ulangi_jabatan_btn_edit()
			};
		}
	}


	hapusRow('.btnHapusJabatan', '.row_input_jabatan');

	$('#inputTambahJabatan').keyup(function() {
		if ($('#inputTambahJabatan').val() !== "") {
			$('#tblTambahJabatan').prop('disabled', false)
		} else {
			$('#tblTambahJabatan').prop('disabled', true)
		}
	})

	$('#tblTambahJabatan').on('click', function(e) {
		let trigger = true;
		// if ($('#inputTambahJabatan').val() == "") {
		// 	$('#tblTambahJabatan').prop('disabled', true)
		// 	return;
		// }

		$('#formTambahJabatan .inputCurrentJabatan').filter(function(index, item, arr) {
			if ($('#inputTambahJabatan').val() == $(item).val()) {
				trigger = false
			}
		})

		if (trigger) {
			$('#formTambahJabatan tr').last().before(scriptCurrentJabatan($('#formTambahJabatan tr').length - 1, $('#inputTambahJabatan').val()))
			$('#inputTambahJabatan').val("");
			$('#formTambahJabatan button:submit').prop('disabled', false);
			$('#tblTambahJabatan').prop('disabled', true)
			ulangi_jabatan_btn_edit()
			hapusRow('.btnHapusJabatan', '.row_input_jabatan');
		} else {
			notif('Jabatan sudah ada');
			$('#inputTambahJabatan').val("");
		}
		$('#tblTambahJabatan').prop('disabled', true)
	})

	$('#formTambahJabatan').submit(function(e) {
		// let listJabatanKosong = JSON.parse(localStorage.getItem('listJabatanKosong'));

		let dataJabatan = new URLSearchParams('tambahJabatan=')
		// let jsonJabatanModal = Object.fromEntries(new FormData($('#formTambahJabatan')[0])); //json dgn key dari name form

		// const mergedObject = {
		// 	...listJabatanKosong,
		// 	...jsonJabatanModal
		// };

		// let dataJabatan = new URLSearchParams(jsonJabatanModal)
		$('.inputCurrentJabatan:not([disabled])').filter((index, item, arr) => {
			dataJabatan.append(`j${index}`, `${$(item).val()}`);
		});

		// for (var hadi of jabatanData.values()) {
		// 	console.log(hadi);
		// }
		console.log(dataJabatan)
		dataJabatan.set('tambahJabatan', "");
		tanya_simpan('Tambah Bidang', 'Yakin akan menambahkan jabatan ini?', dataJabatan.toString());
		e.preventDefault()
	});

	// TAMBAH PIKET
	let modalPiket = $('#modal_tambah_piket')[0];

	// function templatePiket(index, valueUser, valuePass) {
	// 	return `<tr class="barisCurrentPiket">
	// 				<th>${index}</th>
	// 				<td>
	// 					<input name="username${index}" type="text" class="form-control piket_u_current" value="${valueUser}" readonly>
	// 				</td>
	// 				<td>
	// 					<input name="pass${index}" type="password" class="form-control piket_p_current" value="${valuePass}" readonly placeholder="Kata sandi">
	// 				</td>
	// 				<td>
	// 					<button class="btn btn-primary piket_btn_edit" type="button">
	// 						<i class="bi bi-pencil-square ikon_piket_btn_current"></i>
	// 					</button>
	// 					<button type="button" class="btn btn-danger piket_btn_hapus">
	// 						<i class="bi bi-trash"></i>
	// 					</button>
	// 				</td>
	// 			</tr>`
	// }

	function templatePiket(index, valueUser, valuePass) {
		return `<tr class="barisCurrentPiket">
					<th>${index}</th>
					<td>
						<input name="username${index}" type="text" class="form-control piket_u_current" value="${valueUser}" readonly>
					</td>
					<td>
						<input name="pass${index}" type="password" class="form-control piket_p_current" value="${valuePass}" readonly placeholder="Kata sandi">
					</td>
					<td>
						<label for="piket_foto">
							<span class="btn btn-sm btn-secondary">Foto</span>
						</label>
							<input type="file" name="piket_foto" id="piket_foto" class="form-control d-none" accept=".png,.jpg,.jpeg" required>
					</td>
					<td><input type="text" name="piket_register" id="piket_register" class="form-control" required></td>
					<td><input type="text" name="piket_anjab" id="piket_anjab" class="form-control" required></td>
					<td>
						<button class="btn btn-primary piket_btn_edit" type="button">
							<i class="bi bi-pencil-square ikon_piket_btn_current"></i>
						</button>
						<button type="button" class="btn btn-danger piket_btn_hapus">
							<i class="bi bi-trash"></i>
						</button>
					</td>
				</tr>`
	}

	modalPiket.addEventListener('shown.bs.modal', function() {
		let listPiket = JSON.parse(localStorage.getItem('listPiket'));
		$('#formTambahPiket tbody .bariscurrentpiket').remove()

		let lengthPiketStorage = Object.keys(listPiket).length;

		for (let i = 0; i < lengthPiketStorage / 2; i++) {
			$('#rowInputTambahPiket').before(templatePiket(i + 1, listPiket[`username${i}`], listPiket[`pass${i}`]))
		}

		ulangi_piket_btn_edit()
		hapusRow('.piket_btn_hapus', '.barisCurrentPiket')
	})

	function ulangi_piket_btn_edit() {
		for (let i = 0; i < $(".piket_btn_edit").length; i++) {
			$(".piket_btn_edit")[i].onclick = function(e) {
				$('.piket_u_current').eq(i).attr('readonly', function(index, attr) {
					return attr == 'readonly' ? null : 'readonly';
				});
				$('.piket_p_current').eq(i).attr('readonly', function(index, attr) {
					return attr == 'readonly' ? $(this).prop('type', 'text') && null : 'readonly' && $(this).prop('type', 'password') && $('#formTambahPiket button:submit').prop('disabled', false);
				});
				$('.ikon_piket_btn_current').eq(i).attr('class', function(index, attr) {
					return attr == 'bi bi-pencil-square ikon_piket_btn_current' ? 'bi bi-check-lg ikon_piket_btn_current' : 'bi bi-pencil-square ikon_piket_btn_current';

				});
				$('.piket_btn_edit').eq(i).attr('class', function(index, attr) {
					return attr == 'btn btn-primary piket_btn_edit' ? 'btn btn-success piket_btn_edit' : 'btn btn-primary piket_btn_edit';
				});
				ulangi_piket_btn_edit()
			};
		}
	}

	$('#rowInputTambahPiket input').keyup(function(e) {
		// console.log($('#tambahUsernamePiket').val())
		if ($('#tambahUsernamePiket').val() !== "" && $('#tambahPasswordPiket').val() !== "") {
			$('#tblTambahPiket').prop('disabled', false);
		} else {
			$('#tblTambahPiket').prop('disabled', true);
		}
	})

	$('#tblTambahPiket').on('click', function(e) {
		let trigger = true;
		$('#formTambahPiket .piket_u_current').filter(function(index, item, arr) {
			if ($('#tambahUsernamePiket').val() == $(item).val()) {
				trigger = false
			}
		})

		if (trigger) {
			$('#formTambahPiket tr').last().before(templatePiket($('#formTambahPiket tr').length - 1, $('#tambahUsernamePiket').val(), $('#tambahPasswordPiket').val()))
			$('#tambahUsernamePiket').val("");
			$('#tambahPasswordPiket').val("");
			$('#formTambahPiket button:submit').prop('disabled', false);
			ulangi_piket_btn_edit()
			hapusRow('.piket_btn_hapus', '.barisCurrentPiket')
		} else {
			notif('Username sudah ada');
			$('#tambahUsernamePiket').val("");
			$('#tambahPasswordPiket').val("");
		}
		$('#tblTambahPiket').prop('disabled', true);
	});

	$('#formTambahPiket').submit(function(e) {
		let listPiketPassKosong = JSON.parse(localStorage.getItem('listPiketPassKosong'));
		// let lengthPiketStorage = Object.keys(listPiketPassKosong).length;
		// let lengthPiketModal = $('.piket_u_current').length;
		let jsonPiketModal = Object.fromEntries(new FormData($('#formTambahPiket')[0])); //json dgn key dari name form

		const mergedObject = {
			...listPiketPassKosong,
			...jsonPiketModal
		};

		// console.log(mergedObject)
		let dataPiket = new URLSearchParams(mergedObject)
		dataPiket.set('tambahPiket', "");
		tanya_simpan('Ubah Piket', 'Yakin akan mengubah user ini?', dataPiket.toString());
		e.preventDefault();
	})

	// SLIDER
	let dataSlider = '';
	let dataQuerySlider = new URLSearchParams(`slider_1=&slider_2=&slider_3=&slider_4=&slider_5=&ubahSlide=`);

	$('#formSlider input:file').on('change', function(e) {
		let indexLabel = $('#formSlider input:file').index(this);
		let slideName = $('#formSlider input:file').eq(indexLabel).prop('name')
		let reader = new FileReader();
		reader.onload = function() {
			let foto = new Uint8Array(reader.result);
			$('#formSlider img').eq(indexLabel).prop('src', URL.createObjectURL($(`#formSlider input:file`)[indexLabel].files[0]))
			if (reader.readyState == 2) {
				dataQuerySlider.set(slideName, foto);
				dataSlider = dataQuerySlider.toString();
				// console.log(foto)
			}
		}

		reader.readAsArrayBuffer($(`#formSlider input:file`)[indexLabel].files[0]);
		$('#formSlider button:submit').prop('disabled', false);
	})

	$('#formSlider').on('submit', function(e) {
		let modalSlider = new bootstrap.Modal(document.getElementById('slider_edit'));
		// console.log(dataSlider)
		tanya_simpan("Ubah slide", "Yakin akan simpan?", dataSlider);
		responProses().then(res => { ///////////// PROMISE ====================+
			if (res != 'Pastikan file Anda bertipe gambar!') {
				notif('Data tersimpan');
				modalSlider.hide()
			} else {
				notif(res);
			}
		})
		e.preventDefault();
	})

	// TAMBAH PEJABAT
	$('#formTambahPejabat').submit(function(e) {
		let modalTambahPengguna = new bootstrap.Modal(document.getElementById('modalTambahPejabat'));
		let foto, valArr = [];
		$(`#modalTambahPejabat input,#modalTambahPejabat select`).filter((ind, el) => {
			valArr.push(el.value);
		});

		let reader = new FileReader();
		reader.onload = function() {
			foto = new Uint8Array(reader.result);

			let dataQuery = new URLSearchParams(new FormData($('#formTambahPejabat')[0]));
			dataQuery.set('foto', foto);
			dataQuery.append('tambahPejabat', '');

			const data = dataQuery.toString();
			// console.log(foto)

			tanya_simpan("Tambah Pengguna", "Yakin akan simpan?", data);
			responProses().then(res => { ///////////// PROMISE ====================+
				if (res != 'Username sudah digunakan') {
					notif('Data tersimpan');
					modalTambahPengguna.hide()
					$(`#modalTambahPejabat input,#modalTambahPejabat select`).filter((ind, el) => {
						el.value = "";
					});
				} else {
					notif(res);
					$(`#modalTambahPejabat input`)[0].click()
				}
			})
		}
		reader.readAsArrayBuffer($(`#modalTambahPejabat input:file`)[0].files[0]);
		e.preventDefault()
	});


	// HAPUS PEJABAT/USER
	$('.hapus').click(function() {
		let hre = new URLSearchParams(new URL($(this).prev().prop('href')).search);
		let id_del = `hapus=${hre.get('id')}`

		tanya_simpan('Hapus Pengguna', 'Yakin akan menghapus user ini?', id_del)
	})

	<?php
	if (isset($_POST['data'])) {
		unset($data);
		unset($_SESSION['data']);
		$data = $_POST['data']['dataPjb'];
	}
	?>
</script>

<?php
include("layout/footer.php");
?>
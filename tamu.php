<?php
$title = "Tamu";
include "layout/header.php";
$_SESSION['role'] != 2 ? pindahko("/") : "";
$dataBidang = $_SESSION['data']['dataBidang'];
$slide = $_SESSION['data']['slide'][0];
// print_r($slide);
?>

<style>
	#sidebar {
		position: fixed;
		left: 0;
		top: 0;
		height: 100%;
		z-index: 1;
	}

	.navbar {
		display: none;
	}

	footer {
		background-color: transparent !important;
		color: #fff;
	}

	footer .text-dark {
		color: #fff !important;
	}

	.menu-tamu {
		display: block;
		position: fixed;
		top: 0;
		left: 280px;
		margin: 1rem;
		transition: .25s all ease;
	}

	.menu-tamu.collapsed {
		left: 0;
	}

	.nav-link {
		cursor: pointer;
		transition: .25s all ease;
	}

	.nav-link:hover {
		background: #e4e4e4;
	}
</style>

<main class="container">

	<!-- TOMBOL MENU -->
	<div class="menu-tamu collapsed" data-bs-target="#sidebar" data-bs-toggle="collapse" title="Tampilkan Bilah Menu">
		<div class="btn btn-warning shadow">
			<i class="bi bi-list me-2"></i> Menu
		</div>
	</div>

	<!-- SIDEBAR -->
	<div id="sidebar" class="collapse collapse-horizontal">
		<div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 280px; height: 100%">
			<a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
				<img class="d-inline-block align-middle me-1" src="./img/title.png" alt="" width="20" height="20"> <b class="d-inline-block align-middle"><?= JUDUL ?></b>
			</a>
			<hr>
			<ul class="nav nav-pills flex-column mb-auto">
				<li>
					<span class="nav-link link-dark" onclick="detailPiket()">
						<i class="bi bi-person-circle me-2"></i> Profil
					</span>
				</li>
				<li>
					<span class="nav-link link-dark" data-bs-toggle="modal" data-bs-target="#absen-piket">
						<i class="bi bi-person-bounding-box me-2"></i> Absen
					</span>
				</li>
				<li class="nav-item">
					<span class="nav-link link-dark" data-bs-toggle="modal" data-bs-target="#modal_kontak">
						<i class="bi bi-telephone me-2"></i> Kontak
					</span>
				</li>
				<li>
					<span class="nav-link link-danger">
						<i class="bi bi-power me-2"></i> Keluar
					</span>
				</li>
			</ul>
		</div>
	</div>

	<!-- ISI UTAMA -->
	<div class="row">
		<!-- LEFT SIDE -->
		<div class="col-md-7 p-4">

			<div class="row mb-5">
				<img src="./img/Logo ProvSulSel.png" width="200px" style="width:30%;display:block;margin:0 auto;">
			</div>

			<!-- SLIDER -->
			<div class="row">
				<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
					<div class="carousel-indicators">
						<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
						<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
						<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
						<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
						<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4" aria-label="Slide 5"></button>
					</div>
					<div class="carousel-inner">
						<?php
						$n = 1;
						foreach ($slide as $value) {
							if ($value <> "") {
						?>
								<div class="carousel-item <?= $n == 1 ? "active" : "" ?>">
									<img src="<?= $value ?>" class="d-block w-100" alt="Gambar 1">
								</div>
						<?php
								$n++;
							}
						}
						?>
					</div>
					<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="visually-hidden">Previous</span>
					</button>
					<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="visually-hidden">Next</span>
					</button>
				</div>
			</div>

		</div>

		<!-- RIGHT SIDE -->
		<div class="col-md-5 bg-light p-4" style="box-shadow: 15px 0px 15px -4px rgb(0 0 0 / 23%), -13px 0 8px -4px rgb(0 0 0 / 23%)">

			<!-- INPUT TAMU -->
			<h2 class="mb-4" data-bs-target="#sidebar" data-bs-toggle="collapse">Informasi Pengunjung</h2>
			<form id="formTamu" autocomplete="off">
				<div class="mb-3">
					<label for="nama" class="form-label">Nama</label>
					<input name="namaTamu" type="text" class="form-control" id="namaTamu" required>
				</div>
				<div class="mb-3">
					<label for="nip" class="form-label">NIK/NIP</label>
					<input name="nipTamu" type="number" class="form-control" id="nipTamu" required>
				</div>
				<div class="mb-3">
					<label for="asal" class="form-label">Instansi</label>
					<input name="asalTamu" type="text" class="form-control" id="asalTamu" required>
				</div>
				<div class="mb-3">
					<label for="bidang" class="form-label">Bidang Tujuan</label>
					<select id="bidang" name="bidangTujuan" class="form-select" aria-label="Pilih Bidang Tujuan">
						<option value="" selected></option>
						<?php
						foreach ($dataBidang as $val) {
						?>
							<option value="<?= $val[0] ?>"><?= $val[1] ?></option>
						<?php
						}
						?>
					</select>
				</div>
				<div class="mb-3">
					<label for="subbidang" class="form-label">Sub-Bidang Tujuan</label>
					<select id="subbidang" name="subBidangTujuan" class="form-select" aria-label="Pilih Sub Bidang Tujuan" disabled>
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
				<div class="mb-3">
					<label for="jabatan" class="form-label">Jabatan Tujuan</label>
					<select id="jabatan" name="jabatanTujuan" class="form-select" aria-label="Pilih Jabatan Tujuan">
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
				<div class="mb-3">
					<label for="tujuan" class="form-label">Tujuan</label>
					<input name="tujuan" type="text" class="form-control" id="tujuanTamu" required>
				</div>
				<div class="mb-3" style="width: 190px;height: 200px;">
					<input type="hidden" name="fotoPhp" id="fotoPhp">
					<img class="shadow p-3" id="foto" width=190 height=200>
				</div>

				<button type="button" data-bs-toggle="modal" data-bs-target="#modal-kamera" class="btn btn-secondary me-auto" id="kamera-modal">Ambil gambar</button>
				<div class="float-end d-inline-block">
					<input type="submit" class="btn btn-success ms-auto" name="kirimTamu" value="Simpan">
					<!-- type="submit" name="kirimTamu" id="kirimTamu"-->
				</div>
			</form>

		</div>
	</div>
</main>

<!-- MODAL PIKET TAKE PICTURE -->
<div class="modal fade" id="absen-piket" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header bg-warning">
				<h5 class="modal-title">Absen Piket</h5>
			</div>
			<div class="modal-body">
				<!-- ISI MODAL START HERE -->
				<div class="camera">
					<section class="row">
						<section class="col text-center">
							<section>
								<video id="video" style="display: inline">Video stream not
									available.</video>
								<canvas id="canvas" style="display: none">
								</canvas>
							</section>
						</section>
					</section>
					<section class="row">
						<section class="col text-center">
							<button id="startbutton" class="btn btn-success mt-2">Ambil</button>
						</section>
					</section>
				</div>
				<!-- ISI MODAL END HERE -->
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>

<!-- MODAL KARTU PENGUNJUNG -->
<div class="modal fade" id="kartu-pengunjung" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header bg-warning">
				<h5 class="modal-title">Kartu Pengunjung: Nama Tamu</h5>
			</div>
			<div class="modal-body">
				<!-- ISI MODAL START HERE -->
				<div class="d-flex flex-column align-items-center text-center pb-4 pt-2">
					<div class="detail-content-loader tunggu rounded-circle">
						<img id="detailFotoTamu" src="/img/p.webp" alt="Foto Tamu" class="rounded-circle" width="150" height="150" style="object-fit: cover;">
					</div>
				</div>
				<table class="table table-striped">
					<tr>
						<th width="40%">Nama</th>
						<td width="1%">:</td>
						<th width="59%">Nama Tamu</th>
					</tr>
					<tr>
						<th>NIP</th>
						<td>:</td>
						<td>123456</td>
					</tr>
					<tr>
						<th>Instansi</th>
						<td>:</td>
						<td>Instansi Tamu</td>
					</tr>
					<tr>
						<th>Bidang Tujuan</th>
						<td>:</td>
						<td>Bidang Tujuan Tamu</td>
					</tr>
					<tr>
						<th>Sub-Bidang Tujuan</th>
						<td>:</td>
						<td>Sub-Bidang Tujuan Tamu</td>
					</tr>
					<tr>
						<th>Jabatan Tujuan</th>
						<td>:</td>
						<td>Jabatan Tujuan Tamu</td>
					</tr>
					<tr>
						<th>Tujuan</th>
						<td>:</td>
						<td>Tujuan Tamu</td>
					</tr>
				</table>
				<!-- ISI MODAL END HERE -->
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>
<script>
	// ****************************** PERCOBAAN PANGIL MODAL ****************************** //
	// HAPUS MI NANTI INI, PERCOBAAN JI
	// let modalKu = new bootstrap.Modal(document.getElementById('kartu-pengunjung'))
	// modalKu.show()
	// ****************************** PERCOBAAN PANGIL MODAL ****************************** //
</script>

<!-- MODAL KAMERA -->
<div class="modal" tabindex="-1" id="modal-kamera">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Ambil gambar</h5>
			</div>

			<div class="modal-body">
				<div class="camera">
					<section class="row">
						<section class="col text-center">
							<section>
								<video id="video" style="display: inline">Video stream not
									available.</video>
								<canvas id="canvas" style="display: none">
								</canvas>
							</section>
						</section>
					</section>
					<section class="row">
						<section class="col text-center">
							<button id="startbutton" class="btn btn-success mt-2">Ambil</button>
						</section>
					</section>
				</div>
			</div>

			<div class="modal-footer">
				<button class="btn btn-secondary" data-bs-dismiss="modal" id="tutupKamera">Tutup</button>
				<button class="btn btn-primary" data-bs-dismiss="modal" id="simpan" disabled>Simpan</button>
			</div>
		</div>
	</div>
</div>

<script>
	let foto = document.getElementById('foto');

	///////// MODAL WARNING //////////===========================================================
	$('#formTamu').submit(function(event) {
		event.preventDefault();
		if ($('#fotoPhp').val() == '') {
			$('#foto').removeClass('shadow');
			$('#foto').addClass('shadow-blue');
		} else {
			$('#foto').removeClass('shadow-blue');
			$('#foto').addClass('shadow');
			const fotoBuffer = b64toArr($('#fotoPhp').val());
			let data = `kirimTamu=&namaTamu=${$('#namaTamu').val()}&nipTamu=${$('#nipTamu').val()}&asalTamu=${$('#asalTamu').val()}&bidangTujuan=${$('#bidang').val()}&subBidangTujuan=${$('#subbidang').val()}&jabatanTujuan=${$('#jabatan').val()}&tujuan=${$('#tujuanTamu').val()}&fotoPhp=${fotoBuffer}`
			tanya_simpan('Perhatian', 'Yakin akan simpan?', data);
		}
	});

	/////// CAMERA ////////=================================================================================
	let streaming = false;


	let width = 380,
		height = 400,
		vid;
	let video = null;
	let canvas = null;
	let photo = null;
	let startbutton = null;
	let kameraModal = document.getElementById('kamera-modal');
	let tutupKamera = document.getElementById('tutupKamera');
	let fotoB64 = null;
	let simpan = document.getElementById('simpan');

	video = document.getElementById('video');
	canvas = document.getElementById('canvas');
	photo = document.getElementById('photo');
	startbutton = document.getElementById('startbutton');

	tutupKamera.addEventListener('click', () => {
		vid = video.srcObject;
		vid.getTracks()[0].stop();
	})


	kameraModal.addEventListener('click', function() {
		simpan.disabled = true;
		canvas.setAttribute('style', 'display: none');
		video.setAttribute('style', 'display: inline');
		navigator.mediaDevices.getUserMedia({
				video: true,
				audio: false
			})
			.then(function(stream) {
				video.srcObject = stream;
				video.play();
			})
			.catch(function(err) {
				console.log("An error occurred: " + err);
			});

		video.addEventListener('canplay', function(ev) {
			if (!streaming) {
				height = video.videoHeight / (video.videoWidth / width);

				if (isNaN(height)) {
					height = width / (4 / 3);
				}

				video.setAttribute('width', width);
				video.setAttribute('height', height);
				canvas.setAttribute('width', width);
				canvas.setAttribute('height', height);
				streaming = true;
			}
		}, false);
	})

	function clearphoto() {
		var context = canvas.getContext('2d');
		context.fillStyle = "#AAA";
		context.fillRect(0, 0, canvas.width, canvas.height);

		var data = canvas.toDataURL('image/png');
		// photo.setAttribute('src', data);
	}


	startbutton.addEventListener('click', function(ev) {
		takepicture();
		ev.preventDefault();
	}, false);

	function takepicture() {
		var context = canvas.getContext('2d');
		simpan.disabled = false;

		if (canvas.getAttribute('style') == 'display: none') {
			canvas.setAttribute('style', 'display: inline');
			video.setAttribute('style', 'display: none');
			if (width && height) {
				canvas.width = 380;
				canvas.height = 400;
				context.drawImage(video, 92, 0, 455, 480, 0, 0, 380, 400);

				var data = canvas.toDataURL('image/png');
				simpan.addEventListener('click', () => {
					foto.src = data;
					let fotoPhp = document.getElementById('fotoPhp')
					fotoPhp.value = data.replace(/^data:.+;base64,/, '');
					vid = video.srcObject;
					vid.getTracks()[0].stop();
				})
			}
		} else {
			canvas.setAttribute('style', 'display: none');
			video.setAttribute('style', 'display: inline');
		}
	}

	//////////////// AJAX //////////////////
	// let kirimTamu = document.getElementById('kirimTamu');

	// kirimTamu.addEventListener('click', function() {
	// 	var xhr = new XMLHttpRequest();
	// 	xhr.open("POST", '/proses.php', true);

	// 	//Send the proper header information along with the request
	// 	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

	// 	xhr.onreadystatechange = function() { // Call a function when the state changes.
	// 		if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
	// 			// Request finished. Do processing here.
	// 		}
	// 	}
	// 	xhr.send(``);
	// })


	////// UNTUK PAGE TAMU //////=======================================================================
	let bidang = document.getElementById('bidang');
	let subbidang = document.getElementById('subbidang');
	let jabatan = document.getElementById('jabatan');

	for (let i = 3; i < jabatan.options.length; i++) {
		jabatan.options[i].classList.toggle('d-none');
	}

	function togel(parm) {
		if (parm == 'kadisHilang') {
			jabatan.options[1].classList.add('d-none');
			jabatan.options[2].classList.add('d-none');
			for (let i = 3; i < jabatan.options.length; i++) {
				jabatan.options[i].classList.remove('d-none');
			}
		} else {
			jabatan.options[1].classList.remove('d-none');
			jabatan.options[2].classList.remove('d-none');
			for (let i = 3; i < jabatan.options.length; i++) {
				jabatan.options[i].classList.add('d-none');
			}
		}
	}


	bidang.addEventListener('change', function(isi) {
		let value = isi.target.options[bidang.selectedIndex].value;
		subbidang.disabled = true;
		subbidang.options.selectedIndex = 0;
		// jabatan.disabled = true;
		jabatan.options.selectedIndex = 0;
		if (value == 'b1') {
			subbidang.disabled = false;
			jabatan.options.selectedIndex = 0;
			jabatan.disabled = true;
		} else if (subbidang.selectedIndex == 0) {
			jabatan.disabled = false;
		}

		if (value != "") {
			togel('kadisHilang');
		} else {
			togel('muncul ko kadis');
		}
	});

	subbidang.addEventListener('change', function(isi) {
		let value = isi.target.options[subbidang.selectedIndex].value;
		jabatan.options.selectedIndex = 0;
		if (value != "" && subbidang.options.selectedIndex != 0) {
			jabatan.disabled = false;
		} else {
			jabatan.options.selectedIndex = 0;
			jabatan.disabled = true;
		}
	})
</script>

<?php
include("layout/footer.php");
?>
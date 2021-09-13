<?php
$title = "Tamu";
include "layout/header.php";
$_SESSION['role'] != 2 ? pindahko("/") : "";
$dataBidang = $_SESSION['data']['dataBidang'];
?>

<style>
	body {
		background-image: url(/img/bg.jpg);
		background-size: cover;
	}

	.carousel-item {
		height: 100%;
		max-height: 400px;
	}

	video {
		object-fit: cover;
		width: 380;
		height: 400;
	}
</style>

<!-- ISI MULAI -->
<main class="container">
	<div class="row">
		<div class="col-md-7 p-4">

			<div class="row mb-5">
				<img src="./img/Logo ProvSulSel.png" width="200px" style="width:30%;display:block;margin:0 auto;">
			</div>

			<!-- SLIDER START HERE -->
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
						<div class="carousel-item active">
							<img src="./img/slide1.jpg" class="d-block w-100" alt="Gambar 1">
						</div>
						<div class="carousel-item">
							<img src="./img/slide2.jpg" class="d-block w-100" alt="Gambar 2">
						</div>
						<div class="carousel-item">
							<img src="./img/slide3.jpg" class="d-block w-100" alt="Gambar 3">
						</div>
						<div class="carousel-item">
							<img src="./img/slide4.jpg" class="d-block w-100" alt="Gambar 3">
						</div>
						<div class="carousel-item">
							<img src="./img/slide5.jpg" class="d-block w-100" alt="Gambar 3">
						</div>
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
			<!-- SLIDER END HERE -->

		</div>

		<div class="col-md-5 bg-light p-4" style="box-shadow: 15px 0px 15px -4px rgb(0 0 0 / 23%), -13px 0 8px -4px rgb(0 0 0 / 23%)">

			<h2 class="mb-4">Informasi Pengunjung</h2>
			<!-- method="POST" action="proses.php" enctype="multipart/form-data" name="formTamu" id="formTamu" -->
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
			<!-- MODAL KAMERA START -->
			<div class="modal" tabindex="-1" id="modal-kamera">
				<div class="modal-dialog modal-md">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Ambil gambar</h5>
							<!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
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
										<button id="startbutton" class="btn btn-success mt-2">Take</button>
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
			<!-- MODAL KAMERA END -->
		</div>
	</div>
</main>
<!-- ISI SELESAI -->

<script>
	let foto = document.getElementById('foto');

	///////// MODAL WARNING //////////===========================================================
	$('#formTamu').submit(event => {
		event.preventDefault();
		if ($('#fotoPhp').val() == '') {
			$('#foto').removeClass('shadow');
			$('#foto').addClass('shadow-blue');
		} else {
			$('#foto').removeClass('shadow-blue');
			$('#foto').addClass('shadow');
			const fotoBuffer = _base64ToArrayBuffer($('#fotoPhp').val());
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
</script>

<?php
include("layout/footer.php");
?>
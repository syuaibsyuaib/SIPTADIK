<?php
$title = "Tamu";
include("layout/header.php");
$_SESSION['role'] != 1 && $_SESSION['role'] != 2 ? header("Location: /") : "";
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

	.coba img {
		min-width: 100%;
		width: 100%;
		height: 5rem;
		/* cursor: move; */
	}

	.coba>div {
		overflow: hidden;
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

			<?php
			if ($_SESSION['role'] == 1) {
			?>
				<div class="row mt-4 text-center">
					<button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#slider_edit">Edit Slider</button>
				</div>

				<!-- MODAL UBAH -->
				<div class="modal fade" id="slider_edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<form method="POST" action="">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">Pengaturan Gambar Carousel</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
				<!-- MODAL UBAH -->
			<?php
			}
			?>

		</div>

		<div class="col-md-5 bg-light p-4" style="box-shadow: 15px 0px 15px -4px rgb(0 0 0 / 23%), -13px 0 8px -4px rgb(0 0 0 / 23%)">

			<h2 class="mb-4">Informasi Pengunjung</h2>
			<form method="POST" action="" enctype="multipart/form-data">
				<div class="mb-3">
					<label for="nama" class="form-label">Nama</label>
					<input type="text" class="form-control" id="nama" required>
				</div>
				<div class="mb-3">
					<label for="nip" class="form-label">NIK/NIP</label>
					<input type="number" class="form-control" id="nip" required>
				</div>
				<div class="mb-3">
					<label for="asal" class="form-label">Instansi</label>
					<input type="text" class="form-control" id="asal" required>
				</div>
				<div class="mb-3">
					<label for="asal" class="form-label">Sub bidang tujuan</label>
					<select class="form-select" aria-label="Default select example" required>
						<option value="" selected>Silakan pilih</option>
						<option value="1">Bidang One</option>
						<option value="2">Bidang Two</option>
						<option value="3">Bidang Three</option>
					</select>
				</div>
				<div class="mb-3">
					<label for="tujuan" class="form-label">Tujuan</label>
					<input type="text" class="form-control" id="tujuan" required>
				</div>
				<div class="mb-3" style="width: 190px;height: 200px;">
					<img class="shadow p-3" id="foto" width=190 height=200>
				</div>
				<!-- <div class="mb-3 form-check">
					<input type="checkbox" class="form-check-input" id="exampleCheck1">
					<label class="form-check-label" for="exampleCheck1">Check me out</label>
				</div> -->

				<button type="button" data-bs-toggle="modal" data-bs-target="#modal-kamera" class="btn btn-secondary me-auto" id="kamera-modal">Ambil gambar</button>
				<div class="float-end d-inline-block">
					<input type="submit" name="submit" class="btn btn-success ms-auto" value="Simpan">
				</div>

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
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="tutupKamera">Tutup</button>
								<button type="submit" class="btn btn-primary" data-bs-dismiss="modal" id="simpan" disabled>Simpan</button>
							</div>
						</div>
					</div>
				</div>
				<!-- MODAL KAMERA END -->
			</form>

		</div>
	</div>
</main>
<!-- ISI SELESAI -->

<script>
	var streaming = false;

	let foto = document.getElementById('foto');
	let width = 380, height = 400, vid;
	var video = null;
	var canvas = null;
	var photo = null;
	var startbutton = null;
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
					console.log(data.replace(/^data:.+;base64,/, ''));
					vid = video.srcObject;
					vid.getTracks()[0].stop();
				})
			}
		} else {
			canvas.setAttribute('style', 'display: none');
			video.setAttribute('style', 'display: inline');
		}
	}

</script>

<?php
include("layout/footer.php");
?>
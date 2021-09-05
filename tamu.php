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
					<label for="asal" class="form-label">Bidang Tujuan</label>
					<select class="form-select" aria-label="Pilih Bidang Tujuan">
						<option value="" selected></option>
						<option value="1">Bidang One</option>
						<option value="2">Bidang Two</option>
						<option value="3">Bidang Three</option>
					</select>
				</div>
				<div class="mb-3">
					<label for="asal" class="form-label">Sub-Bidang Tujuan</label>
					<select class="form-select" aria-label="Pilih Sub Bidang Tujuan">
						<option value="" selected></option>
						<option value="1">Sub-Bidang One</option>
						<option value="2">Sub-Bidang Two</option>
						<option value="3">Sub-Bidang Three</option>
					</select>
				</div>
				<div class="mb-3">
					<label for="asal" class="form-label">Jabatan Tujuan</label>
					<select class="form-select" aria-label="Pilih Jabatna Tujuan">
						<option value="" selected></option>
						<option value="1">Jabatan One</option>
						<option value="2">Jabatan Two</option>
						<option value="3">Jabatan Three</option>
					</select>
				</div>
				<div class="mb-3">
					<label for="tujuan" class="form-label">Tujuan</label>
					<input type="text" class="form-control" id="tujuan" required>
				</div>
				<div class="mb-3 border" style="width: 190px;height: 200px;">
					<img id="foto" width=190 height=200>
				</div>
				<div class="mb-3 form-check">
					<input type="checkbox" class="form-check-input" id="exampleCheck1">
					<label class="form-check-label" for="exampleCheck1">Check me out</label>
				</div>

				<button type="button" data-bs-toggle="modal" data-bs-target="#modal-kamera" class="btn btn-secondary me-auto" id="kamera-modal">Ambil gambar</button>
				<div class="float-end d-inline-block">
					<input type="submit" name="submit" class="btn btn-success ms-auto" value="Simpan">
				</div>

				<!-- MODAL KAMERA START -->
				<div class="modal" tabindex="-1" id="modal-kamera">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Ambil gambar</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>

							<div class="modal-body">
								<div class="camera">
									<section class="row">
										<section class="col text-center">
											<video id="video" style="display: inline">Video stream not
												available.</video>
											<canvas id="canvas" style="display: none">
											</canvas>
										</section>
									</section>
									<section class="row">
										<section class="col text-center">
											<button id="startbutton" class="btn btn-success">Take</button>
										</section>
									</section>
								</div>
							</div>

							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
								<button type="submit" class="btn btn-primary" id="simpan">Simpan</button>
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
	// The width and height of the captured photo. We will set the
	// width to the value defined here, but the height will be
	// calculated based on the aspect ratio of the input stream.

	var width = 570; // We will scale the photo width to this
	var height = 0; // This will be computed based on the input stream

	// |streaming| indicates whether or not we're currently streaming
	// video from the camera. Obviously, we start at false.

	var streaming = false;

	// The various HTML elements we need to configure or control. These
	// will be set by the startup() function.
	let foto = document.getElementById('foto');
	var video = null;
	var canvas = null;
	var photo = null;
	var startbutton = null;
	let kameraModal = document.getElementById('kamera-modal');

	video = document.getElementById('video');
	canvas = document.getElementById('canvas');
	photo = document.getElementById('photo');
	startbutton = document.getElementById('startbutton');

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

			// Firefox currently has a bug where the height can't be read from
			// the video, so we will make assumptions if this happens.

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

	startbutton.addEventListener('click', function(ev) {
		takepicture();
		ev.preventDefault();
	}, false);

	// clearphoto();

	// kameraModal.addEventListener('click', function(){

	// })

	// Fill the photo with an indication that none has been
	// captured.

	// function clearphoto() {
	//     var context = canvas.getContext('2d');
	//     context.fillStyle = "#AAA";
	//     context.fillRect(0, 0, canvas.width, canvas.height);

	//     var data = canvas.toDataURL('image/png');
	//     photo.setAttribute('src', data);
	// }

	// Capture a photo by fetching the current contents of the video
	// and drawing it into a canvas, then converting that to a PNG
	// format data URL. By drawing it on an offscreen canvas and then
	// drawing that to the screen, we can change its size and/or apply
	// other changes before drawing it.

	function takepicture() {
		var context = canvas.getContext('2d');
		let simpan = document.getElementById('simpan');

		if (canvas.getAttribute('style') == 'display: none') {
			canvas.setAttribute('style', 'display: inline');
			video.setAttribute('style', 'display: none');
			if (width && height) {
				canvas.width = width;
				canvas.height = height;
				context.drawImage(video, 0, 0, width, height);

				var data = canvas.toDataURL('image/png');
				simpan.addEventListener('click', () => {
					foto.src = data;
					console.log(data)
				})
			}
		} else {
			canvas.setAttribute('style', 'display: none');
			video.setAttribute('style', 'display: inline');
		}
	}

	// Set up our event listener to run the startup process
	// once loading is complete.
	// window.addEventListener('click', startup, false);
</script>

<?php
include("layout/footer.php");
?>
<?php
date_default_timezone_set("Asia/Makassar");
setlocale(LC_ALL, 'id_ID');

session_start();
if (isset($_SESSION['user'])) {
	if ($_SESSION['role'] == 1) {
		header("Location: admin.php");
	} elseif ($_SESSION['role'] == 2) {
		header("Location: tamu.php");
	} elseif ($_SESSION['role'] == 3) {
		// header("Location: pejabat.html");
		unset($_SESSION['user']);
		unset($_SESSION['pass']);
		unset($_SESSION['role']);
		$_SESSION['temp'] = "Pejabat masuk melalui Phone App!";
		header("Location: /");
		exit;
	}
}
if (isset($_GET['logout'])) {
	session_destroy();
	header("Location: masuk.php");
}
?>

<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="favicon.ico">
	<title>SIPTADIK | Masuk</title>

	<link href="assets/css/bootstrap.min.css" rel="stylesheet">
	<script src="assets/js/bootstrap.bundle.min.js"></script>
	<script src="https://github.com/justadudewhohacks/face-api.js/blob/master/dist/face-api.js"></script>
	<!-- Custom styles for this template -->
	<link href="assets/css/login.css" rel="stylesheet">
</head>

<body class="text-center">
	<!-- MODAL LOADING -->
	<div class="modal" id="modalLoading" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal_loading_label" aria-hidden="true" style="z-index: 1057;">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content" style="background: none; border: none;">
				<div class="modal-body" id="modal_loading_label">
					<div class="d-flex justify-content-center">
						<div class="spinner-border text-light" style="width: 3rem; height: 3rem;" role="status">
							<span class="visually-hidden">Loading...</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-sm text-center mx-auto">
				<div class="wrapper shadow">
					<div class="wp-u">
						<img class="mb-4" src="img/title.png" alt="" width="57" height="57">
						<span>SIPTADIK</span>
					</div>
					<div class="wp-b">
						<span class="judul">Selamat Datang</span>
						<span class="subjudul">Silakan masuk terlebih dahulu</span>
						<?php
						if (isset($_SESSION['temp'])) {
						?>
							<div class="alert alert-warning mx-auto" role="alert">
								<?= $_SESSION['temp'] ?>
							</div>
						<?php
							unset($_SESSION['temp']);
						}
						?>
						<form method="POST" action="proses.php">
							<div class="form-floating">
								<input name="pengguna" type="text" class="form-control" id="inputnama" placeholder="Nama Pengguna" required autofocus>
								<label for="inputnama">Nama Pengguna</label>
							</div>
							<div class="form-floating">
								<input name="sandi" type="password" class="form-control" id="inputsandi" placeholder="Kata Sandi" required>
								<label for="inputsandi">Kata Sandi</label>
							</div>

							<button id="login" class="btn btn-lg btn-primary rounded-pill mt-4" type="submit" name="masuk">Masuk</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script>
		localStorage.clear();
		let login = document.getElementById("login")
		login.addEventListener('click', () => {
			let myModalLoading = new bootstrap.Modal(document.getElementById('modalLoading'));
			myModalLoading.show();
		})
	</script>
</body>

</html>
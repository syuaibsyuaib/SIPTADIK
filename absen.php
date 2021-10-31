<?php
$title = "Riwayat";
include("layout/header.php");
segarkan($_SESSION['user'], $_SESSION['pass']);
$_SESSION['role'] != 1 ? pindahko("/") : "";
$data = $_SESSION['data']['dataTamu'];
// print_r($_SESSION['data']['dataBidang']);
?>
<script src="assets/js/faceapi.js"></script>
<script src="assets/js/chart.min.js"></script>




<?php
include("layout/footer.php");
?>
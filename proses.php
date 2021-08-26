<?php
if (isset($_POST['masuk'])) {
    $pengguna = $_POST['pengguna'];
    $sandi = $_POST['sandi'];
    if ($pengguna == "admin" && $sandi == "admin") {
        header("location: admin.html");
    } elseif ($pengguna == "piket" && $sandi == "piket") {
        header("location: tamu.html");
    } else {
        header("location: index.html");
    }
}
?>
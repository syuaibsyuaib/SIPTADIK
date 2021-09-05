<?php
include("validation.php");
?>
<html class="h-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="favicon.ico">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/custom.css" rel="stylesheet">
    <link href="assets/css/riwayat.css" rel="stylesheet">
    <link href="assets/css/icons.css" rel="stylesheet">
    <title>
        <?=$title ?? "Halaman"?> | SIPTADIK
    </title>
</head>

<body class="d-flex flex-column h-100">
    <!-- NAVBAR START HERE -->
    <nav class="navbar navbar-expand-lg navbar-light warna-dasar sticky-top">
        <div class="container">
            <a class="navbar-brand" href="/"><img class="d-inline-block align-middle me-1" src="./img/title.png" alt="" width="20" height="20"> <b class="d-inline-block align-middle">SIPTADIK</b></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Kontak</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Bantuan</a>
                    </li>
                    <!-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Menu
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="admin.php">Admin</a></li>
                            <li><a class="dropdown-item" href="tamu.php">Tamu</a></li>
                            <li><a class="dropdown-item" href="riwayat.php">Riwayat</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="detail.php">Profil</a></li>
                            <li><a class="dropdown-item" href="pejabat.html">Pejabat</a></li>
                        </ul>
                    </li> -->
                </ul>
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item">
                        <span class="nav-link">Akun: <b><?=$_SESSION['user'] ?? "###"?></b></span>
                    </li>
                </ul>
                    <a href="keluar.php" class="btn bg-danger text-light" id="tbl-keluar">Keluar</a>
            </div>
        </div>
    </nav>
    <!-- NAVBAR END HERE -->
<?php
date_default_timezone_set("Asia/Makassar");
setlocale(LC_ALL, 'id_ID');
session_start();
include "layout/f.php";
// KONSTANTA
define("JUDUL", "SIPTADIK");
define("TAGLINE", "Sistem Informasi Tamu");
define("DEVLINK", "https://www.google.com/");

if (!isset($_SESSION['user'])) {
    unset($_SESSION['user']);
    unset($_SESSION['pass']);
    unset($_SESSION['role']);
    $_SESSION['temp'] = "Silakan masuk terlebih dahulu!";
    pindahko("/");
    exit;
}

$role = $_SESSION['role'] == 1 ? "Admin" : ($_SESSION['role'] == 2 ? "Piket/Tamu" : ($_SESSION['role'] == 3 ? "Pejabat" : "Unknown"));
$dataBidang = $_SESSION['data']['dataBidang'];

function convert_bidang($kodebidang)
{
    $dataBid = $_SESSION['data']['dataBidang'];
    foreach ($dataBid as $isi) {
        if (preg_match('/s/', $kodebidang) == 0 && preg_match('/b/', $kodebidang) == 1) { // apakah kode bidang?
            if ($kodebidang == $isi[0]) {
                return $isi[1];
            }
        } elseif (preg_match('/b\d+s\d+/', $kodebidang, $hasil) == 1) { //apakah kode subbidang?
            if ($isi[2] == $hasil[0]) {
                return $isi[3];
            }
        } elseif (preg_match('/.d/', $kodebidang, $kd) == 1) { // apakah kode kadis atau sekdis?
            if ($isi[4] == $kd[0]) {
                return $isi[5];
            } elseif ($isi[4] == $kd[0]) {
                return $isi[5];
            }
        } elseif (preg_match('/j\d+/', $kodebidang, $arrJabatan) == 1) { //apakah kode jabatan?
            if ($isi[4] == $arrJabatan[0]) {
                return $isi[5];
            }
        }
    }
    return;
}
?>
<html class="h-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv='cache-control' content='no-cache'>
    <meta http-equiv='expires' content='0'>
    <meta http-equiv='pragma' content='no-cache'>
    <link rel="icon" href="favicon.ico">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/custom.css" rel="stylesheet">
    <link href="assets/css/riwayat.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/icons.css">
    <link rel="stylesheet" href="assets/css/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="assets/DataTables-1.11.3/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" type="text/css" href="assets/Buttons-2.0.1/css/buttons.bootstrap5.min.css" />
    <link rel="stylesheet" type="text/css" href="assets/DateTime-1.1.1/css/dataTables.dateTime.min.css" />
    <link rel="stylesheet" type="text/css" href="assets/SearchPanes-1.4.0/css/searchPanes.bootstrap5.min.css" />

    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery.js"></script>
    <script type="text/javascript" src="assets/JSZip-2.5.0/jszip.min.js"></script>
    <script type="text/javascript" src="assets/pdfmake-0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="assets/pdfmake-0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="assets/DataTables-1.11.3/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="assets/DataTables-1.11.3/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript" src="assets/Buttons-2.0.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="assets/Buttons-2.0.1/js/buttons.bootstrap5.min.js"></script>
    <script type="text/javascript" src="assets/Buttons-2.0.1/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="assets/DateTime-1.1.1/js/dataTables.dateTime.min.js"></script>
    <script type="text/javascript" src="assets/SearchPanes-1.4.0/js/dataTables.searchPanes.min.js"></script>
    <script type="text/javascript" src="assets/SearchPanes-1.4.0/js/searchPanes.bootstrap5.min.js"></script>
    <script src="https://github.com/justadudewhohacks/face-api.js/blob/master/dist/face-api.min.js"></script>
    <title><?= $title ?? "Halaman" ?> | <?= JUDUL ?></title>
    <script>
        $(document).ready(function() {
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myList .col").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
</head>

<body class="d-flex flex-column h-100">

    <!-- MODAL DETAIL PIKET -->
    <div class="modal fade" id="detail-piket" tabindex="-1" aria-hidden="true" style="z-index: 1057;">
        <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title">Detail Piket: Nama Piket</h5>
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
                            <th width="59%">Nama Piket</th>
                        </tr>
                        <tr>
                            <th>Register</th>
                            <td>:</td>
                            <td>123456</td>
                        </tr>
                        <tr>
                            <th>Anjab</th>
                            <td>:</td>
                            <td>Qwertyuiop</td>
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

    <!-- NAVIGATION BAR (NAVBAR) -->
    <nav class="navbar navbar-expand-lg navbar-light warna-dasar sticky-top">
        <div class="container">
            <a class="navbar-brand" href="/"><img class="d-inline-block align-middle me-1" src="./img/title.png" alt="" width="20" height="20"> <b class="d-inline-block align-middle"><?= JUDUL ?></b></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    <?php
                    // HIDE BERANDA FROM USER ROLE 2 (PIKET)
                    if ($_SESSION['role'] != 2) {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/">Beranda</a>
                        </li>
                    <?php
                    }
                    ?>

                    <?php
                    // MENU KHUSUS UNTUK USER ROLE 1 (ADMIN)
                    if ($_SESSION['role'] == 1 && $title == "Admin") {
                    ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Tambah
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalTambahPejabat">Pejabat</a></li>
                                <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal_tambah_piket">Piket</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Pengaturan
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#slider_edit">Slider</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal_bidang_edit">Bidang</a></li>
                                <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal_subbidang_edit">Sub-Bidang</a></li>
                                <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal_jabatan_edit">Jabatan</a></li>
                            </ul>
                        </li>
                        <a class="nav-link" href="riwayat.php">Riwayat</a>
                    <?php
                    }
                    ?>

                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modal_kontak">Kontak</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modal_bantuan">Bantuan</a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link text-danger" onclick="tanya_simpan('Perhatian', 'Yakin akan keluar?', 'keluar')">Keluar</a>
                    </li>
                </ul>
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <?php if ($_SESSION['role'] == 1 && $title == "Admin") { ?>
                        <section>
                            <input id="myInput" class="form-control" type="text" placeholder="Cari Pejabat">
                        </section>
                    <?php } ?>
                    <li class="nav-item">
                        <!-- <i><small class="nav-link text-muted">Akun: <b><?= $role ?></b></small></i> -->
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- MODAL KONTAK -->
    <div class="modal fade" id="modal_kontak" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form class="m-0 p-0" method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="bi bi-info-circle-fill"></i> Kontak</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- ISI MODAL START HERE -->

                        <div class="row px-3 kontak">
                            <div class="col-lg-7 contact-form_wrapper p-5 order-lg-1">
                                <form action="#" class="contact-form form-validate" novalidate="novalidate">
                                    <div class="row">
                                        <div class="col-sm-12 mb-3">
                                            <div class="form-group">
                                                <label class="required-field mb-1" for="kontak_nama">Nama</label>
                                                <input type="text" class="form-control" id="kontak_nama" name="kontak_nama" placeholder="Nama lengkap">
                                            </div>
                                        </div>

                                        <div class="col-sm-6 mb-3">
                                            <div class="form-group">
                                                <label class="required-field mb-1" for="kontak_email">Email</label>
                                                <input type="text" class="form-control" id="kontak_email" name="kontak_email" placeholder="email_saya@gmail.com">
                                            </div>
                                        </div>

                                        <div class="col-sm-6 mb-3">
                                            <div class="form-group">
                                                <label class="mb-1" for="kontak_hp">Nomor HP</label>
                                                <input type="tel" class="form-control" id="kontak_hp" name="kontak_hp" placeholder="0812-3456-7890">
                                            </div>
                                        </div>

                                        <div class="col-sm-12 mb-3">
                                            <div class="form-group">
                                                <label class="required-field mb-1" for="kontak_pesan">Apa yang ingin kamu sampaikan?</label>
                                                <textarea class="form-control" id="kontak_pesan" name="kontak_pesan" rows="4" placeholder="Halo, saya mau tanya ..."></textarea>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 mb-3">
                                            <button type="submit" name="kontak_kirim" class="btn btn-primary">Kirim</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="col-lg-5 contact-info_wrapper gradient-brand-color p-5 order-lg-2">
                                <h3 class="color--white mb-5">Hubungi kami</h3>

                                <ul class="contact-info_list list-style-none position-relative z-index-101 m-0 p-0">
                                    <li class="mb-4 ps-4">
                                        <span class="position-absolute"><i class="bi bi-envelope-fill"></i></span> <a href="mailto:hadi@mohpoe.com" target="_blank" class="text-light">hadi@mohpoe.com</a>
                                    </li>
                                    <li class="mb-4 ps-4">
                                        <span class="position-absolute"><i class="bi bi-whatsapp"></i></span> <a href="https://wa.me/+6288804263785" target="_blank" class="text-light">+62 888-0426-3785</a>
                                    </li>
                                    <li class="mb-4 ps-4">
                                        <span class="position-absolute"><i class="bi bi-geo-alt-fill"></i></span> <b>Syuaib Technologies Services</b>.
                                        <br> Jl. Andi Cammi, Kota Pare-pare
                                        <br> Sulawesi Selatan, Indonesia

                                        <div class="mt-3">
                                            <a href="https://www.google.com/maps" target="_blank" class="text-link text-white">Buka di peta <i class="bi bi-signpost-split-fill"></i></a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <!-- End Contact Form Wrapper -->

                        </div>

                        <!-- ISI MODAL END HERE -->
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL BANTUAN -->
    <div class="modal fade" id="modal_bantuan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form class="m-0 p-0" method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="bi bi-question-circle-fill"></i> Bantuan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- ISI MODAL START HERE -->

                        <div class="accordion" id="faq_bantuan">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="faq_1_head">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq_1" aria-expanded="true" aria-controls="faq_1">
                                        Apa itu SIPTADIK?
                                    </button>
                                </h2>
                                <div id="faq_1" class="accordion-collapse collapse show" aria-labelledby="faq_1_head" data-bs-parent="#faq_bantuan">
                                    <div class="accordion-body">
                                        <strong>SIPTADIK</strong> atau yang bisa disebut sebagai Sistem Informasi Pembukuan Tamu Disdik merupakan sebuah aplikasi yang digunakan dalam mengelola informasi tamu yang berkunjung, dan memudahkan proses pelayanan kepada tamu di Dinas Pendidikan.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="faq_2_head">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq_2" aria-expanded="false" aria-controls="faq_2">
                                        Bagaimana sistem kerja SIPTADIK?
                                    </button>
                                </h2>
                                <div id="faq_2" class="accordion-collapse collapse" aria-labelledby="faq_2_head" data-bs-parent="#faq_bantuan">
                                    <div class="accordion-body">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut semper lectus condimentum quam varius porta. Integer gravida sapien vitae semper rhoncus. Mauris nibh magna, lacinia id quam vitae, efficitur tincidunt mi. Cras felis urna, semper non malesuada at, tempus non diam. Pellentesque sapien lectus, congue in dignissim vitae, auctor eu metus. Phasellus ultrices efficitur augue, ut pharetra ante interdum sed. Mauris convallis quam eget urna tempor, non porttitor ex lobortis. Etiam sit amet tellus in orci suscipit volutpat. Nulla ornare ultricies varius. Nulla ut tristique mi. Nam elementum risus quam, eget pretium est ultrices quis. Pellentesque lobortis laoreet elit, vel sagittis urna finibus eget. Morbi blandit vitae lorem id facilisis. Mauris varius rhoncus scelerisque. Suspendisse feugiat purus in felis tristique, vel dictum nisl scelerisque. Donec sed arcu ac enim auctor dapibus.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        Bagaimana cara menambahkan pengguna?
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faq_bantuan">
                                    <div class="accordion-body">
                                        In volutpat magna sapien, sit amet mattis ligula viverra sit amet. Phasellus accumsan ullamcorper risus, a accumsan dui tristique sit amet. Sed at justo placerat, maximus erat ullamcorper, condimentum ex. Nunc risus quam, euismod id ullamcorper ac, vehicula a est. Phasellus vitae dictum ipsum. Maecenas porttitor dictum nunc, vitae luctus tortor feugiat quis. Curabitur non porttitor metus. Ut maximus velit a arcu tristique consequat. Ut finibus, dolor ut tempus tincidunt, nulla lorem auctor nulla, non ornare odio erat quis arcu.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ISI MODAL END HERE -->
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL WARNING -->
    <div class="modal fade" id="modalWarning" tabindex="-1" aria-labelledby="judulModal" aria-hidden="true" style="z-index: 1057;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="judulModal"></h5>
                </div>
                <div class="modal-body">
                    <div id="isiModal"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="tblModalWarning">Ya</button>
                </div>
            </div>
        </div>
    </div>

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

    <!-- NOTIFIKASI -->
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1080">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header bg-warning">
                <strong class="me-auto">SIPTADIK</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                <div id="pesanNotif"></div>
            </div>
        </div>
    </div>
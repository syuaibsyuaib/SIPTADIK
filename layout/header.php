<?php
date_default_timezone_set("Asia/Makassar");
setlocale(LC_ALL, 'id_ID');

session_start();
if (!isset($_SESSION['user'])) {
    unset($_SESSION['user']);
    unset($_SESSION['pass']);
    unset($_SESSION['role']);
    $_SESSION['temp'] = "Silakan masuk terlebih dahulu!";
    pindahko("masuk.php");
    exit;
}

$role = $_SESSION['role'] == 1 ? "Admin" : ($_SESSION['role'] == 2 ? "Piket/Tamu" : ($_SESSION['role'] == 3 ? "Pejabat" : "Unknown"));

function array_search_multi($array, $key, $value, $parent = false)
{
    $results = array();

    if (is_array($array)) {
        if (isset($array[$key]) && $array[$key] == $value)
            $results[] = $array;

        foreach ($array as $id => $subarray) {
            $found = array_search_multi(
                $subarray,
                $key,
                $value
            );

            if (!empty($found)) {
                if ($parent) {
                    $results[$id] =
                        $array[$id];
                } else {
                    $results = $found;
                }
            }
        }
    }

    return $results;
}

// Redirect function
function pindahko($header_location)
{
    echo "<meta http-equiv='refresh' content='0; url=" . $header_location . "' />";
}

// Fungsi encrypt dan decrypt
function encrypt_decrypt($action, $string)
{
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $secret_key = 'T9UHzUwCaSebahyV';
    $secret_iv = 'hDDbC6AWaGn52CBa';
    // hash
    $key = hash('sha256', $secret_key);

    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    if ($action == 'e') {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    } else if ($action == 'd') {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
    return $output;
}
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
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery.js"></script>
    <title>
        <?= $title ?? "Halaman" ?> | SIPTADIK
    </title>
    <style>
        .gradient-brand-color {
            background-image: -webkit-linear-gradient(0deg, #376be6 0%, #6470ef 100%);
            background-image: -ms-linear-gradient(0deg, #376be6 0%, #6470ef 100%);
            color: #fff;
        }

        .contact-info_wrapper {
            overflow: hidden;
            border-radius: 0 .625rem .625rem 0;
            border: 1px solid #376be6;
        }

        .contact-info_list span.position-absolute {
            left: 0;
            margin-top: 5px;
        }

        .z-index-101 {
            z-index: 101;
        }

        .list-style-none {
            list-style: none;
        }

        .contact-form_wrapper {
            border-radius: .625rem 0 0 .625rem;
            border-top: 1px solid #376be6;
            border-left: 1px solid #376be6;
            border-bottom: 1px solid #376be6;
        }

        .kontak a {
            text-decoration: none;
        }

        .kontak a:hover {
            text-decoration: underline;
        }
    </style>

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
                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#modal_kontak">Kontak</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#modal_bantuan">Bantuan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-danger" onclick="tanya_simpan('Yakin akan keluar?', 'keluar')">Keluar</a>
                    </li>

                    <?php
                    // if ($_SESSION['role'] == 2) {
                    ?>
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#modal_loading">Demo Loading</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="?notif=1">Demo Notif</a>
                        </li> -->
                    <?php
                    // }
                    ?>

                </ul>
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item">
                        <i><small class="nav-link text-muted">Akun: <b><?= $role ?></b></small></i>
                    </li>
                </ul>
                <!-- <a href="keluar.php" class="btn bg-danger text-light" id="tbl-keluar">Keluar</a> -->
            </div>
        </div>
    </nav>
    <!-- NAVBAR END HERE -->

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

    <!-- MODAL WARNING DAN LOADING -->
    <div class="modal fade" id="modalWarning" tabindex="-1" aria-labelledby="modalTes" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="staticBackdropLabel">Perhatian</h5>
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


    <div class="modal" id="modalLoading" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal_loading_label" aria-hidden="true">
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
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
	<div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
		<div class="toast-header bg-success text-white">
			<strong class="me-auto">SIPTADIK</strong>
			<button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
		</div>
		<div class="toast-body">
			<div id="pesanNotif"></div>
		</div>
	</div>
</div>
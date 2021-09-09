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

                    <?php
                    if ($_SESSION['role'] == 2) {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#modal_loading">Demo Loading</a>
                        </li>
                    <?php
                    }
                    ?>

                </ul>
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item">
                        <span class="nav-link">Akun: <b><?= $role ?></b></span>
                    </li>
                </ul>
                <a href="keluar.php" class="btn bg-danger text-light" id="tbl-keluar">Keluar</a>
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
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur hendrerit eu augue in aliquet. Cras rutrum, est in ornare luctus, augue velit vulputate ex, sit amet molestie lectus massa eleifend odio. Fusce id leo arcu. Morbi eu consequat felis. Praesent tempor leo mauris, in tincidunt est finibus vitae. Praesent risus arcu, molestie non enim non, commodo egestas arcu. Aenean malesuada dolor sed libero porta, mollis viverra risus pretium. Sed et felis mollis magna sodales viverra eu et tellus. Cras viverra viverra sapien, at euismod dolor. Mauris sed metus nec justo lacinia rutrum. Etiam gravida nec nibh at facilisis. Phasellus vestibulum eros nulla, non sodales tortor interdum sed. Suspendisse potenti. Phasellus et mauris condimentum, interdum lectus id, fermentum massa.</p>

                        <p>Integer molestie lectus justo. Suspendisse potenti. Nam in odio nunc. Etiam ac lacus suscipit, vehicula diam eu, malesuada risus. Maecenas et faucibus nulla, quis elementum ligula. Nunc convallis nisl at venenatis placerat. Nullam egestas luctus lacus id eleifend. Morbi sit amet ipsum faucibus, lacinia massa sit amet, pulvinar erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Sed ut vestibulum felis, at luctus libero. Nullam tincidunt, sem vitae elementum tincidunt, est magna tincidunt nulla, nec dignissim sem ex a lectus.</p>

                        <p>Suspendisse tincidunt arcu urna, vitae luctus felis posuere vel. Vivamus at augue eu erat imperdiet tristique ut eu tortor. Phasellus at sem neque. Cras eget augue nec orci dapibus fermentum quis nec tortor. Curabitur sapien lectus, pharetra at augue vitae, pellentesque mattis quam. Curabitur egestas, dui ac laoreet elementum, massa orci elementum massa, luctus semper nisi velit non enim. Donec mattis lobortis consectetur. Etiam ut nibh vulputate, vehicula lorem a, bibendum nunc. Nunc pellentesque eros tincidunt, tincidunt mi quis, bibendum lectus.</p>

                        <p>Proin a turpis eget augue aliquet porta ac quis ex. Aliquam tempus lorem et felis lobortis lobortis. Vivamus eu gravida odio. Aenean pharetra aliquam lacus eu feugiat. Suspendisse tempus ex et ex vehicula, id tempus sem sagittis. Cras viverra ac urna quis ullamcorper. Donec finibus felis nisl, ac semper mauris interdum ut. Proin eget lorem ac ipsum hendrerit condimentum eu et lacus. Donec ultricies rutrum quam, nec molestie neque commodo lacinia. Quisque condimentum eget justo quis dignissim. Fusce ut metus sem.</p>

                        <p>Donec vehicula urna ac nulla facilisis pretium. Suspendisse condimentum ornare orci in bibendum. Nunc non dui eu turpis lacinia porta. Donec gravida a purus nec pretium. Nullam aliquam turpis eu bibendum tempor. Curabitur odio erat, suscipit ac sagittis id, pretium sed ligula. Vestibulum fermentum turpis et felis accumsan, et tincidunt sapien mattis. Suspendisse nec arcu ac est bibendum pulvinar. Vivamus at magna ut ante sodales vulputate. Integer dictum id odio eget porta. Quisque sodales rhoncus odio, vel consequat massa consequat porttitor. Interdum et malesuada fames ac ante ipsum primis in faucibus.</p>
                        <!-- ISI MODAL END HERE -->
                    </div>
                </form>
            </div>
        </div>
    </div>
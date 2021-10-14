<?php
session_start();
date_default_timezone_set("Asia/Makassar");
setlocale(LC_ALL, 'id_ID');
include "layout/f.php";

// var_dump(session_id());
if (!isset($_SESSION['role'])) {
    header("Location: /");
    unset($_SESSION['user']);
    unset($_SESSION['pass']);
};

if (isset($_POST['masuk'])) {
    $pengguna = $_POST['pengguna'];
    $sandi = $_POST['sandi'];
    masuk($pengguna, $sandi);
}

// dari page tamu
if (isset($_POST['kirimTamu'])) {
    $subBidangTujuan = isset($_POST['subBidangTujuan']) ? $_POST['subBidangTujuan'] : '';

    $namaTamu = $_POST['namaTamu'];
    $nipTamu = $_POST['nipTamu'];
    $asalTamu = $_POST['asalTamu'];
    $bidangTujuan = $_POST['bidangTujuan'];
    $jabatanTujuan = $_POST['jabatanTujuan'];
    $tujuan = $_POST['tujuan'];

    $dataTamu = array("dataTambah" => array(time(), $namaTamu, $nipTamu, $asalTamu, $bidangTujuan, $subBidangTujuan, $jabatanTujuan, $tujuan, timestamp(), $_SESSION['user']), "foto" => array($_POST['fotoPhp']));

    $res = kirim($dataTamu);
    if (!$res) {
        return print($res);
    } else {
        return 'Error';
    }
}

//dari admin tambah pejabat
if (isset($_POST['tambahPejabat'])) {
    $subBidang =  $_POST['subbidang'];
    if (!$_POST['subbidang']) {
        $subBidang = "";
    }
    $dataUser = array("type" => "tambahUser", "dataTambah" => array($_POST['username'], $_POST['password'], $_POST['bidang'], $subBidang, $_POST['jabatan'], $_POST['nama'], $_POST['nip'], $_POST['nohp'], $_POST['alamat']), "foto" => array($_POST['foto']));

    $resTambahPejabat = kirim($dataUser, 1);

    if ($resTambahPejabat == "Username sudah ada") {
        return print('Username sudah digunakan');
    }

    unset($_SESSION['data']);
    $_SESSION['data'] = $resTambahPejabat;

    segarkan($_SESSION['user'], $_SESSION['pass']);
    return print(json_encode($resTambahPejabat));
}

//dari ubah pejabat
if (isset($_POST['ubahPejabat'])) {
    $subBidang = "";
    $foto = "";
    if ($_POST['subbidang']) {
        $subBidang =  $_POST['subbidang'];
    }
    if($_POST['foto']){
        $foto = $_POST['foto'];
    }
    $pass = $_POST['sandi'] == "" ? array_search_multi($_SESSION['data']['dataUser'], 0, $_POST['usernamePejabat'], false)[0][1] : $_POST['sandi'];
    $dataUbahPejabat = array("type" => "ubahPejabat", "usernamePejabat" => $_POST['usernamePejabat'], "dataTambah" => array($_POST['bidang'], $subBidang, $_POST['jabatan'], $_POST['nama'],  $pass, $_POST['nip'],  $_POST['nohp'], $_POST['alamat']), "foto" => array($foto));

    $resUbahPejabat = kirim($dataUbahPejabat, 1);

    unset($_SESSION['data']);
    $_SESSION['data'] = $resUbahPejabat;

    segarkan($_SESSION['user'], $_SESSION['pass']);
    return print(json_encode($resUbahPejabat));
}

// HAPUS
if (isset($_POST['hapus'])) {
    $hapus = array("type" => "hapusUser", "usernameHapus" => $_POST['hapus']);
    $resHapus = kirim($hapus, 1);
    segarkan($_SESSION['user'], $_SESSION['pass']);
    return print(json_encode($resHapus));
}

//SLIDE
if(isset($_POST['ubahSlide'])){
    $slideArr = array("type" => "ubahSlide", "dataTambah" => array([$_POST['slider_1']], [$_POST['slider_2']], [$_POST['slider_3']], [$_POST['slider_4']], [$_POST['slider_5']]));
    $resSlide = kirim($slideArr, 1);
    segarkan($_SESSION['user'], $_SESSION['pass']);
    return print(json_encode($resSlide));
}

if(isset($_POST['tambahPiket'])){
    $piket = array();
    for ($i=0; $i < count($_POST); $i++) { 
        if($_POST['username' . $i]){
            array_push($piket, $_POST['username' . $i], $_POST['pass' . $i]);
        }
    }
    $tambahPiket = array("type" => "tambahPiket", "dataTambah" => $piket);
    $resPiket = kirim($tambahPiket, 1);
    segarkan($_SESSION['user'], $_SESSION['pass']);
    return print(json_encode($resPiket));
}
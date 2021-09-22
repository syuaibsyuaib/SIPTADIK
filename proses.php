<?php
session_start();
date_default_timezone_set("Asia/Makassar");
setlocale(LC_ALL, 'id_ID');

function timestamp()
{
    $tgl = getDate()['mday'] . "_" . getDate()['mon'] . "_" . getDate()['year'] . "_" . getDate()['hours'] . "_" . getDate()['minutes'] . "_" . getDate()['seconds'];
    return $tgl;
}
// var_dump(session_id());
if (!isset($_SESSION['role'])) {
    header("Location: /");
    unset($_SESSION['user']);
    unset($_SESSION['pass']);
};

if (isset($_POST['masuk'])) {
    $pengguna = $_POST['pengguna'];
    $sandi = $_POST['sandi'];

    $data = array("pengguna" => $pengguna, "sandi" => $sandi);
    $hasil = kirim($data);

    if ($hasil || $hasil != NULL) {
        $_SESSION['user'] = $pengguna;
        $_SESSION['pass'] = $sandi;
        $_SESSION['role'] = $hasil["role"];
        $_SESSION['data'] = $hasil;

        if ($hasil["role"] == 1) {
            header("Location: admin.php");
        } elseif ($hasil["role"] == 2) {
            header("Location: tamu.php");
        } elseif ($hasil["role"] == 3) {
            header("Location: pejabat.html");
        }
    } else {
        header("Location: /");
    }
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
        return print('Terjadi kesalahan');
    }else{
        return sukses();
    }
    
}

//dari admin tambah pengguna
if (isset($_POST['tambahUser'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $foto = $_POST['foto'];
    $nama = $_POST['nama'];
    $nip = $_POST['nip'];
    $bidang = $_POST['bidang'];
    $subbidang = $_POST['subbidang'];
    $jabatan = $_POST['jabatan'];
    $nohp = $_POST['nohp'];
    $alamat = $_POST['alamat'];

    $dataUser = array("dataTambah" => array("tambah user",  $password, $username, $bidang, $subbidang, $jabatan, $nama, $nip, $nohp, $alamat), "foto" => array($foto));

    $res = kirim($dataUser);

    if ($res == "Username sudah ada") {
        return print('Username sudah digunakan');
    } 
    unset($_SESSION['data']);
    $_SESSION['data'] = $res;
    
    return print(json_encode($res));
    
}

function sukses()
{
    return print('sukses');
}

function kirim($dataArr)
{
    $url = "https://script.google.com/macros/s/AKfycbx6QxaoEdDJf8e9zItLDwD6Oq6er4L8cnknO2ET2E-mBxK2QqM/exec";

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    // curl_setopt($curl, CURLOPT_HEADER, true);

    $headers = array(
        "Content-Type: application/json",
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    if (isset($_SESSION['user'])) {
        $dataArr += ["role" => $_SESSION['role'], "pengguna" => $_SESSION['user'], "sandi" => $_SESSION['pass']];
    }

    $data = json_encode($dataArr);

    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

    //for debug only!
    // curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    // curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    $resp = curl_exec($curl);
    $hasil = json_decode($resp, true);
    curl_close($curl);
    
    return $hasil;
}

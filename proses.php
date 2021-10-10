<?php
session_start();
date_default_timezone_set("Asia/Makassar");
setlocale(LC_ALL, 'id_ID');

// FUNGSI PENCARIAN UNTUK ARRAY
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

function timestamp()
{
    $tgl = getDate()['mday'] . "_" . getDate()['mon'] . "_" . getDate()['year'] . "_" . getDate()['hours'] . "_" . getDate()['minutes'] . "_" . getDate()['seconds'];
    return $tgl;
}

function masuk($pengguna, $sandi)
{
    unset($data);
    $data = array("pengguna" => $pengguna, "sandi" => $sandi);

    $hasil = kirim($data, null);

    if ($hasil || $hasil != NULL) {
        $_SESSION['user'] = $pengguna;
        $_SESSION['pass'] = $sandi;
        $_SESSION['role'] = $hasil["role"];
        $_SESSION['data'] = $hasil;

        if ($hasil["role"] == 1) {
            header("Location: admin.php");
            exit;
        } elseif ($hasil["role"] == 2) {
            header("Location: tamu.php");
            exit;
        } elseif ($hasil["role"] == 3) {
            header("Location: pejabat.html");
            exit;
        }
    } else {
        header("Location: /");
        exit;
    }
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

    masuk($_SESSION['user'], $_SESSION['pass']);
    return print(json_encode($resTambahPejabat));
}

//dari ubah pejabat
if (isset($_POST['ubahPejabat'])) {
    $subBidang = "";
    if ($_POST['subbidang']) {
        $subBidang =  $_POST['subbidang'];
    }
    $pass = $_POST['sandi'] == "" ? array_search_multi($_SESSION['data']['dataUser'], 0, $_POST['usernamePejabat'], false)[0][1] : $_POST['sandi'];
    $dataUbahPejabat = array("type" => "ubahPejabat", "usernamePejabat" => $_POST['usernamePejabat'], "dataTambah" => array($_POST['bidang'], $subBidang, $_POST['jabatan'], $_POST['nama'],  $pass, $_POST['nip'],  $_POST['nohp'], $_POST['alamat']), "foto" => array($_POST['foto']));

    $resUbahPejabat = kirim($dataUbahPejabat, 1);

    unset($_SESSION['data']);
    $_SESSION['data'] = $resUbahPejabat;

    masuk($_SESSION['user'], $_SESSION['pass']);
    return print(json_encode($resUbahPejabat));
}

// HAPUS
if (isset($_POST['hapus'])) {
    $hapus = array("type" => "hapusUser", "usernameHapus" => $_POST['hapus']);
    $resHapus = kirim($hapus, 1);
    masuk($_SESSION['user'], $_SESSION['pass']);
    return print(json_encode($resHapus));
}

function kirim($dataArr, $role = 2)
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
        $dataArr += ["role" => $role, "pengguna" => $_SESSION['user'], "sandi" => $_SESSION['pass']];
    }

    $dataFinal = json_encode($dataArr);

    curl_setopt($curl, CURLOPT_POSTFIELDS, $dataFinal);

    //for debug only!
    // curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    // curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    $resp = curl_exec($curl);
    $hasil = json_decode($resp, true);
    curl_close($curl);
    // var_dump($hasil);
    return $hasil;
}

<?php
session_start();
var_dump(session_id());
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
        } else {
            header("Location: /");
        }
    } else {
        header("Location: /");
    }
} else {
    header("Location: /");
}

////dari page tamu
if (isset($_POST['tamu'])) {
    $dataTamu = array("role" => "tamu", "namaTamu"=> $_POST['namaTamu'], "nipTamu" => $_POST['nipTamu'], "asalTamu" => $_POST['asalTamu'], "bidangTujuan" => $_POST['bidangTujuan'], "subBidangTujuan" => $_POST['subBidangTujuan'], "jabatanTujuan" => $_POST['jabatanTujuan'], "tujuan" => $_POST['tujuan'], "foto" => $_POST['foto']);
    kirim($dataTamu);
};

function kirim($dataArr){
    $url = "https://script.google.com/macros/s/AKfycbx6QxaoEdDJf8e9zItLDwD6Oq6er4L8cnknO2ET2E-mBxK2QqM/exec";
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $headers = array(
        "Content-Type: application/json",
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    $dataArr += ["sesi" => session_id()];
    $data = json_encode($dataArr);

    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

    //for debug only!
    // curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    // curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    $resp = curl_exec($curl);
    curl_close($curl);
    $hasil = json_decode($resp, true);
    return $hasil;
}

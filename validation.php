<?php
session_start();
if (!isset($_SESSION['user'])) {
    unset($_SESSION['user']);
    unset($_SESSION['pass']);
    unset($_SESSION['role']);
    $_SESSION['temp'] = "Silakan masuk terlebih dahulu!";
    header("Location: masuk.php");
    exit;
}

// FUNCTION START

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

// FUNCTION END

// $pengguna = $_SESSION['user'];
// $sandi = $_SESSION['pass'];

// $data = array("pengguna" => $pengguna, "sandi" => $sandi);
// $hasil = kirim($data);
// if ($hasil || $hasil != NULL) {
//     unset($_SESSION['data']);
//     $_SESSION['data'] = $hasil;
// }
?>
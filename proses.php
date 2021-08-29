<?php
// if (isset($_POST['masuk'])) {
//     $pengguna = $_POST['pengguna'];
//     $sandi = $_POST['sandi'];
//     if ($pengguna == "admin" && $sandi == "admin") {
//         header("location: admin.html");
//     } elseif ($pengguna == "piket" && $sandi == "piket") {
//         header("location: tamu.html");
//     } else {
//         header("location: index.html");
//     }
// }

if (isset($_POST['masuk'])) {
    $pengguna = $_POST['pengguna'];
    $sandi = $_POST['sandi'];

    $url = "https://script.google.com/macros/s/AKfycbx6QxaoEdDJf8e9zItLDwD6Oq6er4L8cnknO2ET2E-mBxK2QqM/exec";
    $data = json_encode(array("pengguna" => $pengguna, "sandi" => $sandi));
    $options = array(
        "http" => array(
            "method" => "POST",
            "header" => "Content-Type: application/json",
            "content" => $data
        )
    );
    // $context = stream_context_create($options)
    $result = file_get_contents($url, false, stream_context_create($options));
    $res = json_decode($result, true);
    if($res){
        $_SESSION['user'] = $res["pengguna"];
        $_SESSION['pass'] = $res["sandi"];
        $_SESSION['role'] = $res["role"];
    }
    echo $res["pengguna"] . "<br>";
    echo $res["sandi"];
}

?>
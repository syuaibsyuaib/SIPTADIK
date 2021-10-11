<?php
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

// FUNSI PENCARIAN UNTUK ARRAY
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

// FUNGSI REDIRECT
function pindahko($header_location)
{
    echo "<meta http-equiv='refresh' content='0; url=" . $header_location . "' />";
}
// FUNGSI ENCRYPT DAN DECRYPT
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
            pindahko("admin.php");
            exit;
        } elseif ($hasil["role"] == 2) {
            pindahko("tamu.php");
            exit;
        } elseif ($hasil["role"] == 3) {
            pindahko("pejabat.html");
            exit;
        }
    } else {
        pindahko("/");
        exit;
    }
}

function segarkan($a, $b)
{
    $data = array("pengguna" => $a, "sandi" => $b);
    $hasil = kirim($data, null);

    if ($hasil || $hasil != NULL) {
        $_SESSION['data'] = $hasil;
    } else {
        pindahko("/");
        exit;
    }
}

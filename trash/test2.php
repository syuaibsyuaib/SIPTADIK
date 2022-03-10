<?php

if (isset($_POST['tambah-wajah'])) {
    $img = $_POST['image'];
    $folderPath = "cuncung/";

    $image_parts = explode(";base64,", $img);
    $image_type_aux = explode("image/", $image_parts[0]);
    $image_type = $image_type_aux[1];

    $image_base64 = base64_decode($image_parts[1]);
    $fileName = uniqid() . '.png';

    $file = $folderPath . $fileName;
    file_put_contents($file, $image_base64);

    print_r($fileName);
}

$path = "images/rrr/";
$myFile = [];
if ($handle = opendir($path)) {
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
            if (!is_dir($entry)) {
                $myFile[] = substr($entry, 0, strrpos($entry, "."));
            }
        }
    }
    closedir($handle);
}

// print_r($myFile);
// echo (max($myFile) + 1);
echo count($myFile);
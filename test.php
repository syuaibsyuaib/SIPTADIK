<?php

session_start();

$user = $_SESSION['user'] ?? "";
$pass = $_SESSION['pass'] ?? "";
$role = $_SESSION['role'] ?? "";
$temp = $_SESSION['temp'] ?? "";

echo "$user $pass $role $temp";

?>
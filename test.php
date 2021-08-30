<?php

session_start();

$user = $_SESSION['user'];
$pass = $_SESSION['pass'];
$role = $_SESSION['role'];

echo "$user $pass $role";

?>
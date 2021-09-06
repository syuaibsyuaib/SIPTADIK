<?php
session_start();
session_destroy();
setcookie("fotoTamu", "", time() - 3600);
header("Location: /");
?>
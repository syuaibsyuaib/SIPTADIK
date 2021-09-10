<?php
session_start();
session_destroy();
header("Location: /");
exit;
?>
<meta http-equiv='refresh' content='0; url=/' />
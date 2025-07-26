<?php
session_start();
session_unset();
session_destroy();
header('Location: login.php'); // oder wohin du nach dem Logout willst
exit;
?>
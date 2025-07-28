// protect.php
<?php
session_start();
if (empty($_SESSION['admin'])) {
  header('Location: login.php?timeout=1');
  exit;
}
?>
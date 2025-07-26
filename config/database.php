<?php
$mysqli = new mysqli(
  $_ENV['DB_HOST'],
  $_ENV['DB_USER'],
  $_ENV['DB_PASS'],
  $_ENV['DB_NAME'],
  $_ENV['DB_PORT']
);

if ($mysqli->connect_errno) {
  header('Content-Type: application/json');
  echo json_encode([
    'error'   => 'DB-Verbindung fehlgeschlagen',
    'message' => $mysqli->connect_error
  ]);
  exit;
}

$mysqli->set_charset('utf8mb4');
?>
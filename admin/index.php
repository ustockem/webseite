<?php

// Zugriffsschutz & Session-Check
require_once '../config/session.php';
require_once '../config/protect.php';

if (!isAdmin()) {
  header('Location: ../index.php');
  exit;
}

// Optional: Weitere Konfigs laden
require_once '../config/config.php';
require_once '../inc/header.php';
?>

<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <title>Admin-Dashboard</title>
  <link rel="stylesheet" href="../styles/admin.css">
</head>
<body>
  <main>
    <h1>👋 Willkommen im Adminbereich</h1>
    <p>Du bist als <strong>Admin</strong> angemeldet.</p>

    <section class="nav-boxes">
      <a href="users.php">Benutzer verwalten</a>
      <a href="questions.php">Quiz-Fragen bearbeiten</a>
      <a href="logout.php">Logout</a>
    </section>
  </main>
</body>
</html>

<?php require_once '../inc/footer.php'; ?>
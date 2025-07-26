<?php
require_once '../config/env.php';        // Lädt .env-Werte
require_once '../config/session.php';    // Session starten
require_once '../inc/header.php';        // Optional: Kopfbereich inkl. CSS

$loginError = '';

// Prüfung bei POST-Anfrage
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'] ?? '';
  $password = $_POST['password'] ?? '';

  // Vergleich mit ADMIN_USER aus .env
  $envUser = $_ENV['ADMIN_USER'] ?? '';
  $envHash = $_ENV['ADMIN_PASS_HASH'] ?? '';

  if ($username === $envUser && password_verify($password, $envHash)) {
    $_SESSION['user_role'] = 'admin';
    $_SESSION['user_id'] = 'admin';
    header('Location: index.php');
    exit;
  } else {
    $loginError = '🚫 Benutzername oder Passwort sind falsch.';
  }
}
?>

<main class="container mt-5">
  <h1>🔐 Admin Login</h1>

  <?php if ($loginError): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($loginError) ?></div>
  <?php endif; ?>

  <form method="post" action="">
    <div class="mb-3">
      <label for="username" class="form-label">Benutzername</label>
      <input type="text" name="username" id="username" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="password" class="form-label">Passwort</label>
      <input type="password" name="password" id="password" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-success">Einloggen</button>
  </form>
</main>

<?php require_once '../inc/footer.php'; ?>
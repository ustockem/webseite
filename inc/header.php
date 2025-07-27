<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/functions.php';
?>

<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= SITE_TITLE ?></title>
  <meta name="description" content="muTiger-Schule – Impulse für Prävention & Persönlichkeitsstärkung in Bildungseinrichtungen">
  <meta name="author" content="Ulrich Stockem">
  <meta name="robots" content="index, follow">

  <link rel="icon" href="<?= IMG_PATH ?>/favicon.ico" type="image/x-icon">
  <link rel="preload" href="<?= BASE_PATH ?>/assets/fonts/montserrat/Montserrat-Regular.woff2" as="font" type="font/woff2" crossorigin="anonymous">
  
  <!-- Bootstrap & eigene Styles -->
  <link rel="stylesheet" href="<?= BASE_PATH ?>/vendor/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= CSS_PATH ?>/styles.css?v=<?= ASSET_VERSION ?>">

  <!-- Optional: Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

  <script src="<?= BASE_PATH ?>/consent.js?v=<?= ASSET_VERSION ?>"></script>
</head>
<body>

<header>
  <!-- Mobile Header -->
  <div class="header-mobile d-flex justify-content-between align-items-center px-3 py-2 d-md-none" style="background-color:#005a87; color:#fff;">
    <div class="d-flex align-items-center gap-2">
      <img src="<?= IMG_PATH ?>/Logo_AiN_transparent_weiss10.svg" alt="Logo der muTiger-Schule" width="36">
    </div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain" aria-controls="navMain" aria-expanded="false" aria-label="Navigation ein-/ausklappen">
      <span class="navbar-toggler-icon"></span>
    </button>
  </div>

  <!-- Desktop Header -->
  <div class="header-top py-3 d-none d-md-block">
    <div class="container d-flex align-items-center gap-3">
      <div class="d-flex align-items-center gap-2">
        <img src="<?= IMG_PATH ?>/Logo_AiN_transparent_weiss10.svg" alt="Logo der muTiger-Schule" width="36">
      </div>
      <div>
        <h1 class="mb-0 h4">muTiger-Schule</h1>
        <p class="mb-0 small slogan-text">Impulse für Prävention & Persönlichkeitsstärkung in Bildungseinrichtungen</p>
      </div>
    </div>
  </div>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-md custom-navbar border-bottom">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center gap-2" href="<?= BASE_PATH ?>/">
        <span class="fw-semibold">Startseite</span>
      </a>
      <button class="navbar-toggler d-md-none" type="button" data-bs-toggle="collapse" data-bs-target="#navMain" aria-controls="navMain" aria-expanded="false" aria-label="Navigation ein-/ausklappen">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navMain">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="<?= BASE_PATH ?>/achtsamkeit/">Achtsamkeit</a></li>
          <li class="nav-item"><a class="nav-link" href="<?= BASE_PATH ?>/cybermobbing/">Cybermobbing</a></li>
          <li class="nav-item"><a class="nav-link" href="<?= BASE_PATH ?>/zivilcourage/">Zivilcourage</a></li>
          <li class="nav-item"><a class="nav-link" href="<?= BASE_PATH ?>/moodle/">Moodle</a></li>

          <li class="nav-item d-none d-md-block">
            <span class="nav-link disabled text-muted">|</span>
          </li>

          <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
            <!-- 🔧 Admin-Dropdown -->
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle text-primary" href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-gear"></i> Admin
              </a>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="adminDropdown">
                <li>
                  <a class="dropdown-item" href="<?= BASE_PATH ?>/cybermobbing/quiz/admin/questions.php">
                    <i class="bi bi-card-list me-2"></i> Fragenverwaltung
                  </a>
                </li>
                <li><a class="dropdown-item" href="<?= ADMIN_PATH ?>/users.php"><i class="bi bi-people-fill me-2"></i>Benutzer</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item text-danger" href="<?= ADMIN_PATH ?>/logout.php"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
              </ul>
            </li>
          <?php else: ?>
            <!-- 🔐 Login für Gäste -->
            <li class="nav-item">
              <a class="nav-link text-success" href="<?= ADMIN_PATH ?>/login.php">
                <i class="bi bi-lock-fill"></i> Login
              </a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>
</header>
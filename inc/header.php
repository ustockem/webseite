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

  <script src="<?= BASE_PATH ?>/consent.js?v=<?= ASSET_VERSION ?>"></script>

</head>
<body>

<header>
  <!-- Mobile Header (< 768px) -->
  <div class="header-mobile d-flex justify-content-between align-items-center px-3 py-2 d-md-none" style="background-color:#005a87; color:#fff;">
    <div class="d-flex align-items-center gap-2">
      <img src="<?= IMG_PATH ?>/Logo_AiN_transparent_weiss10.svg" alt="Logo der muTiger-Schule" width="36">
    </div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain" aria-controls="navMain" aria-expanded="false" aria-label="Navigation ein-/ausklappen">
      <span class="navbar-toggler-icon"></span>
    </button>
  </div>

  <!-- Desktop Header (≥ 768px) -->
  <div class="header-top py-3 d-none d-md-block">
    <div class="container d-flex align-items-center gap-3">
      
      <!-- 🖼️ Logo wieder einbauen -->
      <div class="d-flex align-items-center gap-2">
        <img src="<?= IMG_PATH ?>/Logo_AiN_transparent_weiss10.svg" alt="Logo der muTiger-Schule" width="36">
      </div>

      <!-- 🧠 Textblock -->
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
        </ul>
      </div>
    </div>
  </nav>
</header>
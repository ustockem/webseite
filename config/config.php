<?php

require_once __DIR__ . '/paths.php';

// 📦 Autoloader & .env laden
require_once __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../'); // Pfad zur .env
$dotenv->load();

require_once __DIR__ . '/env.php'; // lädt .env manuell in $_ENV

// 🔐 Session-Handling – wichtig für Login-Status & Zugriffskontrollen
require_once __DIR__ . '/session.php';

// 🚫 lädt Admin-Logik aus dem alten Pfad (nicht für Testseite geeignet)
// require_once __DIR__ . '/../cybermobbing/quiz/admin/admin.php';

// 🛢️ DB-Verbindung
require_once __DIR__ . '/database.php';

// 📌 Zentrale Konstanten wie SITE_TITLE, COPYRIGHT, Versionsnummer etc.
require_once __DIR__ . '/constants.php';

// 🔍 prüft Umgebungsvariablen (z. B. ob env.php korrekt geladen wurde)
require_once __DIR__ . '/validateEnv.php';
?>
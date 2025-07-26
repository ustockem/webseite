<?php
declare(strict_types=1);
require __DIR__ . '/vendor/autoload.php';

try {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    echo "<h2>✅ Dotenv funktioniert!</h2>";
    echo "🔑 ADMIN_USER: " . ($_ENV['ADMIN_USER'] ?? 'Nicht gesetzt') . "<br>";
    echo "🔐 Passwort-Hash vorhanden: " . (isset($_ENV['ADMIN_PASS_HASH']) ? 'Ja' : 'Nein') . "<br>";
    echo "📚 SITE_TITLE: " . ($_ENV['SITE_TITLE'] ?? 'Nicht gesetzt') . "<br>";
} catch (Exception $e) {
    echo "<h2>❌ Fehler beim Laden der .env</h2>";
    echo "<pre>" . $e->getMessage() . "</pre>";
}
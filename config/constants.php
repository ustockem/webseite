<?php
// Lokale Umgebung erkennen (localhost oder 127.0.0.1)
if (!defined('IS_LOCAL')) {
    define('IS_LOCAL', in_array($_SERVER['SERVER_NAME'], ['localhost', '127.0.0.1']));
}

// URL-Root des Projekts (für Verlinkungen im Browser)
if (!defined('BASE_PATH')) {
    define('BASE_PATH', IS_LOCAL ? '/test' : '/ulrichstockem.de');  // später evtl. Domain-Root
}

// Optionale Dateisystem-Root (für serverseitige Includes, z. B. INC_PATH)
if (!defined('ROOT_DIR')) {
    define('ROOT_DIR', __DIR__ . '/../');  // geht von /config aus ins Projektroot
}

// Projektinfos
if (!defined('SITE_TITLE')) {
    define('SITE_TITLE', 'ulrichstockem.de – Achtsamkeit, Prävention & Verantwortung');
}
if (!defined('SITE_AUTHOR')) {
    define('SITE_AUTHOR', 'Ulrich Stockem');
}

// Versionierung der Assets (für Cache-Busting)
if (!defined('ASSET_VERSION')) {
    define('ASSET_VERSION', '1.0.0');
}
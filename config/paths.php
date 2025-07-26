<?php
// 🛡️ Doppelte Einbindung verhindern
if (defined('PATHS_LOADED')) return;
define('PATHS_LOADED', true);

// 💻 Erkennung der lokalen Umgebung
if (!defined('IS_LOCAL')) {
  define('IS_LOCAL', ($_SERVER['SERVER_NAME'] === 'localhost'));
}

// 🚪 Root-Verzeichnis deiner Testseite (z. B. /Test auf WAMP)
if (!defined('URL_ROOT')) {
  define('URL_ROOT', IS_LOCAL ? '/Test' : '/dein-live-pfad'); // Bei Deployment anpassen
}

// 📦 Projekt-Basis: Global gültiger Basispfad
if (!defined('BASE_PATH')) {
  define('BASE_PATH', URL_ROOT);
}

// 📄 Include-Pfad (z. B. für header.php, footer.php)
if (!defined('INC_PATH')) {
  define('INC_PATH', __DIR__ . '/../inc');
}

// 🎨 Globale Asset-Pfade
if (!defined('CSS_PATH')) {
  define('CSS_PATH', BASE_PATH . '/styles');
}
if (!defined('JS_PATH')) {
  define('JS_PATH', BASE_PATH . '/js');
}
if (!defined('IMG_PATH')) {
  define('IMG_PATH', BASE_PATH . '/media/img');
}

// 📁 Modulpfade
// Modul: Cybermobbing
if (!defined('MODULE_CYBER')) {
  define('MODULE_CYBER', BASE_PATH . '/cybermobbing');
}

// Untermodul: Quiz
if (!defined('QUIZ_PATH')) {
  define('QUIZ_PATH', MODULE_CYBER . '/quiz');
}

if (!defined('QUIZ_ADMIN_PATH')) {
  define('QUIZ_ADMIN_PATH', QUIZ_PATH . '/admin');
}
if (!defined('QUIZ_JS_PATH')) {
  define('QUIZ_JS_PATH', '/test/cybermobbing/js');
}

// 🧘 Erweiterungen für weitere Module
if (!defined('MODULE_ACHTSAMKEIT')) {
  define('MODULE_ACHTSAMKEIT', BASE_PATH . '/achtsamkeit');
}
if (!defined('MODULE_ZIVILCOURAGE')) {
  define('MODULE_ZIVILCOURAGE', BASE_PATH . '/zivilcourage');
}

// 🔧 Optionale Fonts oder Vendor-Verzeichnisse
if (!defined('FONTS_PATH')) {
  define('FONTS_PATH', BASE_PATH . '/assets/fonts');
}
if (!defined('VENDOR_PATH')) {
  define('VENDOR_PATH', BASE_PATH . '/vendor');
}

if (!defined('VENDOR_PATH')) {
  define('JS_PATH', '/js');
}

?>
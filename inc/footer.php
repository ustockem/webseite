<footer class="footer bg-light text-center border-top small text-muted mt-0">
  <div class="container-fluid py-3">
    <div class="container-fluid">
      <p>© 2025 ulrichstockem.de</p>
    </div>
    <p class="mb-0">
      <a href="<?= BASE_PATH ?>/content/impressum.php" class="text-decoration-none">Impressum</a> |
      <a href="<?= BASE_PATH ?>/content/datenschutz.php" class="text-decoration-none">Datenschutzerklärung</a>
    </p>
  </div>
</footer>

<!-- Cookie & Consent Hinweis -->
<div id="consent-box" role="alert" aria-label="Datenschutz-Hinweis">
  <span class="small">
    Diese Website verwendet cookieloses Tracking zur Verbesserung der Inhalte.
    <a href="<?= BASE_PATH ?>/content/datenschutz.php" target="_blank" rel="noopener">Mehr erfahren</a>
  </span>
  <button onclick="setConsent()" class="btn btn-sm btn-outline-primary ms-2" aria-label="Tracking akzeptieren">
    Einverstanden
  </button>
</div>

<!-- JavaScript -->
<script src="<?= BASE_PATH ?>/vendor/bootstrap/js/bootstrap.bundle.min.js?v=<?= ASSET_VERSION ?>"></script>
<script>
  const BASE_PATH = '<?= BASE_PATH ?>';
  if (localStorage.getItem('consentGiven')) {
    document.getElementById('consent-box')?.remove();
  }
</script>
<script src="<?= JS_PATH ?>/consent.js?v=<?= ASSET_VERSION ?>"></script>
</body>
</html>
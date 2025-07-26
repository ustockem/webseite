<?php
require_once __DIR__ . '/inc/header.php';
?>

<main>
  <!-- Hero-Bereich -->
  <section class="hero d-flex align-items-center justify-content-center text-center text-white">
    <div>
      <a href="https://mutiger.de" target="_blank" rel="noopener">
        <img src="<?= IMG_PATH ?>/muTiger_Logo_transparent_klein.png" alt="muTiger-Stiftung">
      </a>

      <h1 class="display-4 fw-bold">muTiger-Schule</h1>
      <p class="lead">Impulse für Prävention & Persönlichkeitsstärkung<br>in Bildungseinrichtungen</p>
    </div>
  </section>

  <!-- Hinweis auf lokalen Modus -->
  <div class="container mt-4">
    <?php if (IS_LOCAL): ?>
      <p class="text-warning small">⚙️ Lokaler Modus aktiv</p>
    <?php endif; ?>
  </div>

  <!-- Themenübersicht -->
  <section class="container-lg my-5">
    <h2 class="text-center mb-4">Unsere Themen</h2>
    <div class="row g-4">
      
      <?php
      // Themen-Array als Vereinfachung
      $themen = [
        ['icon' => '🧘', 'title' => 'Achtsamkeit', 'text' => 'Innere Stärke fördern', 'link' => '/achtsamkeit/', 'btnClass' => 'btn-outline-primary'],
        ['icon' => '🚫', 'title' => 'Stop Cybermobbing', 'text' => 'Aktiv gegen digitale Ausgrenzung', 'link' => '/cybermobbing/', 'btnClass' => 'btn-outline-danger'],
        ['icon' => '🤝', 'title' => 'Zivilcourage', 'text' => 'Mutig sein & einstehen', 'link' => '/zivilcourage/', 'btnClass' => 'btn-outline-success'],
        ['icon' => '🎓', 'title' => 'Moodle', 'text' => 'Online-Lernmodule & Kurse', 'link' => '/moodle/', 'btnClass' => 'btn-outline-secondary'],
      ];

      foreach ($themen as $thema): ?>
        <div class="col-md-6 col-lg-3">
          <div class="card h-100 text-center border-0 shadow-sm d-flex flex-column">
            <div class="card-body d-flex flex-column">
              
              <!-- Symbol & Titel -->
              <div class="mb-3">
                <div style="font-size: 2rem;"><?= $thema['icon'] ?></div>
                <h5 class="card-title mt-2"><?= $thema['title'] ?></h5>
              </div>

              <!-- Textbeschreibung -->
              <p class="card-text flex-grow-1"><?= $thema['text'] ?></p>

              <!-- Button ganz unten -->
              <a href="<?= BASE_PATH . $thema['link'] ?>" class="btn <?= $thema['btnClass'] ?>">
                Mehr erfahren
              </a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>    
    </div>
  </section>

  <!-- Podcast-Hinweis -->
  <section class="container my-5">
    <div class="bg-light rounded p-4 shadow-sm">
      <h2 class="mb-3 text-center">🎙️ Mehr zur muTiger-Stiftung</h2>
      <p class="lead text-center">
        Wollen Sie mehr über die muTiger-Stiftung erfahren?<br>
        Hören Sie Ulrich Stockem im Podcast <em>„Public Sector Insider“</em>.
      </p>
      <p class="text-center">
        In Folge <strong>#288</strong> spricht unser Vorstandsmitglied über die inhaltliche Ausrichtug der Stiftung.
      </p>
      <div class="text-center mt-3">
        <audio controls>
          <source src="media/audios/potcast_behoerdenspiegel.mp3" type="audio/mpeg">
          Dein Browser unterstützt das Audio-Tag nicht.
        </audio>
      </div>
    </div>
  </section>
</main>

<?php require_once __DIR__ . '/inc/footer.php'; ?>

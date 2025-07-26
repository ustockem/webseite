<?php
require_once __DIR__ . '/../../inc/header.php';
include 'templates/quiz-template.php';
?>

<main class="container">
  <section>
    <h1>Cybermobbing-Quiz</h1>

    <!-- Quizfragen erscheinen hier -->
    <div id="quiz-container"></div>

    <!-- Ergebnisbereich -->
    <div id="quiz-result" class="alert alert-success mt-4" style="display: none;"></div>

    <!-- Fortschrittsbalken -->
    <div class="progress mt-3" style="height: 25px;">
      <div id="quiz-progress" class="progress-bar" role="progressbar"
           style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
        0%
      </div>
    </div>

    <!-- Startbutton -->
    <button id="start-quiz" class="btn btn-primary mt-4">Quiz starten</button>
  </section>
</main>

<!-- Externes JavaScript einbinden -->
<script src="/assets/js/quiz.js"></script>

<?php
require_once __DIR__ . '/../../inc/footer.php';
?>
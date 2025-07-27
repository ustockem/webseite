<?php
declare(strict_types=1);
require_once '../../../config/session.php';
require_once '../../../config/config.php';
require_once '../../../inc/header.php';

if (empty($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
  header('Location: ../../../admin/login.php');
  exit;
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <title>Neue Frage erstellen</title>
  <link rel="stylesheet" href="../../../styles/admin.css">
</head>
<body>
<main class="admin-container mt-4">
  <h1 class="mb-4">🆕 Neue Quiz-Frage erstellen</h1>

  <form method="POST" action="save-questions.php?new=1">
    <div class="mb-3">
      <label class="form-label">Fragetext</label>
      <input type="text" name="question_text" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Antwortmöglichkeiten</label>
      <div id="new-answers">
        <?php for ($i = 1; $i <= 2; $i++): ?>
          <div class="mb-4 p-3 border rounded bg-light position-relative">
            <label class="form-label">Antwort <?= $i ?></label>
            <input type="text" name="new_answers[]" class="form-control mb-2" required>

            <div class="form-check border border-warning rounded p-2">
              <input type="radio"
                     name="correct_answer"
                     value="new_<?= $i ?>"
                     class="form-check-input"
                     id="correct<?= $i ?>"
                     onclick="showHint(<?= $i ?>)">
              <label class="form-check-label fw-bold text-primary" for="correct<?= $i ?>">
                ✔ Richtige Antwort markieren
              </label>
            </div>

            <small id="warning<?= $i ?>" class="text-danger d-block mt-2">
              Bitte wählen Sie eine richtige Antwort aus!
            </small>

            <span id="hint<?= $i ?>" class="bg-success text-white px-2 py-1 rounded mt-2" style="display:none;">
                ✔ Antwort <?= $i ?> wurde als richtig gewählt
            </span>
          </div>
        <?php endfor; ?>
      </div>
    </div>

    <div class="mb-3">
      <label class="form-label">Erklärung / Hintergrund</label>
      <textarea name="explanation" class="form-control" rows="3"></textarea>
    </div>

    <button type="submit" class="btn btn-success">💾 Frage speichern</button>
    <a href="questions.php" class="btn btn-secondary ms-2">↩️ Zurück</a>
  </form>
</main>

<script>
  function showHint(i) {
    const totalAnswers = document.querySelectorAll('#new-answers > div').length;

    for (let j = 1; j <= totalAnswers; j++) {
        const hint = document.getElementById("hint" + j);
        const warning = document.getElementById("warning" + j);
        if (hint) hint.style.display = "none";
        if (warning) warning.style.display = "block";
        if (hint) hint.classList.remove("d-inline-block");
    }

    const hintToShow = document.getElementById("hint" + i);
    if (hintToShow) {
        hintToShow.style.display = "inline-block";
        hintToShow.classList.add("d-inline-block");
    }

    const warningToHide = document.getElementById("warning" + i);
    if (warningToHide) warningToHide.style.display = "none";
}

  function addAnswerField() {
    const container = document.getElementById('new-answers');
    const index = container.children.length + 1;

    const div = document.createElement('div');
    div.classList.add('mb-4', 'p-3', 'border', 'rounded', 'bg-light', 'position-relative');

    div.innerHTML = `
      <label class="form-label">Antwort ${index}</label>
      <input type="text" name="new_answers[]" class="form-control mb-2" required>
      <div class="form-check border border-warning rounded p-2">
        <input type="radio"
               name="correct_answer"
               value="new_${index}"
               class="form-check-input"
               id="correct${index}"
               onclick="showHint(${index})">
        <label class="form-check-label fw-bold text-primary" for="correct${index}">
          ✔ Richtige Antwort markieren
        </label>
      </div>
      <small id="warning${index}" class="text-danger d-block mt-2">
        Bitte wählen Sie eine richtige Antwort aus!
      </small>
      <span id="hint${index}" class="bg-success text-white px-2 py-1 rounded mt-2 d-inline-block" style="display:none;">
        ✔ Antwort ${index} wurde als richtig gewählt
      </span>
    `;

    container.appendChild(div);
  }
</script>
</body>
</html>

<?php require_once '../../../inc/footer.php'; ?>
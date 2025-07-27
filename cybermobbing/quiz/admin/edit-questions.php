<?php
declare(strict_types=1);
require_once '../../../config/session.php';
require_once '../../../config/config.php';
require_once '../../../config/database.php'; // Hier kommt die MySQLi-Verbindung

if (empty($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
  header('Location: ../../../admin/login.php');
  exit;
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) {
  die('❌ Ungültige Frage-ID.');
}

// Frage laden
$stmtQ = $mysqli->prepare("SELECT question, correct_answer_id FROM questions WHERE ID = ?");
$stmtQ->bind_param('i', $id);
$stmtQ->execute();
$questionRow = $stmtQ->get_result()->fetch_assoc();
$stmtQ->close();

// Antworten laden
$stmtA = $mysqli->prepare("SELECT id, answer_text FROM answers WHERE question_id = ? ORDER BY id");
$stmtA->bind_param('i', $id);
$stmtA->execute();
$answers = $stmtA->get_result()->fetch_all(MYSQLI_ASSOC);
$stmtA->close();

// Erklärung laden
$stmtE = $mysqli->prepare("SELECT explanation FROM explanations WHERE question_id = ?");
$stmtE->bind_param('i', $id);
$stmtE->execute();
$explanationRow = $stmtE->get_result()->fetch_assoc();
$stmtE->close();
?>

<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <title>Frage bearbeiten</title>
  <link rel="stylesheet" href="../../../styles/admin.css">
</head>
<body>
  <main class="admin-container mt-4">
    <h1 class="mb-4">✏️ Frage bearbeiten</h1>

    <form method="POST" action="save-questions.php">
      <input type="hidden" name="question_id" value="<?= $id ?>">

      <div class="mb-3">
        <label class="form-label">Fragetext</label>
        <input type="text" name="question_text" class="form-control"
               value="<?= htmlspecialchars($questionRow['question'] ?? '') ?>" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Antwortmöglichkeiten</label>
        <?php foreach ($answers as $ix => $a): ?>
          <div class="input-group mb-2">
            <span class="input-group-text">Antwort <?= $ix + 1 ?></span>
            <input type="text" name="answers[<?= $a['id'] ?>]" class="form-control"
                   value="<?= htmlspecialchars($a['answer_text']) ?>" required>
            <input type="radio" name="correct_answer" value="<?= $a['id'] ?>" class="form-check-input ms-2"
                   <?= ($a['id'] == $questionRow['correct_answer_id']) ? 'checked' : '' ?>>
            <span class="ms-1">✔️</span>
          </div>
        <?php endforeach; ?>
      </div>

      <div class="mb-3">
        <label class="form-label">➕ Neue Antwort hinzufügen</label>
        <div id="new-answers"></div>
        <button type="button" class="btn btn-outline-primary btn-sm" onclick="addAnswerField()">Neue Antwort</button>
      </div>

      <div class="mb-3">
        <label class="form-label">Erklärung / Hintergrund</label>
        <textarea name="explanation" class="form-control" rows="3"><?= htmlspecialchars($explanationRow['explanation'] ?? '') ?></textarea>
      </div>

      <button type="submit" class="btn btn-success">💾 Änderungen speichern</button>
      <a href="questions.php" class="btn btn-secondary ms-2">↩️ Zurück</a>
    </form>
  </main>

  <script>
  function addAnswerField() {
    const container = document.getElementById('new-answers');
    const index = container.children.length + 1;
    const div = document.createElement('div');
    div.classList.add('input-group', 'mb-2');
    div.innerHTML = `
      <span class="input-group-text">Antwort (neu) ${index}</span>
      <input type="text" name="new_answers[]" class="form-control" required>
      <input type="radio" name="correct_answer" value="new_${index}" class="form-check-input ms-2">
      <span class="ms-1">✔️</span>
    `;
    container.appendChild(div);
  }
  </script>
</body>
</html>
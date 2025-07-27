<?php
declare(strict_types=1);
require_once '../../../config/session.php';
require_once '../../../config/config.php';
require_once '../../../config/database.php'; // Holt die MySQLi-Verbindung

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
  header('Location: ../../../admin/login.php');
  exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  echo "<div class='alert alert-warning'>⛔ Ungültiger Zugriff – nur POST erlaubt.</div>";
  exit;
}

// 🔎 Eingaben sichern
$isNew = isset($_GET['new']);
$questionId     = intval($_POST['question_id'] ?? 0);
$questionText   = trim($_POST['question_text'] ?? '');
$correctAnswer  = $_POST['correct_answer'] ?? '';
$answers        = $_POST['answers'] ?? [];              // Bestehende Antworten
$newAnswers     = $_POST['new_answers'] ?? [];          // Neue Antworten (optional)
$explanation    = trim($_POST['explanation'] ?? '');

if ($isNew) {
  if (!$questionText || !$correctAnswer) {
    echo "<div class='alert alert-danger'>⚠️ Ungültige Eingaben. Bitte alles korrekt ausfüllen.</div>";
    exit;
  }

  $stmtNewQ = $mysqli->prepare("INSERT INTO questions (question) VALUES (?)");
  $stmtNewQ->bind_param('s', $questionText);
  $stmtNewQ->execute();
  $questionId = $stmtNewQ->insert_id;
  $stmtNewQ->close();
} else {
  $questionId = intval($_POST['question_id'] ?? 0);
  if ($questionId <= 0 || !$questionText || !$correctAnswer) {
    echo "<div class='alert alert-danger'>⚠️ Ungültige Eingaben. Bitte alles korrekt ausfüllen.</div>";
    exit;
  }

  $stmtQ = $mysqli->prepare("UPDATE questions SET question = ?, correct_answer_id = ? WHERE ID = ?");
  $stmtQ->bind_param('sii', $questionText, $correctAnswer, $questionId);
  $stmtQ->execute();
  $stmtQ->close();
}


if ($questionId <= 0 || !$questionText || !$correctAnswer) {
  echo "<div class='alert alert-danger'>⚠️ Ungültige Eingaben. Bitte alles korrekt ausfüllen.</div>";
  exit;
}

$mysqli->begin_transaction();

try {
  // ✅ Frage aktualisieren
  $stmtQ = $mysqli->prepare("UPDATE questions SET question = ?, correct_answer_id = ? WHERE ID = ?");
  $stmtQ->bind_param('sii', $questionText, $correctAnswer, $questionId);
  $stmtQ->execute();
  $stmtQ->close();

  // ✅ Erklärung aktualisieren oder neu einfügen
  $stmtCheck = $mysqli->prepare("SELECT COUNT(*) FROM explanations WHERE question_id = ?");
  $stmtCheck->bind_param('i', $questionId);
  $stmtCheck->execute();
  $stmtCheck->bind_result($exists);
  $stmtCheck->fetch();
  $stmtCheck->close();

  if ($exists) {
    $stmtExp = $mysqli->prepare("UPDATE explanations SET explanation = ? WHERE question_id = ?");
  } else {
    $stmtExp = $mysqli->prepare("INSERT INTO explanations (explanation, question_id) VALUES (?, ?)");
  }
  $stmtExp->bind_param('si', $explanation, $questionId);
  $stmtExp->execute();
  $stmtExp->close();

  // 🔁 Bestehende Antworten aktualisieren
  foreach ($answers as $answerId => $text) {
    $text = trim($text);
    if ($text !== '') {
      $stmtA = $mysqli->prepare("UPDATE answers SET answer_text = ? WHERE id = ? AND question_id = ?");
      $stmtA->bind_param('sii', $text, $answerId, $questionId);
      $stmtA->execute();
      $stmtA->close();
    }
  }

  // ➕ Neue Antworten einfügen
  foreach ($newAnswers as $index => $newText) {
    $newText = trim($newText);
    if ($newText !== '') {
      $stmtNew = $mysqli->prepare("INSERT INTO answers (question_id, answer_text) VALUES (?, ?)");
      $stmtNew->bind_param('is', $questionId, $newText);
      $stmtNew->execute();
      $newId = $stmtNew->insert_id;
      $stmtNew->close();

      // Falls die neue Antwort korrekt ist, setze sie nachträglich
      if ($correctAnswer === 'new_' . ($index + 1)) {
        $stmtCorr = $mysqli->prepare("UPDATE questions SET correct_answer_id = ? WHERE ID = ?");
        $stmtCorr->bind_param('ii', $newId, $questionId);
        $stmtCorr->execute();
        $stmtCorr->close();
      }
    }
  }

  $mysqli->commit();

  echo "<div class='alert alert-success'>✅ Änderungen erfolgreich gespeichert!</div>";
  echo "<a href='edit-questions.php?id={$questionId}' class='btn btn-primary'>🔙 Zurück zur Bearbeitung</a>";

} catch (Exception $e) {
  $mysqli->rollback();
  echo "<div class='alert alert-danger'>❌ Fehler beim Speichern: " . htmlspecialchars($e->getMessage()) . "</div>";
  echo "<a href='edit-questions.php?id={$questionId}' class='btn btn-secondary'>🔁 Nochmal versuchen</a>";
}
?>

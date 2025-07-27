<?php
declare(strict_types=1);
require_once '../../../config/session.php';
require_once '../../../config/config.php';
require_once '../../../config/database.php'; // Holt die MySQLi-Verbindung

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
  header('Location: ../../../admin/login.php');
  exit;
}

// 🧪 Prüfen, ob ID vorhanden
$questionId = intval($_GET['id'] ?? 0);
if ($questionId <= 0) {
  echo "<div class='alert alert-danger'>❌ Ungültige Frage-ID.</div>";
  exit;
}

$mysqli->begin_transaction();

try {
  // 🗑️ Antworten löschen
  $stmtAns = $mysqli->prepare("DELETE FROM answers WHERE question_id = ?");
  $stmtAns->bind_param('i', $questionId);
  $stmtAns->execute();
  $stmtAns->close();

  // 🗑️ Erklärung löschen
  $stmtExp = $mysqli->prepare("DELETE FROM explanations WHERE question_id = ?");
  $stmtExp->bind_param('i', $questionId);
  $stmtExp->execute();
  $stmtExp->close();

  // 🗑️ Frage selbst löschen
  $stmtQ = $mysqli->prepare("DELETE FROM questions WHERE ID = ?");
  $stmtQ->bind_param('i', $questionId);
  $stmtQ->execute();
  $stmtQ->close();

  $mysqli->commit();

  echo "<div class='alert alert-success'>✅ Frage erfolgreich gelöscht!</div>";
  echo "<a href='questions.php' class='btn btn-primary'>🔙 Zurück zur Übersicht</a>";

} catch (Exception $e) {
  $mysqli->rollback();
  echo "<div class='alert alert-danger'>❌ Fehler beim Löschen: " . htmlspecialchars($e->getMessage()) . "</div>";
  echo "<a href='questions.php' class='btn btn-secondary'>🔁 Zurück</a>";
}
?>
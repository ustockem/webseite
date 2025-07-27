<?php
require_once '../../../config/session.php';
require_once '../../../config/config.php';
require_once '../../../config/database.php'; // Wichtig für $mysqli!
require_once '../../../inc/header.php';

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
  header('Location: ../../../admin/login.php');
  exit;
}

// Fragen aus DB laden
$questions = [];
$query = "SELECT ID, question FROM questions ORDER BY ID ASC";

if ($result = $mysqli->query($query)) {
  while ($row = $result->fetch_assoc()) {
    $questions[] = $row;
  }
  $result->free();
} else {
  echo "<div class='alert alert-danger'>❌ Fehler beim Laden: " . htmlspecialchars($mysqli->error) . "</div>";
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <title>Fragenübersicht</title>
  <link rel="stylesheet" href="../../../styles/admin.css">
</head>
<body>
  <main class="container mt-4">
    <h1>📋 Quiz-Fragen verwalten</h1>

    <a href="create-question.php?id=0" class="btn btn-success mb-3">➕ Neue Frage erstellen</a>

    <?php if (!empty($questions)): ?>
      <table class="table table-bordered">
        <thead class="table-light">
          <tr>
            <th>ID</th>
            <th>Fragetext</th>
            <th>Aktionen</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($questions as $q): ?>
            <tr>
              <td><?= $q['ID'] ?></td>
              <td><?= htmlspecialchars($q['question']) ?></td>
              <td>
                <a href="edit-questions.php?id=<?= $q['ID'] ?>" class="btn btn-sm btn-warning">Bearbeiten</a>
                <a href="delete-questions.php?id=<?= $q['ID'] ?>" class="btn btn-sm btn-danger"
                   onclick="return confirm('Wirklich löschen?')">Löschen</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php else: ?>
      <div class="alert alert-info">ℹ️ Es wurden noch keine Fragen angelegt.</div>
    <?php endif; ?>
  </main>
</body>
</html>

<?php require_once '../../../inc/footer.php'; ?>
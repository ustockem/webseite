<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../../config/config.php';


header('Content-Type: application/json');

// .env-Werte simulieren oder aus einer Funktion/Klasse laden
$env = [
    'DB_HOST' => 'localhost',
    'DB_PORT' => '3307',
    'DB_NAME' => 'quiz_app',
    'DB_USER' => 'root',
    'DB_PASS' => ''
];



// DSN dynamisch aufbauen
$dsn = "mysql:host={$env['DB_HOST']};port={$env['DB_PORT']};dbname={$env['DB_NAME']};charset=utf8mb4";

// Datenbankverbindung aufbauen
try {
    $pdo = new PDO($dsn, $env['DB_USER'], $env['DB_PASS'], [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

    // Alle relevanten Daten über JOINs laden
    $stmt = $pdo->query("
        SELECT 
            q.ID AS question_id,
            q.question AS question_text,
            q.correct_answer_id,
            e.explanation,
            a.id AS answer_id,
            a.answer_text
        FROM questions q
        LEFT JOIN answers a ON q.ID = a.question_id
        LEFT JOIN explanations e ON q.ID = e.question_id
        ORDER BY q.ID, a.id
    ");

    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Fragen mit Antworten gruppieren
    $questions = [];
    foreach ($rows as $row) {
        $qid = $row['question_id'];

        if (!isset($questions[$qid])) {
            $questions[$qid] = [
                'id' => $qid,
                'text' => $row['question_text'],
                'explanation' => $row['explanation'],
                'answers' => []
            ];
        }

        $questions[$qid]['answers'][] = [
            'id' => $row['answer_id'],
            'text' => $row['answer_text'],
            'is_correct' => ($row['answer_id'] == $row['correct_answer_id'])
        ];
    }

    echo json_encode(['questions' => array_values($questions)]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'error' => 'Datenbankfehler',
        'details' => $e->getMessage()
    ]);
}
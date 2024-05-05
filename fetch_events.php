<?php
session_start();

require 'database_connection.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode([]);
    exit;
}

$query = "SELECT id, title, start_event as start, end_event as end FROM events";
$stmt = $pdo->prepare($query);
$events = $stmt->fetchAll(PDO::FETCH_ASSOC); //fetch all rows

echo json_encode($events); //returns events
?>

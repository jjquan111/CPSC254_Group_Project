<?php
session_start();

require 'database_connection.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode([]);
    exit;
}

$query = "SELECT id, title, start_event as start, end_event as end FROM events WHERE user_id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$_SESSION['user_id']]); 
$events = $stmt->fetchAll(PDO::FETCH_ASSOC); //fetch all rows

echo json_encode($events); //returns events
?>
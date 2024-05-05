<?php
session_start();
require 'database_connection.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode([]); // No user logged in
    exit;
}

$query = "SELECT * FROM events WHERE user_id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$_SESSION['user_id']]);
$events = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($events);
?>
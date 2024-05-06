<?php
session_start();
require 'database_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['event_id']) && isset($_SESSION['user_id'])) {
    $event_id = $_POST['event_id'];
    $user_id = $_SESSION['user_id'];  // To ensure users can only delete their own events

    try {
        $stmt = $pdo->prepare("DELETE FROM events WHERE id = ? AND user_id = ?");
        if ($stmt->execute([$event_id, $user_id])) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete event']);
        }
    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
?>

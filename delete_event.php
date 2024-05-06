<?php
require 'database_connection.php';

// Checks if the request is a POST and the event_id is present
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['event_id'])) {
    $event_id = $_POST['event_id'];

    // The SQL statement to delete the event
    try {
        $stmt = $pdo->prepare("DELETE FROM events WHERE id = ?");
        // Executes the prepared statement with the provided event_id
        if ($stmt->execute([$event_id])) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete event']);
        }

        // Catches and returns any database errors encountfound in the proccess
    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
?>

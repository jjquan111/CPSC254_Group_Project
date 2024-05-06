<?php
session_start();
require 'database_connection.php';

// Checking if the request is a POST and all necessary fields are present
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id'], $_POST['title'], $_POST['start'], $_POST['end'])) {
    $title = $_POST['title'];
    $start = date('Y-m-d H:i:s', strtotime($_POST['start'])); // Format the start date
    $end = date('Y-m-d H:i:s', strtotime($_POST['end'])); // Format the end date
    $user_id = $_SESSION['user_id'];

    // Prepare the SQL statement to insert the event
    $stmt = $pdo->prepare("INSERT INTO events (title, start_event, end_event, user_id) VALUES (?, ?, ?, ?)");

    // Execute the prepared statement with provided data
    try {
        if ($stmt->execute([$title, $start, $end, $user_id])) {
            $newEventId = $pdo->lastInsertId();
            // Return a success status with event details if insertion was successful
            echo json_encode([
                'status' => 'success',
                'event' => [
                    'id' => $newEventId,
                    'title' => $title,
                    'start' => $start,
                    'end' => $end
                ]
            ]);
        } else {
            // Return an error status if the insertion fails
            echo json_encode([
                'status' => 'error',
                'message' => 'Failed to insert event'
            ]);
        }
    } catch (PDOException $e) {
        // Catch and return any database errors encountered during the operation
        echo json_encode([
            'status' => 'error',
            'message' => 'Database error: ' . $e->getMessage()
        ]);
    }
} else {
    // Return an error status if the request is invalid or missing fields
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid request or missing fields'
    ]);
}
?>

<?php
require 'database_connection.php';

// This Checks if the request is a POST and all necessary fields are present
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['title'], $_POST['start'], $_POST['end'])) {
    $title = $_POST['title'];
    $start = date('Y-m-d H:i:s', strtotime($_POST['start'])); // The format of start date
    $end = date('Y-m-d H:i:s', strtotime($_POST['end'])); // The format of end date

    // This is the SQL statement to insert the event
    $stmt = $pdo->prepare("INSERT INTO events (title, start_event, end_event) VALUES (?, ?, ?)");

    // Executes the prepared data statement with the inserted
    try {
        if ($stmt->execute([$title, $start, $end])) {
            $newEventId = $pdo->lastInsertId();
            // Return a success message after saving event
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
            // Returns an error message if the save event fails
            echo json_encode(['status' => 'error', 'message' => 'Failed to insert event']);
        }
    } catch (PDOException $e) {
        // Catches and returns any database errors founded during the proccess
        echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
    }
} else {
    // Returns an error message if the request is invalid or missing fields
    echo json_encode(['status' => 'error', 'message' => 'Invalid request or missing fields']);
}
?>

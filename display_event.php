<?php
// Include the database connection file
require 'database_connection.php';

// Prepare and execute a query to retrieve all events from the 'events' table
$query = "SELECT id, title, DATE_FORMAT(start_event, '%Y-%m-%d') as start, DATE_FORMAT(end_event, '%Y-%m-%d') as end FROM events";
$stmt = $pdo->prepare($query);
$stmt->execute();
$events = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Events</title>
    <!-- Link Bootstrap CSS for styling -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .event-card {
            margin: 10px 0;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .event-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .event-body {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="my-4">My Events</h1>
        <!-- Loop through each event and display it in a styled card -->
        <?php foreach ($events as $event): ?>
            <div class="event-card">
                <div class="event-header">
                    <h5><?php echo htmlspecialchars($event['title']); ?></h5>
                    <!-- Button triggers the deleteEvent JavaScript function with the event's ID -->
                    <button class="btn btn-danger" onclick="deleteEvent(<?php echo $event['id']; ?>)">Delete</button>
                </div>
                <div class="event-body">
                    <!-- Display formatted start and end times -->
                    <p>Start: <?php echo htmlspecialchars($event['start']); ?></p>
                    <p>End: <?php echo htmlspecialchars($event['end']); ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <!-- Link back to the main calendar view -->
    <a href="dynamic_full_calendar.php" class="btn btn-primary mb-3">Back to Calendar</a>

    <!-- Link required JavaScript libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script>
    // Function to handle event deletion
    function deleteEvent(eventId) {
        // Confirm with the user before deletion
        if (confirm('Are you sure you want to delete this event?')) {
            // Send a POST request to 'delete_event.php' with the event ID
            fetch('delete_event.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'event_id=' + eventId
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    alert('Event deleted');
                    location.reload(); // Reload the page to reflect the deletion
                } else {
                    alert('Error deleting event: ' + data.message);
                }
            })
            .catch(error => alert('Error deleting event: ' + error));
        }
    }
    </script>
</body>
</html>

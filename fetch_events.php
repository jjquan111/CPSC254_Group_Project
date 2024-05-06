<?php
require 'database_connection.php';

// Set the header to JSON since we are returning JSON data
header('Content-Type: application/json');

// Prepare the SQL statement to fetch events
$query = "SELECT id, title, start_event as start, end_event as end FROM events";
$stmt = $pdo->prepare($query);
$stmt->execute();
$events = $stmt->fetchAll(PDO::FETCH_ASSOC); //fetch all rows

echo json_encode($events); // Return the JSON data
?>
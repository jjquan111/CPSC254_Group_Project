<?php
$host = 'localhost';
$dbname = 'calendar';
$username = 'your_username';
$password = 'your_password';
// Connect to the database
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password, [
        // Set the PDO error mode to exception
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}
?>

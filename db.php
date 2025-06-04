<?php
$servername = "localhost";
$username = "root";
$password = "123456789";
$dbname = "wedding_event"; // Name of the database

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

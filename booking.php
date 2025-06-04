<?php
// Show errors (for debugging)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include DB connection
$conn = new mysqli("localhost", "root", "123456789", "event_managment");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get and sanitize input
$name       = $_POST['name'] ?? '';
$email      = $_POST['email'] ?? '';
$phone      = $_POST['phone'] ?? '';
$event_type = $_POST['event_type'] ?? '';
$venue_id   = $_POST['venue'] ?? '';
$package_id = $_POST['package'] ?? '';
$event_date = $_POST['event_date'] ?? '';

// Insert user into users table (optional: check if exists first)
$user_stmt = $conn->prepare("INSERT INTO users (name, email, phone) VALUES (?, ?, ?)");
$user_stmt->bind_param("sss", $name, $email, $phone);
$user_stmt->execute();
$user_id = $user_stmt->insert_id;

// Insert booking
$booking_stmt = $conn->prepare("INSERT INTO bookings (user_id, event_id, venue_id, package_id, event_date) VALUES (?, ?, ?, ?, ?)");
$booking_stmt->bind_param("iiiss", $user_id, $event_type, $venue_id, $package_id, $event_date);

if ($booking_stmt->execute()) {
    echo "🎉 Booking successful!";
} else {
    echo "Error: " . $booking_stmt->error;
}

$conn->close();
?>

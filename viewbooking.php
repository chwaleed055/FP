<?php
session_start();
include 'db.php'; // Database connection

// Determine user ID from session or URL
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} elseif (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
} else {
    echo "No user found.";
    exit;
}

// Fetch user details
$query = $conn->prepare("SELECT * FROM users WHERE user_id = ?");
$query->bind_param("i", $user_id);

$user = null;

if ($query->execute()) {
    $user_result = $query->get_result();
    if ($user_result && $user_result->num_rows > 0) {
        $user = $user_result->fetch_assoc();
    } else {
        echo "User not found in the database.<br>";
    }
} else {
    echo "Failed to fetch user data: " . $query->error;
    exit;
}

// Fetch booking details for the user
$bookings = [];

$booking_query = $conn->prepare("
    SELECT b.booking_id, b.event_type, v.venue_name, p.package_name, b.event_date
    FROM bookings b
    JOIN venues v ON b.venue_id = v.venue_id
    JOIN packages p ON b.package_id = p.package_id
    WHERE b.user_id = ?
");

$booking_query->bind_param("i", $user_id);

if ($booking_query->execute()) {
    $booking_result = $booking_query->get_result();
    if ($booking_result && $booking_result->num_rows > 0) {
        while ($booking = $booking_result->fetch_assoc()) {
            $bookings[] = $booking;
        }
    }
} else {
    echo "Failed to fetch booking data: " . $booking_query->error;
}

// Close connections
$booking_query->close();
$query->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Bookings</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 30px auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px #ccc;
        }
        h2 {
            color: #ffb700;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ccc;
        }
        th {
            background: #f8f8f8;
        }
    </style>
</head>
<body>

<div class="container">
    <?php if ($user): ?>
        <h2>Booking Details for <?= htmlspecialchars($user['name']) ?></h2>
        <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
        <p><strong>Phone:</strong> <?= htmlspecialchars($user['phone']) ?></p>
    <?php else: ?>
        <h2>User Details Not Available</h2>
    <?php endif; ?>

    <?php if (!empty($bookings)): ?>
        <h3>Your Bookings</h3>
        <table>
            <thead>
                <tr>
                    <th>Booking ID</th>
                    <th>Event Type</th>
                    <th>Venue</th>
                    <th>Package</th>
                    <th>Event Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bookings as $booking): ?>
                    <tr>
                        <td><?= htmlspecialchars($booking['booking_id']) ?></td>
                        <td><?= htmlspecialchars($booking['event_type']) ?></td>
                        <td><?= htmlspecialchars($booking['venue_name']) ?></td>
                        <td><?= htmlspecialchars($booking['package_name']) ?></td>
                        <td><?= htmlspecialchars($booking['event_date']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No bookings found for this user.</p>
    <?php endif; ?>
</div>

</body>
</html>

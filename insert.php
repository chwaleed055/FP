<?php
include 'db.php'; // Include your database connection file

$success = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data safely
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $comment = $_POST['comment'];

    // Use prepared statement for secure data insertion
    $stmt = $conn->prepare("INSERT INTO contacts (first_name, last_name, email, phone_number, comment) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $first_name, $last_name, $email, $phone_number, $comment);

    if ($stmt->execute()) {
        $success = true;
    } else {
        echo "<p>Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Contact Form</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color:#ffb700;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #001033;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        h1 {
            text-align: center;
            color:#ffb700;
        }

        .success-message {
            text-align: center;
            color: white;
            font-size: 2rem;
            font-weight: bold;
            margin: 15px 0;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            color:#ffb700;
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .form-group input,
        .form-group textarea {
            width: 95%;
            padding: 12px;
            border-radius: 6px;
            border: 1px solid #ddd;
            font-size: 16px;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            border-color: #ffb700;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }

        button[type="submit"] {
            width: 100%;
            padding: 14px;
            background-color: #ffb700;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #ffcc40;
        }
    </style>
    
</head>
<body>
    <div class="container">
        <h1>Contact Form</h1>

        <!-- Success message -->
        <?php if ($success): ?>
            <div class="success-message">Contact added successfully!</div>
        <?php endif; ?>

        <!-- Contact Form -->
        <form action="" method="POST">
            <div class="form-group">
                <label for="first_name">First Name *</label>
                <input type="text" id="first_name" name="first_name" required>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" id="last_name" name="last_name">
            </div>
            <div class="form-group">
                <label for="email">Email *</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="phone_number">Phone Number *</label>
                <input type="tel" id="phone_number" name="phone_number" required>
            </div>
            <div class="form-group">
                <label for="comment">Comment</label>
                <textarea id="comment" name="comment"></textarea>
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>

<?php
include 'db.php'; // Include database connection if needed for any dynamic data
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Management System</title>
    <style>
        /* Basic Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            padding-top: 40px; /* Space for the header */
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #001033;
            margin-bottom: 30px;
        }

        h2 {
            color: #333;
            margin-bottom: 10px;
        }

        p {
            color: #666;
            font-size: 1.1rem;
        }

        nav ul {
            list-style: none;
            text-align: center;
            margin: 20px 0;
        }

        nav ul li {
            display: inline-block;
            margin: 0 15px;
        }

        nav ul li a {
            color: #ffb700;
            text-decoration: none;
            font-weight: bold;
            font-size: 1.1rem;
        }

        nav ul li a:hover {
            color: #ffcc40;
        }

        footer {
            text-align: center;
            margin-top: 50px;
            padding: 20px;
            background-color: #001033;
            color: white;
        }

    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to the Contact Management System</h1>
        
        <!-- Navigation Links -->
        <nav>
            <ul>
                <li><a href="contact_form.html">Add a New Contact</a></li>
                <li><a href="view.php">View Contacts</a></li>
            </ul>
        </nav>
        
        <h2>How to Use</h2>
        <p>Use the navigation above to add new contacts or view existing contacts.</p>
    </div>

    <footer>
        <p>&copy; 2025 Contact Management System. All rights reserved.</p>
    </footer>
</body>
</html>

<?php
// Include the database connection file
include 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacts List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            border-radius: 8px;
            overflow: hidden;
        }

        table th, table td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #ffb700;
            color: #fff;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table tr:hover {
            background-color: #f1f1f1;
        }

        table a {
            color: #ffb700;
            text-decoration: none;
            font-weight: bold;
        }

        table a:hover {
            text-decoration: underline;
        }

        .no-contacts {
            color: #ff5733;
            text-align: center;
            font-size: 18px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Contacts List</h2>

        <?php
        // Query to fetch all contacts from the database
        $sql = "SELECT * FROM contacts";
        $result = mysqli_query($conn, $sql);

        // Check if there are any contacts in the database
        if (mysqli_num_rows($result) > 0) {
            // Display the contacts in a table
            echo "<table><tr><th>First Name</th><th>Last Name</th><th>Email</th><th>Phone</th><th>Comment</th><th>Actions</th></tr>";

            // Loop through the result and display each contact's information in a table row
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['first_name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['last_name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                echo "<td>" . htmlspecialchars($row['phone_number']) . "</td>";
                echo "<td>" . htmlspecialchars($row['comment']) . "</td>";
                echo "<td>
                        <a href='edit.php?id=" . $row['id'] . "'>Edit</a> | 
                        <a href='delete.php?id=" . $row['id'] . "'>Delete</a>
                      </td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            // Display message if no contacts are found
            echo "<p class='no-contacts'>No contacts found!</p>";
        }

        // Close the database connection
        mysqli_close($conn);
        ?>
    </div>
</body>
</html>

<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch contact details
    $sql = "SELECT * FROM contacts WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $contact = mysqli_fetch_assoc($result);
}

// Update contact
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $comment = $_POST['comment'];

    $update_sql = "UPDATE contacts SET 
        first_name='$first_name', 
        last_name='$last_name', 
        email='$email', 
        phone_number='$phone_number', 
        comment='$comment' 
        WHERE id = $id";

    if (mysqli_query($conn, $update_sql)) {
        header('Location: view.php');
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Contact</title>
    <style>
        body { font-family: Arial; background-color: #f4f4f9; padding: 40px; }
        .container { max-width: 600px; margin: auto; background: #fff; padding: 20px; border-radius: 8px; }
        h2 { text-align: center; color: #001033; }
        input[type="text"], input[type="email"] {
            width: 100%; padding: 10px; margin: 8px 0;
            border: 1px solid #ccc; border-radius: 4px;
        }
        textarea {
            width: 100%; padding: 10px; margin: 8px 0;
            border: 1px solid #ccc; border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #ffb700; color: white;
            padding: 10px 20px; border: none; border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #ffcc40;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Contact</h2>
        <form method="POST">
            <input type="text" name="first_name" value="<?php echo $contact['first_name']; ?>" required>
            <input type="text" name="last_name" value="<?php echo $contact['last_name']; ?>" required>
            <input type="email" name="email" value="<?php echo $contact['email']; ?>" required>
            <input type="text" name="phone_number" value="<?php echo $contact['phone_number']; ?>" required>
            <textarea name="comment"><?php echo $contact['comment']; ?></textarea>
            <input type="submit" value="Update Contact">
        </form>
    </div>
</body>
</html>

<?php
// Include database connection
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare the SQL statement
    $delete_sql = "DELETE FROM contacts WHERE id = ?";
    
    if ($stmt = mysqli_prepare($conn, $delete_sql)) {
        // Bind the parameter to the prepared statement
        mysqli_stmt_bind_param($stmt, "i", $id);
        
        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            header('Location: view.php');
        } else {
            echo "Error deleting record: " . mysqli_stmt_error($stmt);
        }
        
        // Close the prepared statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing statement: " . mysqli_error($conn);
    }
}
?>

<?php
// Include database connection
include('data_check.php');

// Check if the ID is set in the URL
if (isset($_GET['id'])) {
    // Get the ID from the URL
    $id = $_GET['id'];

    // Write the SQL query to delete the record
    $query = "DELETE FROM addmission WHERE id = $id";  // Replace 'addmission' with your actual table name

    // Execute the query
    if (mysqli_query($data, $query)) {
        // Redirect back to the main page or a success page
        header("Location: adminhome.php");  // Replace with your actual page after deletion
    } else {
        // If something went wrong, show an error message
        echo "Error deleting record: " . mysqli_error($data);
    }
}
?>

<?php
session_start(); // Start the session if not started already

// Check if the form was submitted and the postid exists
if (isset($_POST['delete_post']) && isset($_POST['postid'])) {
    // Establish database connection (assuming $conn is the connection object)
    require_once '../connectdb.php'; // Include your database connection file

    // Sanitize the postid to prevent SQL injection
    $postid = $_POST['postid'];

    // Query to delete the post with the given postid
    $deleteQuery = "DELETE FROM recruiterpost WHERE postid = '$postid'";

    // Execute the delete query
    if (mysqli_query($conn, $deleteQuery)) {
        // Deletion successful
        header("Location: ../recruitermain.php"); // Redirect to the dashboard or another appropriate page
        exit(); // Stop further execution
    } else {
        // Error occurred while deleting the post
        echo "Error deleting the post: " . mysqli_error($conn);
        // Handle the error as needed
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    // Redirect or handle cases where the form data is incomplete or not received
    header("Location: ../recruitermain.php"); // Redirect to the dashboard or another appropriate page
    exit(); // Stop further execution
}

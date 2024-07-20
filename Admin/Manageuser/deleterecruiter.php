<?php
session_start(); // Start the session if not started already

// Check if the form was submitted and the postid exists
if (isset($_POST['delete_user']) && isset($_POST['userid'])) {
    // Establish database connection (assuming $conn is the connection object)
    require_once '../connectdb.php'; // Include your database connection file

    // Sanitize the postid to prevent SQL injection
    $userid = $_POST['userid'];

    // Query to delete the post with the given postid
    $deleteQuery = "DELETE recruiterlogin, recruiterform FROM recruiterlogin INNER JOIN recruiterform ON recruiterlogin.userid = recruiterform.userid WHERE recruiterlogin.userid = '$userid'; ";

    // Execute the delete query
    if (mysqli_query($conn, $deleteQuery)) {
        // Deletion successful
        header("Location: ../recruitertable.php"); // Redirect to the dashboard or another appropriate page
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
    header("Location: ../recruitertable.php"); // Redirect to the dashboard or another appropriate page
    exit(); // Stop further execution
}

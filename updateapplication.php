<?php
require_once 'connectdb.php';
// Assuming you have already established a database connection

    // Sanitize the postid to prevent SQL injection
    $postid = $_POST['postid'];
    $rollno = $_POST['rollno'];
    $status = $_POST['status'];

    // Update the status in the database
    $query = "UPDATE jobapplication SET status = '$status' WHERE rollno = $rollno AND postid = $postid";

    // Execute the delete query
    if (mysqli_query($conn, $query)) {
        // Updation successful
        header("Location: recruitermain.php"); // Redirect to the dashboard or another appropriate page
        exit(); // Stop further execution
    } else {
        // Error occurred 
        echo "Error deleting the post: " . mysqli_error($conn);
        // Handle the error as needed
    }
?>
<?php

session_start();

// Establish connection to your database
require_once 'connectdb.php';

// Get form data
$rollno = $_POST['rollno']; // Assuming the input name in the form is 'email'
$password = $_POST['password'];

// Retrieve user data from the database using email
$sql = "SELECT * FROM studentlogin WHERE rollno= $rollno";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // WARNING: Storing passwords in plaintext is not secure. Consider using hashing and salting.
    if ($password === $row['password']) {
        $_SESSION['rollno'] = $rollno;

        // Check if the student is an UG or PG based on a column in the database
        $course = $row['course']; // Assuming a column 'student_type' differentiates between UG and PG

        if ($course === 'UG') {
            header("Location:./studentmainug.php"); // Redirect to UG dashboard
            exit();
        } elseif ($course === 'PG') {
            header("Location:./studentmainpg.php"); // Redirect to PG dashboard
            exit();
        } else {
            echo "Unknown student type!";
            // Handle the case where student type is neither UG nor PG
        }
    } else {
        $message = "Incorrect Password Try Agian";
        echo "<script type='text/javascript'>alert('$message');</script>";
        echo ("<script>window.location = 'studentlogin.html';</script>");
    }
} else {
    $message = "Invalid Username and Password Try Agian";
    echo "<script type='text/javascript'>alert('$message');</script>";
    echo ("<script>window.location = 'studentlogin.html';</script>");
}

$conn->close();
?>
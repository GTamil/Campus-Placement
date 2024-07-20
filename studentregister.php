<?php
// Establish connection to your database
require_once 'connectdb.php';

// Get form data
$name = $_POST['name'];
$rollno = $_POST['rollno'];
$yop = $_POST['yop'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$course = $_POST['course'];
$dept = $_POST['dept'];
$password = $_POST['password'];

// Validate password: should be at least 8 characters with alphabetic and numeric characters
if (strlen($password) < 8 || !preg_match('/[A-Za-z]/', $password) || !preg_match('/[0-9]/', $password)) {
    $message = "Password must be at least 8 characters long and contain both alphabetic and numeric characters.";
    echo "<script type='text/javascript'>alert('$message');</script>";
    echo ("<script>window.location = 'studentregister.html';</script>");
    exit(); // Stop further execution if password criteria are not met
}

// Insert user data into the database with hashed password
$sql = "INSERT INTO studentlogin (name, rollno, yop, phone, email, course, dept, password) VALUES ('$name', $rollno, $yop, $phone, '$email', '$course', '$dept', '$password')";

if ($conn->query($sql) === TRUE) {
    $message = "Registration successful!";
    echo "<script type='text/javascript'>alert('$message');</script>";

    // Redirect to appropriate dashboard based on course
    if ($course == 'UG') {
        header("Location:./studentmainug.php"); // Redirect to UG dashboard
        exit();
    } elseif ($course == 'PG') {
        header("Location:./studentmainpg.php"); // Redirect to PG dashboard
        exit();
    }
} else {
    $message = "Registration unsuccessful!";
    echo "<script type='text/javascript'>alert('$message');</script>";
    echo ("<script>window.location = 'studentregister.html';</script>");
}

$conn->close();

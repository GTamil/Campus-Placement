<?php
require_once 'connectdb.php';

// Get form data
$cname = $_POST['cname'];
$cemail = $_POST['cemail'];
$cphone = $_POST['cphone'];
$username = $_POST['username'];
$password = $_POST['password'];

// Validate Password: should be at least 8 characters with alphabetic and numeric characters
if (strlen($password) < 8 || !preg_match('/[A-Za-z]/', $password) || !preg_match('/[0-9]/', $password)) {
    $message = "Password must be at least 8 characters long and contain both alphabetic and numeric characters.";
    echo "<script type='text/javascript'>alert('$message');</script>";
    echo ("<script>window.location = 'recruiterregister.html';</script>");
    exit(); // Stop further execution if password criteria are not met
}

// Insert user data into the database with hashed password
$sql = "INSERT INTO recruiterlogin (cname, cemail, cphone, username, password) VALUES ('$cname', '$cemail', '$cphone', '$username', '$password')";

if ($conn->query($sql) === TRUE) {
    $_SESSION['cname'] = $cname;
    $message = "Registration successful!";
    echo "<script type='text/javascript'>alert('$message');</script>";
    echo ("<script>window.location = 'recruiterlogin.html';</script>");
} else {
    $message = "Registration unsuccessful!";
    echo "<script type='text/javascript'>alert('$message');</script>";
    echo ("<script>window.location = 'recruiterregister.html';</script>");
}

$conn->close();
?>
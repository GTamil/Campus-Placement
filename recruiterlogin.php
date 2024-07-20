<?php

session_start();

// Establish connection to your database
require_once 'connectdb.php';

// Get form data
$username = $_POST['username']; // Assuming the input name in the form is 'email'
$password = $_POST['password'];

// Retrieve user data from the database using email
$sql = "SELECT * FROM recruiterlogin WHERE username= '$username'";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // WARNING: Storing passwords in plaintext is not secure. Consider using hashing and salting.
    if ($password === $row['password']) {
        $_SESSION['username'] = $username;

        // Check if the company username
        header('Location:recruiterhome.php');
        exit;
        // $message = "Successful Login";
        // echo "<script type='text/javascript'>alert('$message');</script>";
        // echo ("<script>window.location = 'recruiterhome.php';</script>");

    } else {
        $message = "Incorrect Password Try Agian";
        echo "<script type='text/javascript'>alert('$message');</script>";
        echo ("<script>window.location = 'recruiterlogin.html';</script>");
    }
} else {
    $message = "Invalid Username and Password Try Agian";
    echo "<script type='text/javascript'>alert('$message');</script>";
    echo ("<script>window.location = 'recruiterlogin.html';</script>");
}

$conn->close();
?>
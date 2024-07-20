<?php

session_start();

// Establish connection to your database
require_once 'connectdb.php';

// Get form data
$idnum = $_POST['idnum']; // Assuming the input name in the form is 'email'
$password = $_POST['password'];

// Retrieve user data from the database using email
$sql = "SELECT * FROM stafflogin WHERE idnum= $idnum";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // WARNING: Storing passwords in plaintext is not secure. Consider using hashing and salting.
    if ($password === $row['password']) {
        $_SESSION['idnum'] = $idnum;
         // Check if the company username
         header('Location:staffhome.php');
         exit;
    } else {
        $message = "Incorrect Password Try Agian";
        echo "<script type='text/javascript'>alert('$message');</script>";
        echo ("<script>window.location = 'stafflogin.html';</script>");
    }
} else {
    $message = "Invalid Username and Password Try Agian";
    echo "<script type='text/javascript'>alert('$message');</script>";
    echo ("<script>window.location = 'stafflogin.html';</script>");
}

$conn->close();
?>
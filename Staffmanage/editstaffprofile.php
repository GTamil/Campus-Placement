<?php
session_start();

require_once '../connectdb.php';

@$idnum = $_SESSION["idnum"];

// Get form data
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$age = $_POST['age'];

$updateQuery = "UPDATE staffform SET name = '$name', email = '$email', phone = '$phone', age = '$age' WHERE idnum = '$idnum'";

if ($conn->query($updateQuery) === TRUE) {
    $message = "Profile updated successfully!";
    echo "<script type='text/javascript'>alert('$message');</script>";
    echo ("<script>window.location = '../staffprofile.php';</script>");
} else {
    $message = "Profile updated unsuccessfull!";
    echo "<script type='text/javascript'>alert('$message');</script>";
    echo ("<script>window.location = '../staffprofile.php';</script>");
}

$conn->close();
?>
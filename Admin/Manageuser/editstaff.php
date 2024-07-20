<?php
session_start();

require_once '../connectdb.php';

@$idnum = $_SESSION["idnum"];

// Get form data
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
// $age = $_POST['age'];
$stype = $_POST['stype'];
$role = $_POST['role'];
$staff = $_POST['staff'];
$dept = $_POST['dept'];
$password = $_POST['password'];

$updateQuery = "UPDATE staffform SET name = '$name', email = '$email', phone = '$phone', stype= '$stype', role= '$role',staff= '$staff', dept = '$dept' WHERE idnum = '$idnum'";
$result1 = mysqli_query($conn, $updateQuery);

// Update stafflogin table
$updateLoginQuery = "UPDATE stafflogin SET name = '$name', email = '$email', phone = '$phone', stype= '$stype', role= '$role',staff= '$staff', dept = '$dept', password = '$password' WHERE idnum = '$idnum'";
$result2 = mysqli_query($conn, $updateLoginQuery);

// Check if both updates were successful
if ($result1 && $result2) {
    $message = "Profile updated successfully!";
    echo "<script type='text/javascript'>alert('$message');</script>";
    echo ("<script>window.location = '../stafftable.php';</script>");
} else {
    $message = "Profile updated unsuccessfull!";
    echo "<script type='text/javascript'>alert('$message');</script>";
    echo ("<script>window.location = '../stafftable.php';</script>");
}

$conn->close();

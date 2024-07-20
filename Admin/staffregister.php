<?php
// Establish connection to your database
require_once 'connectdb.php';

// Get form data
$name = $_POST['name'];
$idnum = $_POST['idnum'];
$email = $_POST['email'];
$phone = $_POST['phone'];
// $dob = $_POST['dob'];
// $age = $_POST['age'];
$gender = $_POST['gender'];
$stype = $_POST['stype'];
$role = $_POST['role'];
$staff = $_POST['staff'];
$dept = $_POST['dept'];
$password = $_POST['password'];

// Validate password: should be at least 8 characters with alphabetic and numeric characters
if (strlen($password) < 8 || !preg_match('/[A-Za-z]/', $password) || !preg_match('/[0-9]/', $password)) {
    $message = "Password must be at least 8 characters long and contain both alphabetic and numeric characters.";
    echo "<script type='text/javascript'>alert('$message');</script>";
    echo ("<script>window.location = 'form.php';</script>");
    exit(); // Stop further execution if password criteria are not met
}

// Insert user data into the database with hashed password
$sql = "INSERT INTO stafflogin (name, idnum, email, phone, gender, stype, role, staff, dept, password) VALUES ('$name', $idnum, '$email', $phone, '$gender', '$stype', '$role', '$staff', '$dept', '$password')";

if ($conn->query($sql) === TRUE) {
    $message = "Registration successful!";
    echo "<script type='text/javascript'>alert('$message');</script>";
    echo ("<script>window.location = 'form.php';</script>");
    return;
} else {
    $message = "Registration unsuccessful!";
    echo "<script type='text/javascript'>alert('$message');</script>";
    echo ("<script>window.location = 'form.php';</script>");
   return;
}

$conn->close();
?>
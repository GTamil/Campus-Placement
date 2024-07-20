<?php
session_start();

require_once '../connectdb.php';

@$username = $_SESSION["username"];

// // Fetching cname based on username
// $cnameQuery = "SELECT cname FROM recruiterform WHERE username = '$username'";
// $result = $conn->query($cnameQuery);

// Get form data
$cname = $_POST['cname'];
$cemail = $_POST['cemail'];
$cweb = $_POST['cweb'];
$caddress = $_POST['caddress'];
$city = $_POST['city'];
$pincode = $_POST['pincode'];
$state = $_POST['state'];
$country = $_POST['country'];
$hrname = $_POST['hrname'];
$hremail = $_POST['hremail'];
$hrphone = $_POST['hrphone'];

$updateQuery = "UPDATE recruiterform SET cname = '$cname', cemail = '$cemail', cweb = '$cweb', caddress = '$caddress', city = '$city', pincode = '$pincode', state = '$state', country = '$country', hrname = '$hrname', hremail = '$hremail', hrphone = '$hrphone' WHERE username = '$username'";

if ($conn->query($updateQuery) === TRUE) {
    $message = "Profile updated successfully!";
    echo "<script type='text/javascript'>alert('$message');</script>";
    echo ("<script>window.location = '../recruitermain.php';</script>");
} else {
    $message = "Profile updated unsuccessfull!";
    echo "<script type='text/javascript'>alert('$message');</script>";
    echo ("<script>window.location = '../recruitermain.php';</script>");
}

$conn->close();
?>
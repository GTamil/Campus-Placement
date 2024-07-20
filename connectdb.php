<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "careerdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if (!$conn) 
  	die("Connection Error: " . mysqli_connect_error());
?>
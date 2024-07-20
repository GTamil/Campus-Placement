<?php
session_start();

require_once 'connectdb.php';

// Get form data
$userid = $_POST['userid'];
$postid = $_POST['postid'];
$cname = $_POST['cname'];
$title = $_POST['title'];
$name = $_POST['name'];
$rollno = $_POST['rollno'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$course = $_POST['course'];
$dept = $_POST['dept'];
$per = $_POST['per'];

// File upload handling for PDF UG
if ($_FILES['user_file1']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['user_file1']['tmp_name'];
    $fileName = $_FILES['user_file1']['name'];
    $fileSize = $_FILES['user_file1']['size'];
    $fileType = $_FILES['user_file1']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    // Specify the directory where you want to save the uploaded PDF files
    $pdfUploadDirectory = 'Uploads/Ruploads/Application/';

    // You may want to generate a unique filename to prevent overwriting files with the same name
    $newFileName = 'Resume' . $rollno . '.' . $fileExtension;

    // Check file size and allowed file types
    $allowedExtensions = ['pdf'];
    $maxFileSize = 10 * 1024 * 1024; // 10MB

    if (in_array($fileExtension, $allowedExtensions) && $fileSize <= $maxFileSize) {
        $uploadPath = $pdfUploadDirectory . $newFileName;

        if (move_uploaded_file($fileTmpPath, $uploadPath)) {
            $pdfUploadPath = $uploadPath;

            // Insert user data into the database
            $sql = "INSERT INTO jobapplication (userid, postid, cname, title, name, rollno, phone, email, course, dept, per, file_path1) VALUES ('$userid', '$postid', '$cname', '$title', '$name', '$rollno','$phone', '$email','$course', '$dept', '$per', '$pdfUploadPath')";

            if ($conn->query($sql) === TRUE) {
                $message = "Upload successful!";
                echo "<script type='text/javascript'>alert('$message');</script>";
                return;
            } else {
                $message = "Upload unsuccessful!";
                echo "<script type='text/javascript'>alert('$message');</script>";
                return;
            }

            // PDF file uploaded successfully
        } else {
            // Failed to move uploaded PDF file
            $message = "PDF File upload failed!";
            echo "<script type='text/javascript'>alert('$message');</script>";
            // echo ("<script>window.location = 'studentugform.php';</script>");
        }
    } else {
        // PDF file size or type not allowed
        $message = "Invalid PDF file! Please upload a PDF of size up to 10MB.";
        echo "<script type='text/javascript'>alert('$message');</script>";
        // echo ("<script>window.location = 'studentugform.php';</script>");
    }
}

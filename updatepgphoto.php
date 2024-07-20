<?php
session_start();

require_once 'connectdb.php';

@$rollno = $_SESSION["rollno"]; 

if ($_FILES['user_photo']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['user_photo']['tmp_name'];
    $fileName = $_FILES['user_photo']['name'];
    $fileSize = $_FILES['user_photo']['size'];
    $fileType = $_FILES['user_photo']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    $uploadDirectory = 'Uploads/Profile/PGStudent/';

    $newFileName = 'User_' . $rollno . '.' . $fileExtension;
    $uploadPath = $uploadDirectory . $newFileName;

    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    $maxFileSize = 10 * 1024 * 1024; // 10MB

    if (in_array($fileExtension, $allowedExtensions) && $fileSize <= $maxFileSize) {
        if (move_uploaded_file($fileTmpPath, $uploadPath)) {
            // Update the existing photo path in the database
            $updateQuery = "UPDATE studentpgform SET photo_path = '$uploadPath' WHERE rollno = '$rollno'";

            if ($conn->query($updateQuery) === TRUE) {
                $message = "New photo uploaded successfully!";
                echo "<script type='text/javascript'>alert('$message');</script>";
                echo ("<script>window.location = 'pgprofile.php';</script>");
            } else {
                $message = "Failed to upload new photo!";
                echo "<script type='text/javascript'>alert('$message');</script>";
                echo ("<script>window.location = 'pgprofile.php';</script>");
            }
        } else {
            $message = "File upload failed!";
            echo "<script type='text/javascript'>alert('$message');</script>";
            echo ("<script>window.location = 'pgprofile.php';</script>");
        }
    } else {
        $message = "Invalid file! Please upload an image (jpg, jpeg, png, gif) of size up to 10MB.";
        echo "<script type='text/javascript'>alert('$message');</script>";
        echo ("<script>window.location = 'pgprofile.php';</script>");
    }
} else {
    $message = "No file uploaded or an error occurred!";
    echo "<script type='text/javascript'>alert('$message');</script>";
    echo ("<script>window.location = 'pgprofile.php';</script>");
}

$conn->close();
?>

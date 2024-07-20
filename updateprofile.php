<?php
session_start();

require_once 'connectdb.php';

@$username = $_SESSION["username"];

// Fetching cname based on username
$cnameQuery = "SELECT cname FROM recruiterform WHERE username = '$username'";
$result = $conn->query($cnameQuery);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $cname = $row['cname']; // Assuming 'cname' is the column name in the database
}

// File upload handling for image
if ($_FILES['user_photo1']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['user_photo1']['tmp_name'];
    $fileName = $_FILES['user_photo1']['name'];
    $fileSize = $_FILES['user_photo1']['size'];
    $fileType = $_FILES['user_photo1']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    // Specify the directory where you want to save the uploaded image files
    $imageUploadDirectory = 'Uploads/Profile/Recruiter/Profilephoto/';

    // You may want to generate a unique filename to prevent overwriting files with the same name
    $newFileName = 'Profile_' . $cname . '.' . $fileExtension;

    // Check file size and allowed file types
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    $maxFileSize = 10 * 1024 * 1024; // 10MB

    if (in_array($fileExtension, $allowedExtensions) && $fileSize <= $maxFileSize) {
        $uploadPath = $imageUploadDirectory . $newFileName;

        if (move_uploaded_file($fileTmpPath, $uploadPath)) {
            $imageUploadPath1 = $uploadPath;
            // Image file uploaded successfully
            // Now proceed to handle PDF file upload

            $updateQuery = "UPDATE recruiterform SET photo_path1 = '$imageUploadPath1' WHERE username = '$username'";

            if ($conn->query($updateQuery) === TRUE) {
                $message = "New photo uploaded successfully!";
                echo "<script type='text/javascript'>alert('$message');</script>";
                echo ("<script>window.location = 'recruitermain.php';</script>");
            } else {
                $message = "Failed to upload new photo!";
                echo "<script type='text/javascript'>alert('$message');</script>";
                echo ("<script>window.location = 'recruitermain.php';</script>");
            }
        } else {
            $message = "File upload failed!";
            echo "<script type='text/javascript'>alert('$message');</script>";
            echo ("<script>window.location = 'recruitermain.php';</script>");
        }
    } else {
        $message = "Invalid file! Please upload an image (jpg, jpeg, png, gif) of size up to 10MB.";
        echo "<script type='text/javascript'>alert('$message');</script>";
        echo ("<script>window.location = 'recruitermain.php';</script>");
    }
} else {
    $message = "No file uploaded or an error occurred!";
    echo "<script type='text/javascript'>alert('$message');</script>";
    echo ("<script>window.location = 'recruitermain.php';</script>");
}

$conn->close();

<?php
session_start();

require_once 'connectdb.php';

@$idnum = $_SESSION["idnum"];

// Fetching cname based on username
$role = "SELECT * FROM staffform WHERE idnum = '$idnum'";
$result = $conn->query($role);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $role = $row['role']; // Assuming 'cname' is the column name in the database
}

if ($_FILES['user_photo1']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['user_photo1']['tmp_name'];
    $fileName = $_FILES['user_photo1']['name'];
    $fileSize = $_FILES['user_photo1']['size'];
    $fileType = $_FILES['user_photo1']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    // Specify the directory where you want to save the uploaded image files
    $imageUploadDirectory = 'Uploads/Profile/Staff/';

    // You may want to generate a unique filename to prevent overwriting files with the same name
    $newFileName = 'Profile_' . $role .'_'. $idnum . '.' . $fileExtension;

    // Check file size and allowed file types
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    $maxFileSize = 10 * 1024 * 1024; // 10MB

    if (in_array($fileExtension, $allowedExtensions) && $fileSize <= $maxFileSize) {
        $uploadPath = $imageUploadDirectory . $newFileName;

        if (move_uploaded_file($fileTmpPath, $uploadPath)) {
            $imageUploadPath1 = $uploadPath;
            // Image file uploaded successfully
            // Now proceed to handle PDF file upload

            $updateQuery = "UPDATE staffform SET photo_path1 = '$imageUploadPath1' WHERE idnum = '$idnum'";

            if ($conn->query($updateQuery) === TRUE) {
                $message = "New photo uploaded successfully!";
                echo "<script type='text/javascript'>alert('$message');</script>";
                echo ("<script>window.location = 'staffprofile.php';</script>");
            } else {
                $message = "Failed to upload new photo!";
                echo "<script type='text/javascript'>alert('$message');</script>";
                echo ("<script>window.location = 'staffprofile.php';</script>");
            }
        } else {
            $message = "File upload failed!";
            echo "<script type='text/javascript'>alert('$message');</script>";
            echo ("<script>window.location = 'staffprofile.php';</script>");
        }
    } else {
        $message = "Invalid file! Please upload an image (jpg, jpeg, png, gif) of size up to 10MB.";
        echo "<script type='text/javascript'>alert('$message');</script>";
        echo ("<script>window.location = 'staffprofile.php';</script>");
    }
} else {
    $message = "No file uploaded or an error occurred!";
    echo "<script type='text/javascript'>alert('$message');</script>";
    echo ("<script>window.location = 'staffprofile.php';</script>");
}

$conn->close();

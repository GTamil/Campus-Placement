<?php
session_start();

require_once 'connectdb.php';

// Get form data
$userid = $_POST['userid'];
$name = $_POST['name'];
$idnum = $_POST['idnum'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$dob = $_POST['dob'];
$age = $_POST['age'];
$stype = $_POST['stype'];
$role = $_POST['role'];
$staff = $_POST['staff'];
$dept = $_POST['dept'];


// File upload handling for image
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
    $newFileName = 'Profile_' . $dept . $idnum. '.' . $fileExtension;

    // Check file size and allowed file types
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    $maxFileSize = 10 * 1024 * 1024; // 10MB

    if (in_array($fileExtension, $allowedExtensions) && $fileSize <= $maxFileSize) {
        $uploadPath = $imageUploadDirectory . $newFileName;

        if (move_uploaded_file($fileTmpPath, $uploadPath)) {
            $imageUploadPath1 = $uploadPath;
            // Image file uploaded successfully
            // Now proceed to handle PDF file upload

            // Insert user data into the database
            $sql = "INSERT INTO staffform (userid, name, idnum, email, phone, dob, age, stype, role, staff, dept, photo_path1) VALUES ('$userid', '$name', $idnum, '$email', '$phone', '$dob', $age , '$stype', '$role', '$staff', '$dept', '$imageUploadPath1')";

            if ($conn->query($sql) === TRUE) {
                $message = "Upload successful!";
                echo "<script type='text/javascript'>alert('$message');</script>";
                echo ("<script>window.location = 'staffhome.php';</script>");
            } else {
                $message = "Upload unsuccessful!";
                echo "<script type='text/javascript'>alert('$message');</script>";
                echo ("<script>window.location = 'staffdetail.php';</script>");
            }
            // need to go down
        } else {
            // Failed to move uploaded image file
            $message = "Image upload failed!";
            echo "<script type='text/javascript'>alert('$message');</script>";
            echo ("<script>window.location = 'staffdetail.php';</script>");
        }
    } else {
        // Image file size or type not allowed
        $message = "Invalid image file! Please upload an image (jpg, jpeg, png, gif) of size up to 10MB.";
        echo "<script type='text/javascript'>alert('$message');</script>";
        echo ("<script>window.location = 'staffdetail.php';</script>");
    }
}

$conn->close();

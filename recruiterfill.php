<?php
session_start();

require_once 'connectdb.php';

// Get form data
$userid = $_POST['userid'];
$username = $_POST['username'];
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

$_SESSION['userid'] = $row['userid'];

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
        } else {
            // Failed to move uploaded image file
            $message = "Image upload failed!";
            echo "<script type='text/javascript'>alert('$message');</script>";
            echo ("<script>window.location = 'recruiterform.php';</script>");
        }
    } 

// File upload handling for image
if ($_FILES['user_photo2']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['user_photo2']['tmp_name'];
    $fileName = $_FILES['user_photo2']['name'];
    $fileSize = $_FILES['user_photo2']['size'];
    $fileType = $_FILES['user_photo2']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    // Specify the directory where you want to save the uploaded image files
    $imageUploadDirectory = 'Uploads/Profile/Recruiter/Coverphoto/';

    // You may want to generate a unique filename to prevent overwriting files with the same name
    $newFileName = 'Cover_' . $cname . '.' . $fileExtension;

    // Check file size and allowed file types
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    $maxFileSize = 10 * 1024 * 1024; // 10MB

    if (in_array($fileExtension, $allowedExtensions) && $fileSize <= $maxFileSize) {
        $uploadPath = $imageUploadDirectory . $newFileName;

        if (move_uploaded_file($fileTmpPath, $uploadPath)) {
            $imageUploadPath2 = $uploadPath;
            // Image file uploaded successfully
            // Now proceed to handle PDF file upload

            // Insert user data into the database
            $sql = "INSERT INTO recruiterform (userid, username, cname, cemail, cweb, caddress, city, pincode, state, country, hrname, hremail, hrphone, photo_path1, photo_path2) VALUES ('$userid', '$username', '$cname', '$cemail', '$cweb', '$caddress', '$city', '$pincode', '$state', '$country', '$hrname', '$hremail', '$hrphone', '$imageUploadPath1', '$imageUploadPath2')";

            if ($conn->query($sql) === TRUE) {
                $message = "Upload successful!";
                echo "<script type='text/javascript'>alert('$message');</script>";
                echo ("<script>window.location = 'recruitermain.php';</script>");
            } else {
                $message = "Upload unsuccessful!";
                echo "<script type='text/javascript'>alert('$message');</script>";
                echo ("<script>window.location = 'recruiterform.php';</script>");
            }
            // need to go down
        } else {
            // Failed to move uploaded image file
            $message = "Image upload failed!";
            echo "<script type='text/javascript'>alert('$message');</script>";
            echo ("<script>window.location = 'recruiterform.php';</script>");
        }
    } else {
        // Image file size or type not allowed
        $message = "Invalid image file! Please upload an image (jpg, jpeg, png, gif) of size up to 10MB.";
        echo "<script type='text/javascript'>alert('$message');</script>";
        echo ("<script>window.location = 'recruiterform.php';</script>");
    }
}
else {
    // Image file size or type not allowed
    $message = "Invalid image file! Please upload an image (jpg, jpeg, png, gif) of size up to 10MB.";
    echo "<script type='text/javascript'>alert('$message');</script>";
    echo ("<script>window.location = 'recruiterform.php';</script>");
}
}

$conn->close();
?>
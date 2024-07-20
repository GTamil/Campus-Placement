<?php
session_start();

require_once 'connectdb.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data

    $idnum = $_POST['idnum'];
    $role = $_POST['role'];
    $postid = $_POST['postid'];
    $stream = $_POST['stream'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    // File upload handling for image
    if ($_FILES['user_photo']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['user_photo']['tmp_name'];
        $fileName = $_FILES['user_photo']['name'];
        $fileSize = $_FILES['user_photo']['size'];
        $fileType = $_FILES['user_photo']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Specify the directory where you want to save the uploaded image files
        $imageUploadDirectory = 'Uploads/Staffuploads/Post/';

        // File renaming with the postid
        $newFileName = 'Post_ID_' . $postid . '_' . $role . '.' . $fileExtension;

        // Update the file path with the new file name
        $imageUploadPath = $imageUploadDirectory.$newFileName;

        // Update post data in the database
        $sql = "UPDATE staffpost SET idnum = '$idnum', stream = '$stream', title = '$title', description = '$description', photo_path = '$imageUploadPath' WHERE postid = $postid";

        if ($conn->query($sql) === TRUE) {
            // Move uploaded image file to the designated directory
            if (move_uploaded_file($fileTmpPath, $imageUploadPath)) {
                // Redirect to recruitermain.php
                header('Location: staffprofile.php');
                exit;
            } else {
                $message = "Failed to move uploaded image file!";
            }
        } else {
            $message = "Failed to update post!";
        }
    } else {
        $message = "No image uploaded!";
    }

    // Display error message and redirect
    echo "<script type='text/javascript'>alert('$message');</script>";
    echo "<script>window.location = 'staffprofile.php';</script>";
}

$conn->close();
?>

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

// Get form data
$idnum = $_POST['idnum'];
$role = $_POST['role'];
$stream = $_POST['stream'];
$title = $_POST['title'];
$description = $_POST['description'];
// $form = $_POST['form'];
// $link = $_POST['link'];

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

    // Insert user data into the database
    $sql = "INSERT INTO staffpost (idnum, role, stream, title, description, photo_path) VALUES ('$idnum', '$role', '$stream', '$title', '$description', '')";

    if ($conn->query($sql) === TRUE) {
        // Retrieve the auto-generated postid after insertion
        $postid = $conn->insert_id;

        // File renaming with the retrieved postid
        $newFileName = 'Post_ID_' . $postid . '_' . $role . '.' . $fileExtension;

        // Update the file path with the new file name
        $imageUploadPath = $imageUploadDirectory . $newFileName;

        if (move_uploaded_file($fileTmpPath, $imageUploadPath)) {
            // Update the photo_path in the database with the new file path
            $updateSql = "UPDATE staffpost SET photo_path = '$imageUploadPath' WHERE postid = $postid";

            if ($conn->query($updateSql) === TRUE) {
                // Image file uploaded and paths updated successfully
                $_SESSION['idnum'] = $idnum;
                header('Location: staffprofile.php');
                exit;
            } else {
                $message = "Failed to update photo path!";
            }
        } else {
            // Failed to move uploaded image file
            $message = "Image upload failed!";
        }
    } else {
        // Insert query failed
        $message = "Upload unsuccessful!";
    }
} else {
    // File upload error
    $message = "Error uploading file!";
    echo "<script type='text/javascript'>alert('$message');</script>";
    echo "<script>window.location = './staffprofile.php';</script>";
    exit;
}

$conn->close();

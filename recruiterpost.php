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
$username = $_POST['username'];
$cname = $_POST['cname'];
$userid = $_POST['userid'];
$stream = $_POST['stream'];
$yop = $_POST['yop'];
$title = $_POST['title'];
$description = $_POST['description'];
$form = $_POST['form'];
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
    $imageUploadDirectory = 'Uploads/Ruploads/Post/';

    // Insert user data into the database
    $sql = "INSERT INTO recruiterpost (username, cname, userid, stream, yop, title, description, form, photo_path) VALUES ('$username', '$cname', '$userid', '$stream', '$yop', '$title', '$description', '$form', '')";

    if ($conn->query($sql) === TRUE) {
        // Retrieve the auto-generated postid after insertion
        $postid = $conn->insert_id;

        // File renaming with the retrieved postid
        $newFileName = 'Post_ID_'. $postid .'_'. $cname . '.' . $fileExtension;

        // Update the file path with the new file name
        $imageUploadPath = $imageUploadDirectory . $newFileName;

        if (move_uploaded_file($fileTmpPath, $imageUploadPath)) {
            // Update the photo_path in the database with the new file path
            $updateSql = "UPDATE recruiterpost SET photo_path = '$imageUploadPath' WHERE postid = $postid";

            if ($conn->query($updateSql) === TRUE) {
                // Image file uploaded and paths updated successfully
                $_SESSION['cname'] = $row['cname'];
              

                // Redirect to recruitermain.php
                header('Location:recruitermain.php');
                exit;
            } else {
                // Failed to update photo_path in the database
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

    // Display error message and redirect
    echo "<script type='text/javascript'>alert('$message');</script>";
    echo "<script>window.location = 'recruitermain.php';</script>";
}

$conn->close();
?>

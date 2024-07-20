<?php
session_start();

require_once 'connectdb.php';

// Get form data
$phone = $_POST['phone'];
$email = $_POST['email'];
$fname = $_POST['fname'];
$mname = $_POST['mname'];
$peradd = $_POST['peradd'];
$city = $_POST['city'];
$pincode = $_POST['pincode'];
$state = $_POST['state'];
$country = $_POST['country'];
$school1 = $_POST['school1'];
$school2 = $_POST['school2'];
$tenth = $_POST['tenth'];
$twelveth = $_POST['twelveth'];
$ug = $_POST['ug'];
// Retrieve other form fields in a similar manner

@$rollno = $_SESSION["rollno"]; // Assuming you have stored user ID in the session

// File upload handling for PDF 10th
if ($_FILES['user_file1']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['user_file1']['tmp_name'];
    $fileName = $_FILES['user_file1']['name'];
    $fileSize = $_FILES['user_file1']['size'];
    $fileType = $_FILES['user_file1']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    // Specify the directory where you want to save the uploaded PDF files
    $pdfUploadDirectory = 'Uploads/Suploads/UG/';

    // You may want to generate a unique filename to prevent overwriting files with the same name
    $newFileName = '10th_Certificate_' . $rollno . '.' . $fileExtension;

    // Check file size and allowed file types
    $allowedExtensions = ['pdf'];
    $maxFileSize = 10 * 1024 * 1024; // 10MB

    if (in_array($fileExtension, $allowedExtensions) && $fileSize <= $maxFileSize) {
        $uploadPath = $pdfUploadDirectory . $newFileName;

        if (move_uploaded_file($fileTmpPath, $uploadPath)) {
            $pdfUploadPath1 = $uploadPath;
            // PDF file uploaded successfully
        } else {
            // Failed to move uploaded PDF file
            $message = "PDF File upload failed!";
            echo "<script type='text/javascript'>alert('$message');</script>";
            echo ("<script>window.location = 'ugprofile.php';</script>");
        }
    } else {
        // PDF file size or type not allowed
        $message = "Invalid PDF file! Please upload a PDF of size up to 10MB.";
        echo "<script type='text/javascript'>alert('$message');</script>";
        echo ("<script>window.location = 'ugprofile.php';</script>");
    }
}

// File upload handling for PDF 12th
if ($_FILES['user_file2']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['user_file2']['tmp_name'];
    $fileName = $_FILES['user_file2']['name'];
    $fileSize = $_FILES['user_file2']['size'];
    $fileType = $_FILES['user_file2']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    // Specify the directory where you want to save the uploaded PDF files
    $pdfUploadDirectory = 'Uploads/Suploads/UG/';

    // You may want to generate a unique filename to prevent overwriting files with the same name
    $newFileName = '12th_Certificate_' . $rollno . '.' . $fileExtension;

    // Check file size and allowed file types
    $allowedExtensions = ['pdf'];
    $maxFileSize = 10 * 1024 * 1024; // 10MB

    if (in_array($fileExtension, $allowedExtensions) && $fileSize <= $maxFileSize) {
        $uploadPath = $pdfUploadDirectory . $newFileName;

        if (move_uploaded_file($fileTmpPath, $uploadPath)) {
            $pdfUploadPath2 = $uploadPath;
            // PDF file uploaded successfully
        } else {
            // Failed to move uploaded PDF file
            $message = "PDF File upload failed!";
            echo "<script type='text/javascript'>alert('$message');</script>";
            echo ("<script>window.location = 'ugprofile.php';</script>");
        }
    } else {
        // PDF file size or type not allowed
        $message = "Invalid PDF file! Please upload a PDF of size up to 10MB.";
        echo "<script type='text/javascript'>alert('$message');</script>";
        echo ("<script>window.location = 'ugprofile.php';</script>");
    }
}

// File upload handling for PDF UG
if ($_FILES['user_file3']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['user_file3']['tmp_name'];
    $fileName = $_FILES['user_file3']['name'];
    $fileSize = $_FILES['user_file3']['size'];
    $fileType = $_FILES['user_file3']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    // Specify the directory where you want to save the uploaded PDF files
    $pdfUploadDirectory = 'Uploads/Suploads/UG/';

    // You may want to generate a unique filename to prevent overwriting files with the same name
    $newFileName = 'UG_Marksheet_' . $rollno . '.' . $fileExtension;

    // Check file size and allowed file types
    $allowedExtensions = ['pdf'];
    $maxFileSize = 10 * 1024 * 1024; // 10MB

    if (in_array($fileExtension, $allowedExtensions) && $fileSize <= $maxFileSize) {
        $uploadPath = $pdfUploadDirectory . $newFileName;

        if (move_uploaded_file($fileTmpPath, $uploadPath)) {
            $pdfUploadPath3 = $uploadPath;
            // PDF file uploaded successfully
        } else {
            // Failed to move uploaded PDF file
            $message = "PDF File upload failed!";
            echo "<script type='text/javascript'>alert('$message');</script>";
            echo ("<script>window.location = 'studentugform.php';</script>");
        }
    } else {
        // PDF file size or type not allowed
        $message = "Invalid PDF file! Please upload a PDF of size up to 10MB.";
        echo "<script type='text/javascript'>alert('$message');</script>";
        echo ("<script>window.location = 'studentugform.php';</script>");
    }
}

// File upload handling for PDF CV
if ($_FILES['user_file4']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['user_file4']['tmp_name'];
    $fileName = $_FILES['user_file4']['name'];
    $fileSize = $_FILES['user_file4']['size'];
    $fileType = $_FILES['user_file4']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    // Specify the directory where you want to save the uploaded PDF files
    $pdfUploadDirectory = 'Uploads/Suploads/UG/';

    // You may want to generate a unique filename to prevent overwriting files with the same name
    $newFileName = 'Resume_' . $rollno . '.' . $fileExtension;

    // Check file size and allowed file types
    $allowedExtensions = ['pdf'];
    $maxFileSize = 10 * 1024 * 1024; // 10MB

    if (in_array($fileExtension, $allowedExtensions) && $fileSize <= $maxFileSize) {
        $uploadPath = $pdfUploadDirectory . $newFileName;

        if (move_uploaded_file($fileTmpPath, $uploadPath)) {
            $pdfUploadPath4 = $uploadPath;
            // PDF file uploaded successfully


            // Update user data in the database
            $updateQuery = "UPDATE studentugform SET phone='$phone', email='$email', fname='$fname', mname='$mname', peradd='$peradd',  city = '$city', pincode = '$pincode', state = '$state', country = '$country',  school1='$school1', school2='$school2', tenth='$tenth', twelveth='$twelveth', ug='$ug', file_path1 =' $pdfUploadPath1', file_path2 = '$pdfUploadPath2', file_path3 = '$pdfUploadPath3', file_path4 = '$pdfUploadPath4' WHERE rollno = $rollno"; // Update this query according to your table structure and fields

            if ($conn->query($updateQuery) === TRUE) {
                $message = "Profile Successfully!";
                echo "<script type='text/javascript'>alert('$message');</script>";
                echo ("<script>window.location = 'ugprofile.php';</script>");
            } else {
                $message = "Failed to update profile!";
                echo "<script type='text/javascript'>alert('$message');</script>";
                echo ("<script>window.location = 'ugprofile.php';</script>");
            }
            // need to go down
        } else {
            // Failed to move uploaded PDF file
            $message = "PDF File upload failed!";
            echo "<script type='text/javascript'>alert('$message');</script>";
            echo ("<script>window.location = 'ugprofile.php';</script>");
        }
    } else {
        // PDF file size or type not allowed
        $message = "Invalid PDF file! Please upload a PDF of size up to 10MB.";
        echo "<script type='text/javascript'>alert('$message');</script>";
        echo ("<script>window.location = 'ugprofile.php';</script>");
    }
}

$conn->close();

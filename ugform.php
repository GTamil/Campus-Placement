<?php
session_start();

require_once 'connectdb.php';

// Get form data
$name = $_POST['name'];
$rollno = $_POST['rollno'];
$dob = $_POST['dob'];
$age = $_POST['age'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$fname = $_POST['fname'];
$mname = $_POST['mname'];
$peradd = $_POST['peradd'];
$city = $_POST['city'];
$pincode = $_POST['pincode'];
$state = $_POST['state'];
$country = $_POST['country'];
$course = $_POST['course'];
$dept = $_POST['dept'];
$school1 = $_POST['school1'];
$school2 = $_POST['school2'];
$tenth = $_POST['tenth'];
$twelveth = $_POST['twelveth'];
$ug = $_POST['ug'];

// File upload handling for image
if ($_FILES['user_photo']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['user_photo']['tmp_name'];
    $fileName = $_FILES['user_photo']['name'];
    $fileSize = $_FILES['user_photo']['size'];
    $fileType = $_FILES['user_photo']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    // Specify the directory where you want to save the uploaded image files
    $imageUploadDirectory = 'Uploads/Profile/UGStudent/';

    // You may want to generate a unique filename to prevent overwriting files with the same name
    $newFileName = 'User_' . $rollno . '.' . $fileExtension;

    // Check file size and allowed file types
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    $maxFileSize = 10 * 1024 * 1024; // 10MB

    if (in_array($fileExtension, $allowedExtensions) && $fileSize <= $maxFileSize) {
        $uploadPath = $imageUploadDirectory . $newFileName;

        if (move_uploaded_file($fileTmpPath, $uploadPath)) {
            $imageUploadPath = $uploadPath;
            // Image file uploaded successfully
            // Now proceed to handle PDF file upload
        } else {
            // Failed to move uploaded image file
            $message = "Image upload failed!";
            echo "<script type='text/javascript'>alert('$message');</script>";
            echo ("<script>window.location = 'studentugform.php';</script>");
        }
    } else {
        // Image file size or type not allowed
        $message = "Invalid image file! Please upload an image (jpg, jpeg, png, gif) of size up to 10MB.";
        echo "<script type='text/javascript'>alert('$message');</script>";
        echo ("<script>window.location = 'studentugform.php';</script>");
    }
}
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

            // Insert user data into the database
            $sql = "INSERT INTO studentugform (name, rollno, dob, age, phone, email, fname, mname, peradd, city, pincode, state, country, course, dept, school1, school2, tenth, twelveth, ug, photo_path, file_path1, file_path2, file_path3, file_path4) VALUES ('$name', '$rollno', '$dob', $age,  '$phone', '$email', '$fname', '$mname', '$peradd',   '$city', '$pincode', '$state', '$country', '$course', '$dept', '$school1', '$school2', '$tenth', '$twelveth', '$ug', '$imageUploadPath', '$pdfUploadPath1', '$pdfUploadPath2', '$pdfUploadPath3', '$pdfUploadPath4')";

            if ($conn->query($sql) === TRUE) {
                $message = "Upload successful!";
                echo "<script type='text/javascript'>alert('$message');</script>";
                echo ("<script>window.location = 'ugprofile.php';</script>");
            } else {
                $message = "Upload unsuccessful!";
                echo "<script type='text/javascript'>alert('$message');</script>";
                echo ("<script>window.location = 'studentugform.php';</script>");
            }
            // need to go down
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

$conn->close();
?>
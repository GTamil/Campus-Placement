<?php
session_start();

require_once 'connectdb.php';

@$username = $_SESSION["username"];


$sql = "SELECT * FROM recruiterform WHERE username='$username'";
$profile = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./Assets/css/style.css">
    <link rel="stylesheet" href="./Assets/css/bootstrap.min.css">
    <title>Training and Placement</title>
</head>
<style>
    /* Styles for the full-screen preview */
    .preview-container {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.9);
        z-index: 999;
        overflow: auto;
    }

    .preview-content {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
    }

    .preview-image {
        max-width: 90%;
        max-height: 90%;
        margin: auto;
    }
</style>

<body>
    <?php
    // Check if there are rows returned
    if ($profile && $profile->num_rows > 0) {
        // Data exists, display the information
        // Display your data here using a loop or fetching individual rows
        while ($row = mysqli_fetch_assoc($profile)) {
    ?>
            <!-- nav  -->
            <header>
                <nav class="navbar navbar-expand-lg border-bottom">
                    <div class="container text-center">
                        <a class="navbar-brand justify-content-start" href="index.html" onclick="return confirm('Do You Want To Logout..?')">Training and Placement</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" data-bs-trigger="focus" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link text-dark" aria-current="page" href="#">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-dark" href="#post">Post</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-dark" href="recruitermain.php">Profile</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-dark" href="index.html" onclick="return confirm('Do You Want To Logout..?')">Logout</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </header>
            <!-- nav -->

            <!-- banner -->
            <section id="banner">
                <div class="image-container">
                    <img src="<?php echo $row["photo_path2"]; ?>" class="img-fluid bg-dark w-100" alt="..." style="height: 350px; object-fit:cover;">
                    <!-- <h1 class="display-1 position-absolute top-50 start-50 translate-middle opacity-50 text-bg-dark bg-gradient w-100 text-center"><b><?php echo $row["cname"]; ?></b></h1> -->
                </div>
            </section>
            <!-- banner -->
    <?php
        }
    } else {
        // No data exists, redirect to another page
        $message = "Please fill the details";
        echo "<script type='text/javascript'>alert('$message');</script>";
        echo ("<script>window.location = 'recruiterform.php';</script>");
        exit;
    }
    ?>

    <!-- Post -->
    <section id="post">
        <div class="container mt-5">
            <div class="d-flex flex-wrap gap-2 mb-4 justify-content-center" id="data-container">
                <?php

                $username = $_SESSION['username'];

                // Retrieve job post data (assuming $conn is the connection object)
                $jobPostQuery = "SELECT * FROM recruiterpost WHERE username='$username'";
                $result = $conn->query($jobPostQuery);

                if ($result && $result->num_rows > 0) {
                    while ($postRow = $result->fetch_assoc()) {
                ?>
                        <div class="card mb-3 p-2 text-center" style="width: 350px; height:535px;">
                            <div class="card-header h-auto bg-transparent">
                                <!-- Php Code for company profile -->
                                <?php
                                @$username = $_SESSION["username"];

                                $sql = "SELECT * FROM recruiterform WHERE username='$username'";
                                $profile = $conn->query($sql);

                                if ($profile === false) {
                                    echo "Error: " . $conn->error; // Display error message
                                } else {
                                    // Check if there are rows returned
                                    if ($profile->num_rows > 0) {
                                        // Data exists, display the information
                                        while ($row = mysqli_fetch_assoc($profile)) {
                                ?>
                                            <img src="<?php echo $row["photo_path1"]; ?>" alt="" class="float-start mt-1 mx-3" style="float: left;width: 40px; height: 40px; border-radius: 40px; overflow: hidden;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#viewcompany">
                                            <p class="p-2 m-1 text-start pointer-event " data-bs-toggle="modal" data-bs-target="#viewcompany"><?php echo $row["cname"]; ?> <small><?php echo $row["city"]; ?></small></p>
                                <?php
                                        }
                                    } else {
                                        echo "No records found for this user.";
                                    }
                                }
                                ?>
                            </div>
                            <div class="card-body">
                                <img src="<?php echo $postRow["photo_path"]; ?>" class="card-img-top img-fluid " style="height:200px; object-fit:contain; object-position:center;" id="cardpreview" alt="" onclick="previewImage(this);">
                                <div class="preview-container" onclick="closePreview()">
                                    <div class="preview-content">
                                        <img src="" class="preview-image" id="fullImage" alt="Full Image Preview">
                                    </div>
                                </div>
                                <h5 class="card-title m-3">Job title</h5>
                                <p class="card-text" style="font-size: small;"><?php echo $postRow["title"]; ?></p>
                                <h5 class="card-title m-3">Job description</h5>
                                <p class="card-text" style="font-size: small;"><?php echo substr($postRow["description"], 0, 125); ?></p>
                                <!-- <p class="card-text"><small class="text-body-secondary"><a href="<?php echo $postRow["link"]; ?>" class="text-decoration-none">Apply</a></small></p> -->
                                <p class="card-text" style="font-size: small;"><small class="text-body-secondary" id="lastUpdated">Posted on: <?php echo $postRow["insert_time"]; ?></small></p>
                            </div>
                        </div>
                <?php
                    }
                } else {
                    echo "No job posts available";
                }
                ?>
            </div>
        </div>
    </section>


    <!-- libraries -->
    <script src="./Assets/js/jquery.min.js"></script>
    <script src="./Assets/js/bootstrap.min.js"></script>
    <script src="./Assets/js/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>

    <!-- script -->
    <script>
        const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
        const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl, {
            trigger: 'focus'
        }))
        // Full Image Preview
        function previewImage(img) {
            // Show the preview container
            var previewContainer = document.querySelector('.preview-container');
            previewContainer.style.display = 'block';

            // Update the preview image source with the clicked image source
            var fullImage = document.getElementById('fullImage');
            fullImage.src = img.src;
        }

        function closePreview() {
            // Hide the preview container
            var previewContainer = document.querySelector('.preview-container');
            previewContainer.style.display = 'none';
        }
    </script>
</body>

</html>
<?php
session_start();
require_once 'connectdb.php';
if (!isset($_SESSION['rollno'])) {
    header('Location: studentlogin.html');
    exit;
}
@$rollno = $_SESSION["rollno"];
$sql = "SELECT * FROM studentlogin where rollno='$rollno'";
$profile = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./Assets/css/style.css">
    <link rel="stylesheet" href="./Assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Training and Placement</title>
</head>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    $(function() {
        $("#contact").load("contactus.php");

    });
</script>
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
    while ($row = mysqli_fetch_assoc($profile)) {
    ?>
        <!-- nav  -->
        <header>
            <nav class="navbar navbar-expand-lg border-bottom shadow-lg">
                <div class="container text-center">
                    <a class="navbar-brand justify-content-start" href="index.html" onclick="return confirm('Do You Want To Logout..?')">Training and Placement</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" data-bs-trigger="focus" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link text-dark" aria-current="page" href="./studentmainpg.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-dark" href="#post">Notice</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-dark" href="./studentpgform.php">Forms</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link text-dark navbar-nav" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling"><i class="bi bi-person-circle"></i><b class="mx-2"><?php echo $row["name"]; ?></b></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-dark" href="./" onclick="return confirm('Do You Want To Logout..?')">Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <!-- nav -->

        <!-- Offcanvas Profile -->

        <div class="offcanvas offcanvas-start w-100" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasScrollingLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-header">
                <h1>Profile</h1>
            </div>
            <div class="offcanvas-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col"> </th>
                            <th scope="col"> </th>
                            <th scope="col"> </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">
                            <td>Name</td>
                            <td><?php echo $row["name"];  ?></td>
                            </th>
                        </tr>
                        <tr>
                            <th scope="row">
                            <td>Roll No</td>
                            <td><?php echo $row["rollno"];  ?></td>
                            </th>
                        </tr>
                        <tr>
                            <th scope="row">
                            <td>Course</td>
                            <td><?php echo $row["course"];  ?></td>
                            </th>
                        </tr>
                        <tr>
                            <th scope="row">
                            <td>Department</td>
                            <td><?php echo $row["dept"];  ?></td>
                            </th>
                        </tr>
                        <tr>
                            <th scope="row">
                            <td>Phone</td>
                            <td><?php echo $row["phone"];  ?></td>
                            </th>
                        </tr>
                        <tr>
                            <th scope="row">
                            <td>Email</td>
                            <td><?php echo $row["email"];  ?></td>
                            </th>
                        </tr>
                    </tbody>
                </table>
            <?php
        }
            ?>
            <a class="btn btn-secondary w-100" href="./pgprofile.php" role="button">View Full Details</a>
            </div>
        </div>

        <div class="container mt-5 mb-5">
            <div class="d-flex justify-content-center">
                <div class="btn-group" role="group" aria-label="Post Type">
                    <button type="button" class="btn btn-outline-secondary active" id="recruiterBtn">Recruiters</button>
                    <button type="button" class="btn btn-outline-secondary" id="staffBtn">Training and Placement</button>
                </div>
            </div>
        </div>


        <?php
        // Retrieve job post data along with the respective user profiles
        $jobPostQuery = "SELECT rp.*, rf.*, rp.stream AS stream FROM recruiterpost rp INNER JOIN recruiterform rf ON rp.userid = rf.userid WHERE rp.stream = 'For PG' OR rp.stream = 'Both UG and PG'";
        $result = $conn->query($jobPostQuery);
        ?>

        <!-- Post -->
        <section id="post" style="display: block;">
            <div class="container mt-5">
                <div class="d-flex flex-wrap gap-2 mb-4 justify-content-center" id="data-container">
                    <?php
                    if ($result && $result->num_rows > 0) {
                        $modalCounter = 0; // Initialize a counter for unique modal IDs
                        while ($row = $result->fetch_assoc()) {
                            $modalCounter++; // Increment the counter for each iteration
                            $modalID = "viewcompany" . $modalCounter; // Unique modal ID for each job post
                    ?>
                            <div class="card mb-3 p-2 text-center" style="width: 350px; height:475px;">
                                <div class="header">
                                    <img src="<?php echo $row["photo_path1"]; ?>" alt="" class="float-start mt-1 mx-3" style="float: left;width: 40px; height: 40px; border-radius: 40px; overflow: hidden;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#<?php echo $modalID; ?>">
                                    <p class="p-2 m-1 text-start pointer-event " data-bs-toggle="modal" data-bs-target="#<?php echo $modalID; ?>"><?php echo $row["cname"]; ?> <small><?php echo $row["city"]; ?></small></p>
                                </div>
                                <div class="card-body">
                                    <img src="<?php echo $row["photo_path"]; ?>" class="card-img-top img-fluid " style="height:200px; object-fit:contain; object-position:center;" id="cardpreview" alt="" onclick="previewImage(this);">
                                    <div class="preview-container" onclick="closePreview()">
                                        <div class="preview-content">
                                            <img src="" class="preview-image" id="fullImage" alt="Full Image Preview">
                                        </div>
                                    </div>
                                    <h5 class="card-title m-3">Job title</h5>
                                    <p class="card-text"><?php echo $row["title"]; ?></p>
                                    <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#ViewJob<?php echo $modalID; ?>">View Full Details</button>
                                    <p class="card-text mt-3"><small class="text-body-secondary" id="lastUpdated">Posted on: <?php echo $row["insert_time"]; ?></small></p>
                                </div>
                            </div>

                            <!-- Modal for company profile -->
                            <div class="modal fade" id="<?php echo $modalID; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable modal-fullscreen">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Company Profile</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="container mt-5 mb-5 rounded-2 shadow">

                                                <!-- Cover Photo -->
                                                <div class="row">
                                                    <div class="col-12">
                                                        <img src="<?php echo $row["photo_path2"]; ?>" class="img-fluid mt-3 w-100 rounded-4 " alt="" style="width: 800px; height: 250px; object-fit: cover;">
                                                    </div>
                                                </div>

                                                <!-- Profile Photo -->
                                                <div class="row p-2">
                                                    <div class="col-lg-4 col-12">
                                                        <div class="m-5">
                                                            <center><img src="<?php echo $row["photo_path1"]; ?>" class="img-fluid rounded-2 shadow mt-4" style="width: 300px; height: 300px; object-fit: cover;"></center>
                                                        </div>
                                                    </div>

                                                    <!-- Company Profile -->
                                                    <div class="col-lg-8 col-12 p-4">
                                                        <div class="row p-4">
                                                            <div class="col-lg-6 col-12">
                                                                <h4 class="mb-3"><i class="bi bi-building-fill"> Company Name</i></h4>
                                                                <h6 class="mb-5"><?php echo $row["cname"];  ?></h6>
                                                            </div>
                                                            <div class="col-lg-6 col-12">
                                                                <h4 class="mb-3"><i class="bi bi-geo-alt-fill"> Company Address </i></h4>
                                                                <address class="mb-5">
                                                                    <?php echo $row["caddress"];  ?>,
                                                                    <?php echo $row["city"];  ?> - <?php echo $row["pincode"];  ?>,
                                                                    <?php echo $row["state"];  ?>,
                                                                    <?php echo $row["country"];  ?>.</address>
                                                            </div>
                                                            <div class="col-lg-6 col-12">
                                                                <h4 class="mb-3"><i class="bi bi-envelope-fill"> Company Email</i></h4>
                                                                <h6 class="mb-5"><?php echo $row["cemail"];  ?></h6>
                                                            </div>
                                                            <div class="col-lg-6 col-12">
                                                                <h4 class="mb-3"><i class="bi bi-telephone-fill"> Company Website</i></h4>
                                                                <h6 class="mb-5"><a href="<?php echo $row["cweb"]; ?>" class="text-decoration-none text-info">View Website</a></h6>
                                                            </div>

                                                            <div class="col-lg-6 col-12">
                                                                <h4 class="mb-3"><i class="bi bi-person-fill"> HR Name</i></h4>
                                                                <h6 class="mb-5"><?php echo $row["hrname"];  ?></h6>
                                                            </div>
                                                            <div class="col-lg-6 col-12">
                                                                <h4 class="mb-3"><i class="bi bi-envelope-fill"> HR Email</i></h4>
                                                                <h6 class="mb-5"><?php echo $row["hremail"];  ?></h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Job details -->
                            <div class="modal fade" id="ViewJob<?php echo $modalID; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable modal-fullscreen">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Job Details</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="container text-start">
                                                <div class="row ">
                                                    <div class="col-md-6 d-flex justify-content-center">
                                                        <img src="<?php echo $row["photo_path"]; ?>" class="img-fluid rounded-2 shadow mt-4" id="dynamicImage" style="max-width: 100%; max-height: 70vh; object-fit: cover;">
                                                    </div>
                                                    <div class="col-md-6 align-self-center">
                                                        <h4 class="text-start mt-3">Job Title</h4>
                                                        <span><?php echo $row["title"]; ?></span>
                                                        <h4 class="text-start mt-3">Job Description</h4>
                                                        <p class="" style="text-align: justify;"><?php echo $row["description"]; ?></p>
                                                        <h4 class="text-start mt-3">Eligibility criteria</h4>
                                                        <span>Eligibility <?php echo $row["stream"]; ?></span>
                                                        <p class="mt-5"><small class="text-body-secondary" id="lastUpdated">Posted on: <?php echo $row["insert_time"]; ?></small></p>
                                                        <hr>
                                                        <!-- job form -->
                                                        <?php
                                                        // Check if the user has already applied for the job
                                                        $checkAppliedQuery = "SELECT * FROM jobapplication WHERE rollno = '$rollno' AND postid = " . $row['postid'];
                                                        $checkResult = $conn->query($checkAppliedQuery);

                                                        // If the user has already applied, do not display the form
                                                        if ($checkResult && $checkResult->num_rows > 0) {
                                                            // User has already applied, do not display the form
                                                            // Optionally, you can display a message indicating that the user has already applied
                                                            echo "<b class='text-danger'>You have already applied for this job.</b>";
                                                        } else {
                                                            // User has not applied for the job, display the form
                                                            if ($row['form'] == 'Activate') {
                                                                // Display the form design
                                                                echo '<button type="button" class="btn btn-dark mb-3" data-bs-toggle="offcanvas" data-bs-target="#Form' . $modalID . '">Fill Form</button>';
                                                            } else {
                                                                // Do not display the form
                                                                // echo "<p>Form Not Activated for $modalID</p>";
                                                            }
                                                        }
                                                        ?>
                                                        <!-- Form design on OFFCANVAS -->
                                                        <div class="offcanvas offcanvas-top h-100 " data-bs-backdrop="static" tabindex="-1" id="Form<?php echo $modalID; ?>" aria-labelledby="staticBackdropLabel">
                                                            <div class="offcanvas-header">
                                                                <h5 class="offcanvas-title" id="staticBackdropLabel">Application</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                                            </div>
                                                            <div class="offcanvas-body">
                                                                <div class="container">
                                                                    <form method="POST" class="w-100 rounded-1 m-3 p-4 border bg-white" action="jobappl.php" enctype="multipart/form-data">
                                                                        <input required name="userid" type="text" class="form-control" placeholder="" value="<?php echo $row["userid"];  ?>" hidden />
                                                                        <input required name="postid" type="text" class="form-control" placeholder="" value="<?php echo $row["postid"];  ?>" hidden />
                                                                        <span class="form-label d-block">Company name</span>
                                                                        <input required name="cname" type="text" class="form-control mb-4" placeholder="" value="<?php echo $row["cname"];  ?>" readonly />
                                                                        <span class="form-label d-block">Job Title</span>
                                                                        <input required name="title" type="text" class="form-control mb-4" placeholder="" value="<?php echo $row["title"];  ?>" readonly />
                                                                        <?php
                                                                        $sql = "SELECT * FROM studentlogin where rollno='$rollno'";
                                                                        $profile = $conn->query($sql);
                                                                        while ($row = mysqli_fetch_assoc($profile)) {
                                                                        ?>
                                                                            <span class="form-label d-block">Your name</span>
                                                                            <input required name="name" type="text" class="form-control" placeholder="Name" value="<?php echo $row["name"];  ?>" />
                                                                            <span class="form-label d-block mt-3">Roll Number</span>
                                                                            <input required name="rollno" type="text" class="form-control" placeholder="RollNumber" value="<?php echo $row["rollno"];  ?>" />
                                                                            <span class="form-label d-block mt-3">Contact</span>
                                                                            <input required name="phone" type="text" class="form-control" placeholder="Phone Number" value="<?php echo $row["phone"];  ?>" />
                                                                            <span class="form-label d-block mt-3">Email</span>
                                                                            <input required name="email" type="email" class="form-control" placeholder="Email ID" value="<?php echo $row["email"];  ?>" />
                                                                            <span class="form-label d-block mt-3">Stream</span>
                                                                            <input required name="course" type="text" class="form-control" placeholder="UG OR PG" value="<?php echo $row["course"];  ?>" />
                                                                            <span class="form-label d-block mt-3">Department</span>
                                                                            <input required name="dept" type="text" class="form-control" placeholder="MSCIT,MSCCS" value="<?php echo $row["dept"];  ?>" />
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                        <span class="form-label d-block mt-3">Semester Percentage</span>
                                                                        <input required name="per" type="text" class="form-control" placeholder="Enter the Percentage Till Concluded Semester" />
                                                                        <span class="form-label d-block mt-3">Your CV</span>
                                                                        <input required name="user_file1" type="file" class="form-control" />
                                                                        <div class="d-flex gap-3">
                                                                            <button type="submit" class="btn btn-dark w-50 mt-3 rounded-3">Submit</button>
                                                                            <button type="reset" class="btn btn-dark w-50 mt-3 rounded-3">Clear</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    } else {
                        echo "<p>No job posts available</p>";
                    }
                    ?>
                </div>
            </div>
        </section>


        <?php
        // Retrieve job post data along with the respective user profiles
        $PostQuery = "SELECT sp.*, sf.*, sp.stream AS stream FROM staffpost sp INNER JOIN staffform sf ON sp.idnum = sf.idnum WHERE sp.stream = 'For PG' OR sp.stream = 'Both UG and PG'";
        $result = $conn->query($PostQuery);
        ?>

        <!-- Staff Post -->
        <section id="staffpost" style="display: none;">
            <div class="d-flex flex-wrap gap-2 mb-4 justify-content-center" id="data-container">
                <?php
                if ($result && $result->num_rows > 0) {
                    $modalCounter = 0; // Initialize a counter for unique modal IDs
                    while ($row = $result->fetch_assoc()) {
                        $modalCounter++; // Increment the counter for each iteration
                        $modalID = "viewstaff" . $modalCounter; // Unique modal ID for each job post
                ?>
                        <div class="card mb-3 p-2 text-center" style="width: 350px; height:475px;">
                            <div class="header">
                                <img src="<?php echo $row["photo_path1"]; ?>" alt="" class="float-start mt-1 mx-3" style="float: left;width: 40px; height: 40px; border-radius: 40px; overflow: hidden;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#<?php echo $modalID; ?>">
                                <p class="p-2 m-1 text-start pointer-event " data-bs-toggle="modal" data-bs-target="#<?php echo $modalID; ?>"><?php echo $row["name"]; ?> <small><?php echo $row["role"]; ?></small></p>
                            </div>
                            <div class="card-body">
                                <img src="<?php echo $row["photo_path"]; ?>" class="card-img-top img-fluid " style="height:200px; object-fit:contain; object-position:center;" id="cardpreview2" alt="">
                                <h5 class="card-title m-3">Title</h5>
                                <p class="card-text"><?php echo $row["title"]; ?></p>
                                <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#ViewJob<?php echo $modalID; ?>">View Full Details</button>
                                <p class="card-text mt-3"><small class="text-body-secondary" id="lastUpdated">Posted on: <?php echo $row["insert_time"]; ?></small></p>
                            </div>
                        </div>

                        <!-- Modal for Staff Profile -->
                        <div class="modal fade" id="<?php echo $modalID; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-fullscreen">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Staff Profile</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container mt-5 mb-5 rounded-2 shadow">
                                            <!-- Profile Photo -->
                                            <div class="row p-2">
                                                <div class="col-lg-4 col-12">
                                                    <div class="m-5">
                                                        <center><img src="<?php echo $row["photo_path1"]; ?>" class="img-fluid rounded-2 shadow mt-4" style="width: 300px; height: 300px; object-fit: cover;"></center>
                                                    </div>
                                                </div>

                                                <!-- Staff Profile -->
                                                <div class="col-lg-8 col-12 p-4">
                                                    <div class="row p-4">
                                                        <div class="col-md-6 col-12 mb-3">
                                                            <h3>Name</h3>
                                                            <p><?php echo $row["name"]; ?></p>
                                                        </div>
                                                        <div class="col-md-6 col-12 mb-3">
                                                            <h3>ID Number</h3>
                                                            <p><?php echo $row["idnum"]; ?></p>
                                                        </div>
                                                        <div class="col-md-6 col-12 mb-3">
                                                            <h3>Aided or Self-Financed</h3>
                                                            <p><?php echo $row["staff"]; ?></p>
                                                        </div>
                                                        <div class="col-md-6 col-12 mb-3">
                                                            <h3>Teaching or Non-Teaching</h3>
                                                            <p><?php echo $row["stype"]; ?></p>
                                                        </div>
                                                        <div class="col-md-6 col-12 mb-3">
                                                            <h3>Role</h3>
                                                            <p><?php echo $row["role"]; ?></p>
                                                        </div>
                                                        <div class="col-md-6 col-12 mb-3">
                                                            <h3>Department</h3>
                                                            <p><?php echo $row["dept"]; ?></p>
                                                        </div>
                                                        <div class="col-md-6 col-12 mb-3">
                                                            <h3>Phone Number</h3>
                                                            <p><?php echo $row["phone"]; ?></p>
                                                        </div>

                                                        <div class="col-md-6 col-12 mb-3">
                                                            <h3>Email</h3>
                                                            <p><?php echo $row["email"]; ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Event details -->
                        <div class="modal fade" id="ViewJob<?php echo $modalID; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-fullscreen">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Event Details</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container text-start">
                                            <div class="row ">
                                                <div class="col-md-6 d-flex justify-content-center">
                                                    <img src="<?php echo $row["photo_path"]; ?>" class="img-fluid rounded-2 shadow mt-4" id="dynamicImage" style="max-width: 100%; max-height: 70vh; object-fit: cover;">
                                                </div>
                                                <div class="col-md-6 align-self-center">
                                                    <h4 class="text-start mt-3">Title</h4>
                                                    <span><?php echo $row["title"]; ?></span>
                                                    <h4 class="text-start mt-3">Description</h4>
                                                    <p class="" style="text-align: justify;"><?php echo $row["description"]; ?></p>
                                                    <h4 class="text-start mt-3">Eligibility criteria</h4>
                                                    <span><?php echo $row["stream"]; ?> can attend</span>
                                                    <p class="mt-5"><small class="text-body-secondary" id="lastUpdated">Posted on: <?php echo $row["insert_time"]; ?></small></p>
                                                    <hr>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                } else {
                    echo "<p>No posts available</p>";
                }
                ?>
            </div>
            </div>
        </section>



        <!-- Contactus -->
        <section id="contact">

        </section>
        <!-- Contactus -->

        <!-- libraries -->
        <script src="./Assets/js/jquery.min.js"></script>
        <script src="./Assets/js/bootstrap.min.js"></script>
        <script src="./Assets/js/popper.min.js"></script>
        <script src="./Assets/js/department.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>

        <!-- script -->
        <script>
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

            // image ratio
            window.onload = function() {
                var img = document.getElementById('dynamicImage');
                img.onload = function() {
                    if (img.naturalWidth > img.naturalHeight) {
                        img.style.width = 'auto';
                        img.style.height = '100%';
                    } else {
                        img.style.width = '100%';
                        img.style.height = 'auto';
                    }
                };
            };

            const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
            const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl, {
                trigger: 'focus'
            }))

            // JavaScript to handle changing the selected category and toggle visibility of sections
            document.getElementById('recruiterBtn').addEventListener('click', function() {
                document.getElementById('post').style.display = 'block';
                document.getElementById('staffpost').style.display = 'none';
                document.getElementById('recruiterBtn').classList.add('active');
                document.getElementById('staffBtn').classList.remove('active');
            });

            document.getElementById('staffBtn').addEventListener('click', function() {
                document.getElementById('post').style.display = 'none';
                document.getElementById('staffpost').style.display = 'block';
                document.getElementById('recruiterBtn').classList.remove('active');
                document.getElementById('staffBtn').classList.add('active');
            });
        </script>
</body>

</html>
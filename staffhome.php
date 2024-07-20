<?php
session_start();
require_once 'connectdb.php';
@$idnum = $_SESSION["idnum"];
$sql = "SELECT * FROM staffform WHERE idnum='$idnum'";
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
                                <?php
                                if ($row['role'] == 'Training and Placement Staff') {
                                    // Display the tables
                                    echo '<li class="nav-item">
                                    <a class="nav-link text-dark" href="./srtables.php">Table</a>
                                </li>';
                                } else {
                                    // Do not display the tables
                                }
                                ?>
                                <li class="nav-item">
                                    <a href="staffprofile.php" class="nav-link text-dark navbar-nav" type="button"><i class="bi bi-person-circle"></i><b class="mx-2"><?php echo $row["name"]; ?></b></a>
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
                <div class="image-container" style="height: 450px;">
                    <img src="./Img/Banner 3.jpg" class="img-fluid bg-dark w-100 h-100" style="object-fit: cover;" alt="...">
                </div>
            </section>
            <!-- banner -->

            <!-- Post -->
            <section id="post">
                <div class="container mt-5">
                    
                    <div class="d-flex flex-wrap gap-2 mb-4 justify-content-center" id="data-container">
                        <?php
                        // Retrieve job post data along with the respective user profiles
                        $jobPostQuery = "SELECT rp.*, rf.* FROM recruiterpost rp INNER JOIN recruiterform rf ON rp.userid = rf.userid";
                        $result = $conn->query($jobPostQuery);
                        ?>

                        <!-- Post -->
                        <?php
                        if ($result && $result->num_rows > 0) {
                            $modalCounter = 0; // Initialize a counter for unique modal IDs
                            $offcanvasCounter = 0;
                            while ($row = $result->fetch_assoc()) {
                                $modalCounter++; // Increment the counter for each iteration
                                $offcanvasCounter++; // Increment the counter for each iteration
                                $modalID = "viewcompany" . $modalCounter; // Unique modal ID for each job post
                                $offCanvaID = "EditProfile" . $offcanvasCounter; // Unique modal ID for each job post
                        ?>
                                <div class="card mb-3 p-2 text-center" style="width: 350px; height:475px;">
                                    <div class="header">
                                        <img src="<?php echo $row["photo_path1"]; ?>" alt="" class="float-start mt-1 mx-3" style="float: left; width: 40px; height: 40px; border-radius: 40px; overflow: hidden;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#<?php echo $modalID; ?>">
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

                                                    <div class="row">
                                                        <div class="col-md-6 d-flex justify-content-center">
                                                            <img src="<?php echo $row["photo_path"]; ?>" class="img-fluid rounded-2 shadow mt-4" id="dynamicImage" style="max-width: 100%; max-height: 70vh; object-fit: cover;">
                                                        </div>
                                                        <div class="col-md-6 align-self-center ">
                                                            <h4 class="text-start mt-3">Job Title</h4>
                                                            <span><?php echo $row["title"]; ?></span>
                                                            <h4 class="text-start mt-3">Job Description</h4>
                                                            <p class="" style="text-align: justify;"><?php echo $row["description"]; ?></p>
                                                            <h4 class="text-start mt-3">Eligibility criteria</h4>
                                                            <span>Eligibility <?php echo $row["stream"]; ?></span>
                                                            <p class="mt-5"><small class="text-body-secondary" id="lastUpdated">Posted on: <?php echo $row["insert_time"]; ?></small></p>
                                                            <hr>
                                                            <?php
                                                            $sql = "SELECT * FROM staffform WHERE idnum='$idnum'";
                                                            $profile = $conn->query($sql);
                                                            // Check if there are rows returned
                                                            if ($profile && $profile->num_rows > 0) {
                                                                // Data exists, display the information
                                                                // Display your data here using a loop or fetching individual rows
                                                                while ($detail = mysqli_fetch_assoc($profile)) {

                                                                    if ($detail['role'] == 'Training and Placement Staff') {
                                                                        // Display the Application list
                                                                        if ($row['form'] == 'Activate') {
                                                                            // Display the form design
                                                                            echo '<button type="button" class="btn btn-dark mb-3" data-bs-toggle="offcanvas" data-bs-target="#' . $offCanvaID . '">View Apllications</button>';
                                                                        } else {
                                                                            // Do not display the form
                                                                            echo "<p>No Applications</p>";
                                                                        }
                                                                    } else {
                                                                        // Do not display the form
                                                                    }
                                                                }
                                                            }
                                                            ?>
                                                            <!-- job form -->
                                                            <div class="offcanvas offcanvas-top h-100" tabindex="-1" id="<?php echo $offCanvaID; ?>" aria-labelledby="offcanvasTopLabel">
                                                                <div class="offcanvas-header">
                                                                    <h5 class="offcanvas-title" id="offcanvasTopLabel">Application Form</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                                                </div>
                                                                <div class="offcanvas-body">
                                                                    <?php
                                                                    $recruiter_id = $row['userid'];
                                                                    // Use the user ID to fetch related data from jobapplication
                                                                    $sql_jobapplication = "SELECT * FROM jobapplication WHERE userid='$recruiter_id'";
                                                                    $result_jobapplication = $conn->query($sql_jobapplication);

                                                                    $userCount = $result_jobapplication->num_rows; // Count of job applications for the user

                                                                    if ($result_jobapplication->num_rows > 0) {
                                                                    ?>
                                                                        <!-- List of Applications -->
                                                                        <section>
                                                                            <div class="container table-responsive">
                                                                                <h1 class="text-Start mb-4">Registered List</h1>
                                                                                <p class="text-Start">Total job applications: <?php echo $userCount; ?></p>
                                                                                <div class="row">
                                                                                    <div class="col-md-6">
                                                                                        <div class="mb-3">
                                                                                            <label for="filter" class="form-label">Filter by:</label>
                                                                                            <input type="text" class="form-control" id="filter" oninput="applyFilter()">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <div class="mb-3">
                                                                                            <label for="deptFilter" class="form-label">Department:</label>
                                                                                            <select class="form-select" id="deptFilter" onchange="applyFilter()">
                                                                                                <option value="">All</option>
                                                                                                <?php
                                                                                                // Fetch unique departments from the database and populate the dropdown
                                                                                                $departments = array();
                                                                                                while ($row = $result_jobapplication->fetch_assoc()) {
                                                                                                    $dept = $row["dept"];
                                                                                                    if (!in_array($dept, $departments)) {
                                                                                                        array_push($departments, $dept);
                                                                                                        echo "<option value='$dept'>$dept</option>";
                                                                                                    }
                                                                                                }
                                                                                                ?>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <table class="table table-group-divider table-hover">
                                                                                    <thead>
                                                                                        <tr class="text-center">
                                                                                            <th scope="col">Company Name</th>
                                                                                            <th scope="col">Job Title</th>
                                                                                            <th scope="col">Name</th>
                                                                                            <th scope="col">RollNo</th>
                                                                                            <th scope="col">Phone</th>
                                                                                            <th scope="col">Email</th>
                                                                                            <th scope="col">Stream</th>
                                                                                            <th scope="col">Department</th>
                                                                                            <th scope="col">Status</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        <?php
                                                                                        // Reset result pointer
                                                                                        mysqli_data_seek($result_jobapplication, 0);
                                                                                        // Display jobapplication data
                                                                                        while ($row_jobapplication = $result_jobapplication->fetch_assoc()) {
                                                                                            // Access data using $row_jobapplication['column_name']
                                                                                        ?>
                                                                                            <tr class="text-center">
                                                                                                <td><?php echo $row_jobapplication['cname']; ?></td>
                                                                                                <td><?php echo $row_jobapplication['title']; ?></td>
                                                                                                <td><?php echo $row_jobapplication['name']; ?></td>
                                                                                                <td><?php echo $row_jobapplication['rollno']; ?></td>
                                                                                                <td><?php echo $row_jobapplication['phone']; ?></td>
                                                                                                <td><?php echo $row_jobapplication['email']; ?></td>
                                                                                                <td><?php echo $row_jobapplication['course']; ?></td>
                                                                                                <td><?php echo $row_jobapplication['dept']; ?></td>
                                                                                                <td><?php echo $row_jobapplication['status']; ?></td>
                                                                                            </tr>
                                                                                        <?php
                                                                                        }
                                                                                        ?>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </section>
                                                                    <?php
                                                                    } else {
                                                                        // Do not display the form
                                                                        echo "<p>No Applicaions</p>";
                                                                    }
                                                                    ?>
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
            <!-- card -->

    <?php
        }
    } else {
        // No data exists, redirect to another page
        $message = "Please fill the details";
        echo "<script type='text/javascript'>alert('$message');</script>";
        echo ("<script>window.location = 'staffdetail.php';</script>");
        exit;
    }
    ?>



    <!-- Footer -->
    <!-- <section class="footer m-0">
        <footer class="shadow">
            <div class="text-center p-3">
                <a href="index.html" class="text-decoration-none text-black" onclick="return confirm('Do You Want To Logout..?')"><small class="text-body-secondary">Training and placement</small></a>
            </div>
        </footer>
    </section> -->

    <!-- libraries -->
    <script src="./Assets/js/jquery.min.js"></script>
    <script src="./Assets/js/bootstrap.min.js"></script>
    <script src="./Assets/js/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>

    <!-- script -->
    <script>
        // Filter
        function applyFilter() {
            const nameFilter = document.getElementById('filter').value.toLowerCase();
            const deptFilter = document.getElementById('deptFilter').value.toLowerCase();
            const rows = document.querySelectorAll('.table tbody tr');
            rows.forEach(row => {
                const name = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
                const dept = row.querySelector('td:nth-child(8)').textContent.toLowerCase();
                if ((name.includes(nameFilter) || nameFilter === '') && (dept.includes(deptFilter) || deptFilter === '')) {
                    row.style.display = 'table-row';
                } else {
                    row.style.display = 'none';
                }
            });
        }

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
    </script>
</body>

</html>
<?php
session_start();

require_once 'connectdb.php';
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Assets/css/style.css">
    <link rel="stylesheet" href="./Assets/css/bootstrap.min.css">
    <title>Recruiter Table</title>
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
    <div id="header">
        <?php include 'header.html'; ?>
    </div>
    <?php
    $sql = "SELECT * FROM recruiterform rf JOIN recruiterlogin rl ON rf.userid = rl.userid";
    $recruiterprofile = $conn->query($sql);
    $userCount = $recruiterprofile->num_rows; // Count of job applications for the user
    // Check if there are rows returned
    if ($recruiterprofile && $recruiterprofile->num_rows > 0) {
        // Data exists, display the information
    ?>
        <div class="container mt-5">

            <div class="d-flex justify-content-md-start justify-content-center flex-wrap gap-2 mb-4" id="data-container">
                <?php
                // Display your data here using a loop or fetching individual rows
                $rowCounter = 0;
                $modalCounter = 0;
                $offcanvasCounter = 0;
                $fullimageview = 0;
                while ($row = mysqli_fetch_assoc($recruiterprofile)) {
                    // Display data from $row
                    // Example: echo $row['column_name'];
                    $rowCounter++;
                    $modalCounter++; // Increment the counter for each iteration
                    $offcanvasCounter++; // Increment the counter for each iteration
                    $fullimageview++; // Increment the counter for each iteration
                    $modalID = "ViewDetails" . $modalCounter; // Unique modal ID for each job post
                    $offCanvaID = "EditProfile" . $offcanvasCounter; // Unique modal ID for each job post
                    $fullimageID = "ViewFullImage" . $fullimageview; // Unique ID for each image
                ?>

                    <div class="card mt-3 justify-content-center" style="width: 180px; height: 200px;">
                        <div class="card-body text-center">
                            <center><img src="<?php echo "../" . $row["photo_path1"]; ?>" class="card-img-top mb-2" alt="" style="border-radius: 50%;  height:100px; width:100px; object-fit: cover;"></center>
                            <h5 class="card-title mb-2"><?php echo $row["cname"];  ?></h5>
                            <!-- <p class="card-dept mb-2" style="font-size: small;"><?php echo $row["dept"]; ?></p> Added department information -->
                            <a href="0" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#<?php echo $modalID; ?>">View Full Details</a>

                        </div>
                    </div>



                    <!-- Modal -->
                    <div class="modal fade" id="<?php echo $modalID; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-fullscreen">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel"><?php echo $row["cname"];  ?></h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <!-- Profile -->
                                <div class="modal-body">
                                    <div class="container">
                                        <!-- Cover Photo -->
                                        <div class="row">
                                            <div class="col-12">
                                                <img src="<?php echo  "../" .  $row["photo_path2"]; ?>" class="img-fluid mt-3 w-100 rounded-4 " alt="" style="width: 800px; height: 250px; object-fit: cover;" alt="NO IMAGE">
                                            </div>
                                        </div>
                                        <div class="row p-2">
                                            <div class="col-lg-4 col-12">
                                                <div class="m-5">
                                                    <center><img src="<?php echo  "../" .  $row["photo_path1"]; ?>" class="img-fluid rounded-4 shadow mt-4" style="width: 300px; height: 350px; object-fit: cover;" alt="NO IMAGE"></center>
                                                </div>
                                            </div>
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
                                                        <h4 class="mb-3"><i class="bi bi-browser-chrome"> Company WebSite</i></h4>
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
                                                    <div class="col-lg-6 col-12">
                                                        <h4 class="mb-3"><i class="bi bi-user-fill"> Username</i></h4>
                                                        <h6 class="mb-5"><?php echo $row["username"];  ?></h6>
                                                    </div>
                                                    <div class="col-lg-6 col-12">
                                                        <h4 class="mb-3"><i class="bi bi-lock-fill"> Password</i></h4>
                                                        <h6 class="mb-5"><?php echo $row["password"];  ?></h6>
                                                    </div>

                                                    <div class="d-flex gap-2 align-items-start justify-content-end mt-3">
                                                        <a type="button" class="btn btn-info" data-bs-toggle="offcanvas" data-bs-target="#<?php echo $offCanvaID; ?>" aria-controls="offcanvasTop">Edit Profile</a>
                                                        <form method="POST" action="./Manageuser/deleterecruiter.php">
                                                            <input type="hidden" name="userid" value="<?php echo $row['userid']; ?>">
                                                            <button type="submit" class="btn btn-danger" name="delete_user" onclick="return confirm('Are You Sure Do You Want To Delete This User?')">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Posts -->
                                    <div class="container mt-5">
                                        <div class="d-flex flex-wrap gap-2 mb-4 justify-content-center" id="data-container">
                                            <?php
                                            // Fetch job posts for this recruiter
                                            $recruiter_id = $row['userid'];
                                            $posts_sql = "SELECT * FROM recruiterpost WHERE userid = $recruiter_id";
                                            $posts_result = $conn->query($posts_sql);
                                            if ($posts_result && $posts_result->num_rows > 0) {
                                                while ($post_row = $posts_result->fetch_assoc()) {
                                            ?>
                                                    <div class="card mb-3 p-2 text-start" style="width: 350px;">
                                                        <div class="card-header h-auto bg-transparent">
                                                            <img src="<?php echo  "../" .  $row["photo_path1"]; ?>" alt="" class="float-start mt-1 mx-3" style="float:left; width: 40px; height: 40px; border-radius: 40px; overflow: hidden;" class="btn btn-primary">
                                                            <p class="p-2 m-1 text-start pointer-event "><?php echo $row["cname"]; ?> <small><?php echo $row["city"]; ?></small></p>
                                                        </div>
                                                        <div class="card-body text-center">
                                                            <img src="<?php echo "../" . $post_row["photo_path"]; ?>" class="card-img-top img-fluid" style="height:200px; object-fit:contain; object-position:center;" alt="" onclick="previewImage('<?php echo "../" . $post_row["photo_path"]; ?>', '<?php echo $fullimageID; ?>');">
                                                            <div class="preview-container" id="<?php echo $fullimageID; ?>" onclick="closePreview(this)">
                                                                <div class="preview-content">
                                                                    <img src="" class="preview-image" id="fullImage" alt="Full Image Preview">
                                                                </div>
                                                            </div>
                                                            <h5 class="card-title m-3">Stream</h5>
                                                            <p class="card-text"><?php echo $post_row["stream"]; ?></p>
                                                            <h5 class="card-title m-3">Job title</h5>
                                                            <p class="card-text"><?php echo $post_row["title"]; ?></p>
                                                            <h5 class="card-title m-3">Job description</h5>
                                                            <p class="card-text"><?php echo substr($post_row["description"], 0, 150); ?></p>
                                                        </div>
                                                        <div class="card-footer bg-transparent justify-content-center">
                                                            <p class="card-text text-center"><small class="text-muted">Posted on: <?php echo $post_row["insert_time"]; ?></small></p>
                                                            <!-- Delete button -->
                                                            <form method="POST" action="../Recruitermanage/delete_post.php">
                                                                <input type="hidden" name="postid" value="<?php echo $post_row['postid']; ?>">
                                                                <button type="submit" class="btn btn-danger w-100" name="delete_post" onclick="return confirm('Are You Sure Do You Want To Delete This Post?')">Delete</button>
                                                            </form>
                                                        </div>
                                                    </div>

                                            <?php
                                                }
                                            } else {
                                                echo "<p>No job posts available.</p>";
                                            }
                                            ?>
                                        </div>


                                        <!-- Job Applicatiion -->
                                        <?php
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
                                                    <table class="table table-group-divider table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Job Title</th>
                                                                <th scope="col">Name</th>
                                                                <th scope="col">RollNo</th>
                                                                <th scope="col">Phone</th>
                                                                <th scope="col">Email</th>
                                                                <th scope="col">Strean</th>
                                                                <th scope="col">Department</th>
                                                                <th scope="col">Percentage</th>
                                                                <th scope="col">Status</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            // Display jobapplication data
                                                            while ($row_jobapplication = $result_jobapplication->fetch_assoc()) {
                                                                // Access data using $row_jobapplication['column_name']
                                                            ?>
                                                                <tr>
                                                                    <th scope="row"><?php echo $row_jobapplication['title']; ?></th>
                                                                    <td><?php echo $row_jobapplication['name']; ?></td>
                                                                    <td><?php echo $row_jobapplication['rollno']; ?></td>
                                                                    <td><?php echo $row_jobapplication['phone']; ?></td>
                                                                    <td><?php echo $row_jobapplication['email']; ?></td>
                                                                    <td><?php echo $row_jobapplication['course']; ?></td>
                                                                    <td><?php echo $row_jobapplication['dept']; ?></td>
                                                                    <td><?php echo $row_jobapplication['per']; ?></td>
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
                                            echo "<center>No job applications.</center>";
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>

                        <div class="offcanvas offcanvas-top h-100" tabindex="-1" id="<?php echo $offCanvaID; ?>" aria-labelledby="offcanvasTopLabel">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="offcanvasTopLabel">Edit Profile</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                <form method="post" action="../Recruitermanage/editprofile.php" class="p-5" enctype="multipart/form-data">
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" name="cname" id="floatingInput" placeholder="Company Name" value="<?php echo $row["cname"]; ?>" required>
                                            <label for="floatingInput">Company Name*</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input type="email" class="form-control" name="cemail" id="floatingInput" placeholder="Company Email Address" value="<?php echo $row["cemail"]; ?>" required>
                                            <label for="floatingInput">Company Email Address *</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" name="cweb" id="floatingInput" placeholder="1234567890" value="<?php echo $row["cweb"]; ?>" required>
                                            <label for="floatingInput">Company Website *</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" placeholder="Address" id="floatingInput" name="caddress" value="<?php echo $row["caddress"]; ?>" required>
                                            <label for="floatingInput">Company Address *</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" name="city" id="floatingInput" placeholder="City" value="<?php echo $row["city"]; ?>" required>
                                            <label for="floatingInput">City *</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" name="pincode" id="floatingInput" placeholder="Pin Code" value="<?php echo $row["pincode"]; ?>" required>
                                            <label for="floatingInput">Pin Code *</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" name="state" id="floatingInput" placeholder="State" value="<?php echo $row["state"]; ?>" required>
                                            <label for="floatingInput">State *</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" name="country" id="floatingInput" placeholder="Country" value="<?php echo $row["country"]; ?>" required>
                                            <label for="floatingInput">Country *</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" name="hrname" id="floatingInput" placeholder="HR Name" value="<?php echo $row["hrname"]; ?>" required>
                                            <label for="floatingInput">HR Name*</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input type="email" class="form-control" name="hremail" id="floatingInput" placeholder="HR Email Address" value="<?php echo $row["hremail"]; ?>" required>
                                            <label for="floatingInput">HR Email Address*</label>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" name="hrphone" id="floatingInput" placeholder="HR Phone Number" value="<?php echo $row["hrphone"]; ?>" required>
                                            <label for="floatingInput">HR Phone Number*</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <button type="submit" class="btn btn-secondary col-12 mt-3" id="submitButton">Submit</button>
                                        </div>
                                        <div class="col-6">
                                            <button type="reset" class="btn btn-secondary col-12 mt-3">Clear</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
            <?php
                }
            } else {
                // No data exists, redirect to another page
                echo "No data exists";
            }
            ?>
            </div>
        </div>



</body>
<script src="./Assets/js/jquery.min.js"></script>
<script src="./Assets/js/bootstrap.min.js"></script>
<script src="./Assets/js/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
<!-- script -->
<script>
    // imagefullview
    function previewImage(imgSrc, containerID) {
        // Show the preview container corresponding to the clicked image
        var previewContainer = document.getElementById(containerID);
        previewContainer.style.display = 'block';

        // Update the preview image source with the clicked image source
        var fullImage = previewContainer.querySelector('.preview-image');
        fullImage.src = imgSrc;
    }

    function closePreview(container) {
        // Hide the clicked preview container
        container.style.display = 'none';
    }

    // image preview
    function previewImage1(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('imagePreview1');
            var textPlaceholder = document.getElementById('textPlaceholder');

            output.src = reader.result;
            output.style.display = 'block'; // Display the image
            textPlaceholder1.style.display = 'none'; // Hide the placeholder text
        };
        reader.readAsDataURL(event.target.files[0]);
    }


    // age
    document.getElementById('dobInput').addEventListener('change', function() {
        var dob = new Date(this.value);
        var today = new Date();
        var age = today.getFullYear() - dob.getFullYear();
        var monthDiff = today.getMonth() - dob.getMonth();

        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < dob.getDate())) {
            age--;
        }

        document.getElementById('ageInput').value = age;
    });


    const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
    const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl, {
        trigger: 'focus'
    }))
</script>

</html>
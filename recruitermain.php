<?php
session_start();
require_once 'connectdb.php';
@$username = $_SESSION["username"];
$sql = "SELECT * FROM recruiterform WHERE username='$username'";
$profile = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./Assets/css/style.css">
    <link rel="stylesheet" href="./Assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <title>Training and Placement</title>
</head>
<style>
    .hidden {
        display: none;
    }

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
    <!-- nav  -->
    <header>
        <nav class="navbar navbar-expand-lg border-bottom shadow">
            <div class="container text-center">
                <a class="navbar-brand justify-content-start" href="index.html" onclick="return confirm('Do You Want To Logout..?')">Training and Placement</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" data-bs-trigger="focus" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link text-dark" aria-current="page" href="recruiterhome.php">Home</a>
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

    <?php
    // Check if there are rows returned
    if ($profile && $profile->num_rows > 0) {
        // Data exists, display the information
        // Display your data here using a loop or fetching individual rows
        while ($row = mysqli_fetch_assoc($profile)) {
    ?>

            <section id="profile">
                <div class="container mt-5 mb-5 rounded-4 shadow">
                    <!-- Cover Photo -->
                    <div class="row">
                        <div class="col-12">
                            <img src="<?php echo $row["photo_path2"]; ?>" class="img-fluid mt-3 w-100 rounded-4 " alt="" style="width: 800px; height: 250px; object-fit: cover;" data-bs-toggle="modal" data-bs-target="#Profile2">
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="Profile2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Change Cover Photo</h1>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="updatecover.php" class="p-5" enctype="multipart/form-data">
                                            <img src="<?php echo $row["photo_path2"]; ?>" id="coverimagePreview" class="img-fluid" style="width: 800px; height: 250px; object-fit: cover;" alt="...">
                                            <div class="input-group mb-3 mt-3">
                                                <input type="file" class="form-control" id="uploadInput" name="user_photo2" accept="image/*" onchange="previewCoverImage(event)">
                                            </div>
                                            <div id="HelpBlock" class="form-text mb-3 text-end">
                                                *Photo Size Max 10MB
                                            </div>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-secondary col-12 mt-3">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                    </div>

                    <!-- Profile Photo -->
                    <div class="row p-2">
                        <div class="col-lg-4 col-12">
                            <div class="m-5">
                                <center><img src="<?php echo $row["photo_path1"]; ?>" class="img-fluid rounded-4 shadow mt-4" style="width: 300px; height: 350px; object-fit: cover;" alt="..." data-bs-toggle="modal" data-bs-target="#Profile1"></center>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="Profile1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Change Profile Photo</h1>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="updateprofile.php" class="p-5" enctype="multipart/form-data">
                                                <div class="row">
                                                    <div class="col-md-6 col-12">
                                                        <center><img src="<?php echo $row["photo_path1"]; ?>" id="imagePreview" class="img-fluid" style="width: 300px; height:350px; object-fit: cover;" alt="..."></center>
                                                    </div>
                                                    <div class="col-md-6 col-12 align-self-center">
                                                        <div class="input-group mt-3 mb-3">
                                                            <input type="file" class="form-control" id="uploadInput" name="user_photo1" accept="image/*" onchange="previewImage(event)">
                                                        </div>
                                                        <div id="HelpBlock" class="form-text mb-3 text-end">
                                                            *Photo Size Max 10MB
                                                        </div>
                                                        <div class="col-12">
                                                            <button type="submit" class="btn btn-secondary col-12 mt-3">Submit</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
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

                                <!-- Edit Profile -->
                                <div class="col-lg-6 col-12">
                                    <button type="button" class="btn btn-secondary w-100 mb-3 " data-bs-toggle="modal" data-bs-target="#EditProfile">Edit Profile</button>
                                </div>
                                <!-- Create Post -->
                                <div class="col-lg-6 col-12">
                                    <button type="button" class="btn btn-secondary w-100 mb-3 " data-bs-toggle="modal" data-bs-target="#CreatePost">Create Post</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Modal for edit profile -->
            <div class="modal fade" id="EditProfile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Profile</h1>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="./Recruitermanage/editprofile.php" class="p-5" enctype="multipart/form-data">
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
                        <div class="modal-footer">
                            <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Modal for Create Post -->
            <div class="modal fade" id="CreatePost" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable modal-fullscreen">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Create Post</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="recruiterpost.php" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="userid" id="exampleFormControlInput1" value="<?php echo $row["userid"]; ?>" placeholder="" hidden>
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="username" id="exampleFormControlInput1" value="<?php echo $row["username"]; ?>" placeholder="" hidden>
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="cname" id="exampleFormControlInput1" value="<?php echo $row["cname"]; ?>" placeholder="" hidden>
                                </div>
                                <div class="mb-3 d-grid align-items-center bg-secondary-subtle border rounded w-100" style="height: 400px;">
                                    <h5 class="text-center" id="textPlaceholder2" style="display: block;">Upload Post</h5>
                                    <img src="" id="imagePreview2" class="img-fluid mb-3 w-100 rounded" style="height: 400px; object-fit: contain; display: none;" alt="">
                                </div>
                                <div class="input-group mb-3">
                                    <input type="file" class="form-control" name="user_photo" accept="image/*" onchange="previewImage2(event)">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Stream</label>
                                    <select class="form-select" aria-label="Default select example" name="stream" required>
                                        <option selected>Open this select menu</option>
                                        <option value="For UG">For UG</option>
                                        <option value="For PG">For PG</option>
                                        <option value="Both UG and PG">Both UG and PG</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Year of Passing</label>
                                    <input type="text" class="form-control" name="yop" id="exampleFormControlInput1" placeholder="" required>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Job title</label>
                                    <input type="text" class="form-control" name="title" id="exampleFormControlInput1" placeholder="" required>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Job description</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="5"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Form Activate</label>
                                    <select class="form-select" aria-label="Default select example" name="form" id="formSelect" required>
                                        <option selected>Open this select menu</option>
                                        <option value="Activate">Activate Form</option>
                                        <option value="De-Activate">De-Activate form</option>
                                    </select>
                                </div>
                                <div class="mb-3 p-4">
                                    <button type="submit" class="btn btn-dark w-100">Submit</button>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Closing For Profile -->
    <?php
        }
    }
    ?>


    <!-- Post -->
    <section id="post">
        <div class="container mt-5">
            <div class="d-flex flex-wrap gap-2 mb-4 justify-content-center" id="data-container">
                <?php
                @$username = $_SESSION["username"];
                // Retrieve job post data (assuming $conn is the connection object)
                $jobPostQuery = "SELECT * FROM recruiterpost WHERE username='$username'";
                $result = $conn->query($jobPostQuery);

                if ($result && $result->num_rows > 0) {
                    while ($postRow = $result->fetch_assoc()) {
                ?>
                        <div class="card mb-3 p-2 text-start" style="width: 350px;">
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

                            <div class="card-body text-center">
                                <img src="<?php echo $postRow["photo_path"]; ?>" class="card-img-top img-fluid mb-3" style="height:200px; object-fit:contain; object-position:center;" id="cardpreview" alt="" onclick="previewPostImage(this);">
                                <div class="preview-container" onclick="closePreview()">
                                    <div class="preview-content">
                                        <img src="" class="preview-image" id="fullImage" alt="Full Image Preview">
                                    </div>
                                </div>
                                <h5 class="card-title">Job Title</h5>
                                <p class="card-text"><?php echo $postRow["title"]; ?></p>
                                <h5 class="card-title">Job Description</h5>
                                <p class="card-text description"><?php echo substr($postRow["description"], 0, 150); ?>...</p>
                            </div>
                            <div class="card-footer bg-transparent">
                                <p class="card-text text-center"><small class="text-muted">Posted on: <?php echo $postRow["insert_time"]; ?></small></p>
                                <div class="btn-group d-grid gap-2 d-md-flex justify-content-md-end" role="group">
                                    <button type="button" class="btn btn-info rounded-2" data-bs-toggle="offcanvas" data-bs-target="#EditPost">Edit</button>
                                    <form action="./Recruitermanage/delete_post.php" method="post" onsubmit="return confirm('Are You Sure Do You Want To Delete This Post?');">
                                        <input type="hidden" name="postid" value="<?php echo $postRow['postid']; ?>">
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>



                        <!-- offcanvas -->
                        <div class="offcanvas offcanvas-top h-100" tabindex="-1" id="EditPost" aria-labelledby="offcanvasTopLabel">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="offcanvasTopLabel">Edit Post</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                <form method="post" action="edit_post.php" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <input type="text" class="form-control" name="userid" id="exampleFormControlInput1" value="<?php echo $postRow["userid"]; ?>" placeholder="" hidden>
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" class="form-control" name="postid" id="exampleFormControlInput1" value="<?php echo $postRow["postid"]; ?>" placeholder="" hidden>
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" class="form-control" name="username" id="exampleFormControlInput1" value="<?php echo $postRow["username"]; ?>" placeholder="" hidden>
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" class="form-control" name="cname" id="exampleFormControlInput1" value="<?php echo $postRow["cname"]; ?>" placeholder="" hidden>
                                    </div>
                                    <div class="mb-3 d-grid align-items-center bg-secondary-subtle border rounded w-100" style="height: 400px;">
                                        <img src="<?php echo $postRow["photo_path"]; ?>" id="imagePreview3" class="img-fluid mb-3 w-100 rounded" style="height: 400px; object-fit: contain;" alt="">
                                    </div>
                                    <div class="input-group mb-3">
                                        <input type="file" class="form-control" name="user_photo" accept="image/*" onchange="previewImage3(event)">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Stream</label>
                                        <select class="form-select" aria-label="Default select example" name="stream">
                                            <option value="<?php echo $postRow["stream"]; ?>" selected><?php echo $postRow["stream"]; ?></option>
                                            <option value="For UG">For UG</option>
                                            <option value="For PG">For PG</option>
                                            <option value="Both UG and PG">Both UG and PG</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Year of Passing</label>
                                        <input type="text" class="form-control" name="yop" value="<?php echo $postRow["yop"]; ?>" id="exampleFormControlInput1" placeholder="">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Job title</label>
                                        <input type="text" class="form-control" name="title" id="exampleFormControlInput1" value="<?php echo $postRow["title"]; ?>" placeholder="">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">Job description</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="5"><?php echo $postRow["description"]; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Form Activate</label>
                                        <select class="form-select" aria-label="Default select example" name="form" id="formSelect">
                                            <option value="<?php echo $postRow["form"]; ?>"><?php echo $postRow["form"]; ?></option>
                                            <option value="Activate">Activate Form</option>
                                            <option value="De-Activate">De-Activate form</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 p-4">
                                        <button type="submit" class="btn btn-dark w-100">Submit</button>
                                    </div>
                                </form>
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

    <?php
    // Fetch data from recruiterform based on the username
    $sql_recruiterform = "SELECT * FROM recruiterform WHERE username='$username'";
    $result_recruiterform = $conn->query($sql_recruiterform);

    if ($result_recruiterform->num_rows > 0) {
        // Fetch the user's data from recruiterform
        $row_recruiterform = $result_recruiterform->fetch_assoc();
        $userid = $row_recruiterform['userid'];

        // Use the user ID to fetch related data from jobapplication
        $sql_jobapplication = "SELECT * FROM jobapplication WHERE userid='$userid'";
        $result_jobapplication = $conn->query($sql_jobapplication);

        $userCount = $result_jobapplication->num_rows; // Count of job applications for the user

        if ($userCount > 0) {
    ?>
            <!-- List of Applications -->
            <section>
                <div class="container table-responsive">
                    <h1 class="text-Start mb-4">Registered List</h1>
                    <p>Total job applications: <?php echo $userCount; ?></p>
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
                                    // Reset result pointer after fetching unique departments
                                    $result_jobapplication->data_seek(0);
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <table class="table table-group-divider table-hover">
                        <thead>
                            <tr class="text-center">
                                <th scope="col">Job Title</th>
                                <th scope="col">Name</th>
                                <th scope="col">RollNo</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Email</th>
                                <th scope="col">Stream</th>
                                <th scope="col">Department</th>
                                <th scope="col">Percentage</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th> <!-- Added Action column -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $statusupdate = 0;
                            $statusselect = 0;
                            // Display jobapplication data
                            while ($row_jobapplication = $result_jobapplication->fetch_assoc()) {
                                $statusupdate++;
                                $statusselect++;
                                $statusupdateID = "Statusupdate" . $statusupdate; // Unique modal ID for each job post
                                $statusselectID = "Statusselect" . $statusselect; // Unique modal ID for each job post
                                // Access data using $row_jobapplication['column_name']

                            ?>
                                <tr class="text-center">
                                    <td><?php echo $row_jobapplication['title']; ?></td>
                                    <td><?php echo $row_jobapplication['name']; ?></td>
                                    <td><?php echo $row_jobapplication['rollno']; ?></td>
                                    <td><?php echo $row_jobapplication['phone']; ?></td>
                                    <td><?php echo $row_jobapplication['email']; ?></td>
                                    <td><?php echo $row_jobapplication['course']; ?></td>
                                    <td><?php echo $row_jobapplication['dept']; ?></td>
                                    <td><?php echo $row_jobapplication['per']; ?></td>
                                    <td><?php echo $row_jobapplication['status']; ?></td> <!-- Display current status -->
                                    <td>
                                        <form id="<?php echo $statusupdateID; ?>" action="updateapplication.php" method="post">
                                            <input type="hidden" name="postid" class="form-control" value="<?php echo $row_jobapplication['postid']; ?>">
                                            <input type="hidden" name="rollno" class="form-control" value="<?php echo $row_jobapplication['rollno']; ?>">
                                            <select id="<?php echo $statusselectID; ?>" name="status" class="form-control">
                                                <option value="">Action</option>
                                                <option value="Attended">Attended</option>
                                                <option value="Selected">Selected</option>
                                                <option value="Rejected">Rejected</option>
                                                <option value="Waiting List">Waiting List</option>
                                            </select>
                                        </form>
                                    </td>
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
    } else {
        echo "User not found in the recruiterform table.";
    }
    ?>

    <!-- Footer -->
    <section class="footer m-0 mt-5">
        <footer class="shadow">
            <div class="text-center p-3">
                <a href="index.html" class="text-decoration-none text-dark" onclick="return confirm('Do You Want To Logout..?')">Training and placement</a>
            </div>
        </footer>
    </section>

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
                const name = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                const dept = row.querySelector('td:nth-child(7)').textContent.toLowerCase();
                if ((name.includes(nameFilter) || nameFilter === '') && (dept.includes(deptFilter) || deptFilter === '')) {
                    row.style.display = 'table-row';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        // Update 
        document.getElementById('<?php echo $statusselectID; ?>').addEventListener('change', function() {
            document.getElementById('<?php echo $statusupdateID; ?>').submit();
        });

        // image preview
        function previewCoverImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('coverimagePreview');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }

        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('imagePreview');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }

        function previewImage2(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('imagePreview2');
                var textPlaceholder = document.getElementById('textPlaceholder2');

                output.src = reader.result;
                output.style.display = 'block'; // Display the image
                textPlaceholder2.style.display = 'none'; // Hide the placeholder text
            };
            reader.readAsDataURL(event.target.files[0]);
        }

        function previewImage3(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('imagePreview3');
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }

        // Full Image Preview
        function previewPostImage(img) {
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

        const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
        const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl, {
            trigger: 'focus'
        }))

        // form design
        document.getElementById('formSelect').addEventListener('change', function() {
            var formContainer = document.getElementById('formContainer');
            if (this.value === 'Activate') {
                formContainer.classList.remove('hidden');
            } else {
                formContainer.classList.add('hidden');
            }
        });
    </script>
</body>

</html>
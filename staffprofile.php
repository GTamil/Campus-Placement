<?php
session_start();
require_once 'connectdb.php';
@$idnum = $_SESSION["idnum"];
$sql = "SELECT * FROM staffform WHERE idnum='$idnum'";
$profile = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

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
                <nav class="navbar navbar-expand-lg border-bottom border-bottom">
                    <div class="container text-center">
                        <a class="navbar-brand justify-content-start" href="index.html" onclick="return confirm('Do You Want To Logout..?')">Training and Placement</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" data-bs-trigger="focus" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link text-dark" aria-current="page" href="./staffhome.php">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-dark" href="./staffhome.php">Post</a>
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
                                    <a class="nav-link text-dark navbar-nav" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling"><i class="bi bi-person-circle" href="staffprofile.php"></i><b class="mx-2"><?php echo $row["name"]; ?></b></a>
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


            <section id="staffprofile">
                <div class="container py-5 h-100 ">
                    <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                        <div class="card-body p-4 p-md-5">
                            <div class="row">
                                <div class="col-lg-4 col-12 mb-5 align-self-center d-flex justify-content-center">
                                    <img src="<?php echo $row["photo_path1"]; ?>" class="card-img-top mb-2" alt="" style="border-radius: 50%;  height:300px; width:300px; object-fit: cover;" data-bs-toggle="modal" data-bs-target="#Profile1">
                                </div>
                                <!-- Profile Change -->
                                <!-- Modal -->
                                <div class="modal fade" id="Profile1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Change Profile Photo</h1>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" action="updatestaffphoto.php" class="p-5" enctype="multipart/form-data">
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

                                <!-- Details -->
                                <div class="col-lg-8 col-12">
                                    <div class="row">
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
                                        <div class="col-md-6 col-12 mb-3">

                                        </div>
                                        <div class="col-md-6 col-12 mb-3">
                                            <div class="d-flex gap-4">
                                                <a type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#editstaff">Edit Profile</a>
                                                <?php
                                                if ($row['role'] == 'Training and Placement Staff') {
                                                    // Display the tables
                                                    echo '<a type="button" class="btn btn-secondary" data-bs-toggle="offcanvas" data-bs-target="#createpost">Create Post</a>';
                                                } else {
                                                    // Do not display the tables
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal -->
                                    <div class="modal fade" id="editstaff" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-fullscreen">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Profile</h1>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="container py-5 h-100 ">
                                                        <div class="row justify-content-center align-items-center h-100">
                                                            <div class="col-12">
                                                                <div class="card shadow-2-strong card-registration mb-5" style="border-radius: 15px;">
                                                                    <div class="card-body p-4 p-md-5">
                                                                        <form method="post" action="editstaffprofile.php" enctype="multipart/form-data" class="">
                                                                            <div class="row">
                                                                                <div class="col-12">
                                                                                    <div class="form-floating mb-3">
                                                                                        <input type="text" class="form-control" name="name" id="floatingInput" placeholder="Name" value="<?php echo $row["name"]; ?>">
                                                                                        <label for="floatingInput">Name*</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-12">
                                                                                    <div class="form-floating mb-3">
                                                                                        <input type="text" class="form-control" name="idnum" id="floatingInput" placeholder="Name" value="<?php echo $row["idnum"]; ?>" readonly>
                                                                                        <label for="floatingInput">ID Number*</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-12">
                                                                                    <div class="form-floating mb-3">
                                                                                        <input type="email" class="form-control" name="email" id="floatingInput" placeholder="Email Address" value="<?php echo $row["email"]; ?>" required>
                                                                                        <label for="floatingInput">Email Address *</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-12">
                                                                                    <div class="form-floating mb-3">
                                                                                        <input type="text" class="form-control" name="phone" id="floatingInput" placeholder="Phone Number" value="<?php echo $row["phone"]; ?>" required>
                                                                                        <label for="floatingInput">Phone Number *</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-12">
                                                                                    <div class="form-floating mb-3">
                                                                                        <input type="date" class="form-control" name="dob" id="dob" placeholder="Date of Birth" value="<?php echo $row["dob"]; ?>" disabled>
                                                                                        <label for="floatingInput">Date of Birth*</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-12">
                                                                                    <div class="form-floating mb-3">
                                                                                        <input type="number" class="form-control" name="age" id="ageInput" placeholder="Age" value="<?php echo $row["age"]; ?>">
                                                                                        <label for="floatingInput">Age*</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-12">
                                                                                    <div class="form-floating mb-3">
                                                                                        <select class="form-control" name="stype" id="" disabled>
                                                                                            <option class="" value="<?php echo $row["stype"]; ?>" selected><?php echo $row["stype"]; ?></option>
                                                                                        </select>
                                                                                        <label for="floatingInput">Teaching or Non-Teaching</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-12">
                                                                                    <div class="form-floating mb-3">
                                                                                        <select class="form-control" name="role" id="" disabled>
                                                                                            <option class="" value="<?php echo $row["role"]; ?>" selected><?php echo $row["role"]; ?></option>
                                                                                        </select>
                                                                                        <label for="floatingInput">Role</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-12">
                                                                                    <div class="form-floating mb-3">
                                                                                        <select class="form-control" name="staff" id="" disabled>
                                                                                            <option class="" value="<?php echo $row["staff"]; ?>" selected><?php echo $row["staff"]; ?> </option>
                                                                                        </select>
                                                                                        <label for="floatingInput">Aided / SF</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-12">
                                                                                    <div class="form-floating mb-3">
                                                                                        <select class="form-control" name="dept" id="" disabled>
                                                                                            <option class="" value="<?php echo $row["dept"]; ?>" selected><?php echo $row["dept"]; ?> </option>
                                                                                        </select>
                                                                                        <label for="floatingInput">Department</label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-6">
                                                                                    <button type="submit" class="btn btn-dark col-12 mt-3" id="submitButton">Submit</button>
                                                                                </div>
                                                                                <div class="col-6">
                                                                                    <button type="reset" class="btn btn-dark col-12 mt-3">Clear</button>
                                                                                </div>
                                                                            </div>
                                                                        </form>
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


                                    <!-- Offcanvas -->
                                    <div class="offcanvas offcanvas-top h-100" tabindex="-1" id="createpost" aria-labelledby="offcanvasTopLabel">
                                        <div class="offcanvas-header">
                                            <h5 class="offcanvas-title" id="offcanvasTopLabel">Create Post</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                        </div>
                                        <div class="offcanvas-body">
                                            <form method="post" action="staffpost.php" enctype="multipart/form-data">
                                                <div class="mb-3">
                                                    <input type="text" class="form-control" name="idnum" id="exampleFormControlInput1" value="<?php echo $row["idnum"]; ?>" placeholder="" hidden>
                                                </div>
                                                <div class="mb-3">
                                                    <input type="text" class="form-control" name="role" id="exampleFormControlInput1" value="<?php echo $row["role"]; ?>" placeholder="" hidden>
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
                                                    <select class="form-select" aria-label="Default select example" name="stream">
                                                        <option selected>Open this select menu</option>
                                                        <option value="For UG">For UG</option>
                                                        <option value="For PG">For PG</option>
                                                        <option value="Both UG and PG">Both UG and PG</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="form-label">Title</label>
                                                    <input type="text" class="form-control" name="title" id="exampleFormControlInput1" placeholder="">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                                                    <textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="5"></textarea>
                                                </div>
                                                <div class="mb-3 p-4">
                                                    <button type="submit" class="btn btn-dark w-100">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <?php
            if ($row['role'] == 'Training and Placement Staff') {
                // Display the tables

            ?>
                <!-- Post -->
                <section id="post">
                    <div class="container mt-5">
                        <div class="d-flex flex-wrap gap-2 mb-4 justify-content-center" id="data-container">
                            <?php
                            // Staff post data (assuming $conn is the connection object)
                            $PostQuery = "SELECT * FROM staffpost WHERE idnum='$idnum'";
                            $result = $conn->query($PostQuery);

                            if ($result && $result->num_rows > 0) {
                                while ($postRow = $result->fetch_assoc()) {
                            ?>
                                    <div class="card mb-3 p-2 text-center" style="width: 350px;">
                                        <div class="card-header h-auto bg-transparent">
                                            <!-- Php Code for company profile -->
                                            <?php
                                            $sql = "SELECT * FROM staffform WHERE idnum='$idnum'";
                                            $profile = $conn->query($sql);

                                            if ($profile === false) {
                                                echo "Error: " . $conn->error; // Display error message
                                            } else {
                                                // Check if there are rows returned
                                                if ($profile->num_rows > 0) {
                                                    // Data exists, display the information
                                                    while ($row = mysqli_fetch_assoc($profile)) {
                                            ?>
                                                        <img src="<?php echo $row["photo_path1"]; ?>" alt="" class="float-start mt-1 mx-3" style="float:left; width: 40px; height: 40px; border-radius: 40px; overflow: hidden;" class="btn btn-primary">
                                                        <p class="p-2 m-1 text-start pointer-event "><?php echo $row["role"]; ?></p>
                                            <?php
                                                    }
                                                } else {
                                                    echo "No records found for this user.";
                                                }
                                            }
                                            ?>
                                        </div>
                                        <div class="card-body">
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
                                                <form action="./Staffmanage/delete_post.php" method="post" onsubmit="return confirm('Are You Sure Do You Want To Delete This Post?');">
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
                                            <form method="post" action="staff_edit_post.php" enctype="multipart/form-data">
                                                <div class="mb-3">
                                                    <input type="text" class="form-control" name="idnum" id="exampleFormControlInput1" value="<?php echo $postRow["idnum"]; ?>" placeholder="" hidden>
                                                </div>
                                                <div class="mb-3">
                                                    <input type="text" class="form-control" name="role" id="exampleFormControlInput1" value="<?php echo $postRow["role"]; ?>" placeholder="" hidden>
                                                </div>
                                                <div class="mb-3">
                                                    <input type="text" class="form-control" name="postid" id="exampleFormControlInput1" value="<?php echo $postRow["postid"]; ?>" placeholder="" hidden>
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
                                                    <label for="exampleFormControlInput1" class="form-label">Title</label>
                                                    <input type="text" class="form-control" name="title" id="exampleFormControlInput1" value="<?php echo $postRow["title"]; ?>" placeholder="">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                                                    <textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="5"><?php echo $postRow["description"]; ?></textarea>
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
            } else {
                // Do not display the tables
            }
            ?>

            <!-- starting php -->
    <?php
        }
    }
    ?>
    <!-- libraries -->
    <script src="./Assets/js/jquery.min.js"></script>
    <script src="./Assets/js/bootstrap.min.js"></script>
    <script src="./Assets/js/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>

    <!-- Script -->
    <script>
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
    </script>
</body>

</html>
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
    <title>Staff Table</title>
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
    $sql = "SELECT * FROM stafflogin sl JOIN staffform sf on sl.idnum = sf.idnum";
    $staffprofile = $conn->query($sql);
    $userCount = $staffprofile->num_rows; // Count of job applications for the user
    // Check if there are rows returned
    if ($staffprofile && $staffprofile->num_rows > 0) {
        // Data exists, display the information
    ?>
        <div class="container mt-5">

            <div class="d-flex justify-content-md-start justify-content-center flex-wrap gap-2 mb-4" id="data-container">
                <?php
                // Display your data here using a loop or fetching individual rows
                mysqli_data_seek($staffprofile, 0); // Reset result pointer
                $rowCounter = 0;
                $modalCounter = 0;
                $offcanvasCounter = 0;
                $editprofile1 = 0;
                $dynamicOptions1 = 0;
                $editprofile2 = 0;
                $dynamicOptions2 = 0;
                while ($row = mysqli_fetch_assoc($staffprofile)) {
                    // Display data from $row
                    // Example: echo $row['column_name'];
                    $rowCounter++;
                    $modalCounter++; // Increment the counter for each iteration
                    $offcanvasCounter++; // Increment the counter for each iteration
                    $editprofile1++;
                    $dynamicOptions1++;
                    $editprofile2++;
                    $dynamicOptions2++;
                    $modalID = "ViewDetails" . $modalCounter; // Unique modal ID for each job post
                    $offCanvaID = "EditProfile" . $offcanvasCounter; // Unique modal ID for each job post
                    $editprofile1ID = "Stype" . $editprofile1; // Unique modal ID for Stype
                    $dynamicOptions1ID = "Role" . $dynamicOptions1; // Unique modal ID for Role
                    $editprofile2ID = "Staff" . $editprofile2; // Unique modal ID for Staff
                    $dynamicOptions2ID = "Department" . $dynamicOptions2; // Unique modal ID for Department
                ?>

                    <div class="card mt-3 justify-content-center" style="width: 180px; height: 275px;">
                        <div class="card-body text-center">
                            <center><img src="<?php echo "../" . $row["photo_path1"]; ?>" class="card-img-top mb-2" alt="" style="border-radius: 50%;  height:100px; width:100px; object-fit: cover;"></center>
                            <h5 class="card-title mb-2"><?php echo $row["name"];  ?></h5>
                            <p class="card-dept mb-2" style="font-size: small;"><?php echo $row["dept"]; ?></p>
                            <p class="card-role mb-2" style="font-size: small;"><?php echo $row["role"]; ?></p>
                            <a href="0" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#<?php echo $modalID; ?>">View Full Details</a>
                        </div>
                    </div>



                    <!-- Modal -->
                    <div class="modal fade" id="<?php echo $modalID; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-fullscreen">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel"><?php echo $row["name"];  ?></h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <!-- Profile -->
                                <div class="modal-body">
                                    <div class="container mb-5">
                                        <div class="card shadow-2-strong card-registration mb-4" style="border-radius: 15px;">
                                            <div class="card-body p-4 p-md-5">
                                                <!-- Profile Display -->
                                                <div class="row">
                                                    <div class="col-lg-4 col-12 mb-5 align-self-center d-flex justify-content-center">
                                                        <img src="<?php echo "../" . $row["photo_path1"]; ?>" class="card-img-top mb-2" alt="" style="border-radius: 50%;  height:300px; width:300px; object-fit: cover;">
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
                                                                <h3>Password</h3>
                                                                <p><?php echo $row["password"]; ?></p>
                                                            </div>
                                                            <div class="col-md-6 col-12 mb-3">
                                                                <div class="d-flex align-items-start gap-4">
                                                                    <a type="button" class="btn btn-dark" data-bs-toggle="offcanvas" data-bs-target="#<?php echo $offCanvaID; ?>">Edit Profile</a>
                                                                    <form method="POST" action="./Manageuser/deletestaff.php">
                                                                        <input type="hidden" name="idnum" value="<?php echo $row['idnum']; ?>">
                                                                        <button type="submit" class="btn btn-danger" name="delete_user" onclick="return confirm('Are You Sure Do You Want To Delete This User?')">Delete</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Details -->
                                                </div>
                                                <!-- Profile Display -->
                                            </div>
                                        </div>
                                    </div>


                                    <!-- Post -->
                                    <div class="container">
                                        <div class="d-flex flex-wrap gap-2 mb-4 justify-content-center" id="data-container">
                                            <?php
                                            $staffid = $row['idnum'];
                                            // Staff post data (assuming $conn is the connection object)
                                            $PostQuery = "SELECT * FROM staffpost WHERE idnum='$staffid'";
                                            $result = $conn->query($PostQuery);

                                            if ($result && $result->num_rows > 0) {
                                                while ($postRow = $result->fetch_assoc()) {
                                            ?>
                                                    <div class="card mb-3 p-2 text-center" style="width: 350px;">
                                                        <div class="card-header h-auto bg-transparent">
                                                            <img src="<?php echo "../" . $row["photo_path1"]; ?>" alt="" class="float-start mt-1 mx-3" style="float:left; width: 40px; height: 40px; border-radius: 40px; overflow: hidden;" class="btn btn-primary">
                                                            <p class="p-2 m-1 text-start pointer-event"><?php echo $row["role"]; ?></p>
                                                        </div>
                                                        <div class="card-body">
                                                            <img src="<?php echo "../" . $postRow["photo_path"]; ?>" class="card-img-top img-fluid mb-3" style="height:200px; object-fit:contain; object-position:center;" id="cardpreview" alt="" onclick="previewPostImage(this);">
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
                                                        <div class="card-footer bg-transparent justify-content-center">
                                                            <p class="card-text text-center"><small class="text-muted">Posted on: <?php echo $postRow["insert_time"]; ?></small></p>
                                                            <!-- Delete button -->
                                                            <form action="./Staffmanage/delete_post.php" method="post">
                                                                <input type="hidden" name="postid" value="<?php echo $postRow['postid']; ?>">
                                                                <button type="submit" class="btn btn-danger w-100" name="delete_post" onclick="return confirm('Are You Sure Do You Want To Delete This Post?')">Delete</button>
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

                                    <!-- OffCanvas -->
                                    <div class="offcanvas offcanvas-top h-100" tabindex="-1" id="<?php echo $offCanvaID; ?>" aria-labelledby="offcanvasTopLabel">
                                        <div class="offcanvas-header">
                                            <h5 class="offcanvas-title" id="offcanvasTopLabel">Edit Profile</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                        </div>
                                        <div class="offcanvas-body">
                                            <div class="container py-5 h-100 ">
                                                <div class="row justify-content-center align-items-center h-100">
                                                    <div class="col-12">
                                                        <div class="card shadow-2-strong card-registration mb-5" style="border-radius: 15px;">
                                                            <div class="card-body p-4 p-md-5">
                                                                <form method="post" action="./Manageuser/editstaff.php" enctype="multipart/form-data" class="">
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
                                                                                <input type="number" class="form-control" name="age" id="ageInput" placeholder="Age" value="<?php echo $row["age"]; ?>" disabled>
                                                                                <label for="floatingInput">Age*</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <div class="form-floating mb-3">
                                                                                <select class="form-control" name="stype" id="<?php echo $editprofile1ID; ?>" onchange="selectOption()" required>
                                                                                    <option class="" value="<?php echo $row["stype"]; ?>" selected><?php echo $row["stype"]; ?></option>
                                                                                    <option class="Teaching" value="Teaching">Teaching</option>
                                                                                    <option class="Non-Teaching" value="Non-Teaching">Non-Teaching</option>
                                                                                </select>
                                                                                <label for="floatingInput">Teaching or Non-Teaching</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <div class="form-floating mb-3">
                                                                                <select class="form-control" name="role" id="<?php echo $dynamicOptions1ID; ?>" required>
                                                                                    <option class="" value="<?php echo $row["role"]; ?>" selected><?php echo $row["role"]; ?></option>
                                                                                </select>
                                                                                <label for="floatingInput">Role</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <div class="form-floating mb-3">
                                                                                <select class="form-control" name="staff" id="<?php echo $editprofile2ID; ?>" onchange="selectOption2()" required>
                                                                                    <option class="" value="<?php echo $row["staff"]; ?>" selected><?php echo $row["staff"]; ?></option>
                                                                                    <option class="" value="Aided">Aided</option>
                                                                                    <option class="" value="Self Financed">Self Financed</option>
                                                                                    <option class="" value="Selected Non-Teaching">Selected Non-Teaching
                                                                                    </option>
                                                                                    <!-- <option class="" value="Non-Applicable">Non-Applicable</option> -->
                                                                                </select>
                                                                                <label for="floatingInput">Aided / SF</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <div class="form-floating mb-3">
                                                                                <select class="form-control" name="dept" id="<?php echo $dynamicOptions2ID; ?>" required>
                                                                                    <option class="" value="<?php echo $row["dept"]; ?>" selected><?php echo $row["dept"]; ?></option>
                                                                                </select>
                                                                                <label for="floatingInput">Department</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <div class="form-floating mb-3">
                                                                                <input type="text" class="form-control" name="password" id="password" placeholder="password" value="<?php echo $row["password"]; ?>" required>
                                                                                <label for="floatingInput">password*</label>
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
                                    </div>
                                    <!-- Offcanvas -->
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

    // option 1
    function selectOption() {
        var selectedOption = $("#<?php echo $editprofile1ID; ?>").val();
        var dynamicOptions = $("#<?php echo $dynamicOptions1ID; ?>");

        dynamicOptions.empty(); // Clear previous options

        if (selectedOption === "Teaching") {
            // If option 1 is selected, populate the dynamic options list with the same options
            dynamicOptions.append('<option value="subOption0">Select Teaching</option>');
            dynamicOptions.append('<option value="Principal">Principal</option>');
            dynamicOptions.append('<option value="Deans">Deans</option>');
            dynamicOptions.append('<option value="Head of Department">Head of Department</option>');
            dynamicOptions.append('<option value="Co-Ordinator">Co-Ordinator</option>');
            dynamicOptions.append('<option value="Professor">Professor</option>');

            // Add more options as needed
        } else if (selectedOption === "Non-Teaching") {
            // If option 2 is selected, populate the dynamic options list with different options
            dynamicOptions.append('<option value="anotherSubOption0">Select Non-Teaching</option>');
            dynamicOptions.append('<option value="Training and Placement Staff">Training and Placement Staff</option>');
            dynamicOptions.append('<option value="IT-Supports Staff">IT-Supports Staff</option>');
            dynamicOptions.append('<option value="Library Staff">Library Staff</option>');

            // Add more options as needed
        }
    }

    // option 2
    function selectOption2() {
        var selectedOption2 = $("#<?php echo $editprofile2ID; ?>").val();
        var dynamicOptions2 = $("#<?php echo $dynamicOptions2ID; ?>");

        dynamicOptions2.empty(); // Clear previous options

        if (selectedOption2 === "Aided") {
            // If option 1 is selected, populate the dynamic options list with the same options
            dynamicOptions2.append('<option value="subOption0">Select Aided Department</option>');
            dynamicOptions2.append('<option value="B.A. Economics">B.A. Economics</option>');
            dynamicOptions2.append('<option value="B.A. English">B.A. English</option>');
            dynamicOptions2.append('<option value="B.Com">B.Com</option>');
            dynamicOptions2.append('<option value="B.Sc. Botany">B.Sc. Botany</option>');
            dynamicOptions2.append('<option value="B.Sc. Chemistry">B.Sc. Chemistry</option>');
            dynamicOptions2.append('<option value="B.Sc. Computer Science">B.Sc. Computer Science</option>');
            dynamicOptions2.append('<option value="B.Sc. Mathematics">B.Sc. Mathematics</option>');
            dynamicOptions2.append('<option value="B.Sc. Physics">B.Sc. Physics</option>');
            dynamicOptions2.append('<option value="B.Sc. Zoology">B.Sc. Zoology</option>');
            dynamicOptions2.append('<option value="M.A. English">M.A. English</option>');
            dynamicOptions2.append('<option value="M.A.Tamil">M.A.Tamil</option>');
            dynamicOptions2.append('<option value="M.Sc. Library & Information Science">M.Sc. Library & Information Science</option>');
            dynamicOptions2.append('<option value="M.Sc. Environmental Sciences">M.Sc. Environmental Sciences</option>');
            // Add more options as needed
        } else if (selectedOption2 === "Self Financed") {
            // If option 2 is selected, populate the dynamic options list with different options
            dynamicOptions2.append('<option value="anotherSubOption0">Select Self-Financed Department</option>');
            dynamicOptions2.append('<option value="B.A. Tamil">B.A. Tamil</option>');
            dynamicOptions2.append('<option value="B.B.A.">B.B.A.</option>');
            dynamicOptions2.append('<option value="B.B.A Aviation">B.B.A Aviation</option>');
            dynamicOptions2.append('<option value="B.Voc. Accounting Taxation">B.Voc. Accounting Taxation</option>');
            dynamicOptions2.append('<option value="B.Voc. Information Technology">B.Voc. Information Technology</option>');
            dynamicOptions2.append('<option value="B.S.W. Social Work">B.S.W. Social Work</option>');
            dynamicOptions2.append('<option value="B.Sc. Actuarial Mathematics Science">B.Sc. Actuarial Mathematics Science</option>');
            dynamicOptions2.append('<option value="B.Sc. Aviation">B.Sc. Aviation</option>');
            dynamicOptions2.append('<option value="B.Sc. Biotechnology">B.Sc. Biotechnology</option>');
            dynamicOptions2.append('<option value="B.A. English">B.A. English</option>');
            dynamicOptions2.append('<option value="B.Com">B.Com</option>');
            dynamicOptions2.append('<option value="B.Sc. Botany">B.Sc. Botany</option>');
            dynamicOptions2.append('<option value="B.Sc. Chemistry">B.Sc. Chemistry</option>');
            dynamicOptions2.append('<option value="B.Sc. Computer Science">B.Sc. Computer Science</option>');
            dynamicOptions2.append('<option value="B.Sc. Environmental Sciences">B.Sc. Environmental Sciences</option>');
            dynamicOptions2.append('<option value="B.Sc. Nutrition">B.Sc. Nutrition</option>');
            dynamicOptions2.append('<option value="B.Sc. Mathematics">B.Sc. Mathematics</option>');
            dynamicOptions2.append('<option value="B.Sc. Physics">B.Sc. Physics</option>');
            dynamicOptions2.append('<option value="B.Sc. Zoology">B.Sc. Zoology</option>');
            dynamicOptions2.append('<option value="B.C.A. Computer Applicaitons">B.C.A. Computer Applicaitons</option>');
            dynamicOptions2.append('<option value="M.B.A. Business Administration">M.B.A. Business Administration</option>');
            dynamicOptions2.append('<option value="M.Com. Commerce">M.Com. Commerce</option>');
            dynamicOptions2.append('<option value="M.A. Economics">M.A. Economics</option>');
            dynamicOptions2.append('<option value="M.A. History">M.A. History</option>');
            dynamicOptions2.append('<option value="M.S.W. Social Work">M.S.W. Social Work</option>');
            dynamicOptions2.append('<option value="M.C.A. Computer Applications">M.C.A. Computer Applications</option>');
            dynamicOptions2.append('<option value="M.Sc. Zoology">M.Sc. Zoology</option>');
            dynamicOptions2.append('<option value="M.Sc. Physics">M.Sc. Physics</option>');
            dynamicOptions2.append('<option value="M.Sc. Mathematics">M.Sc. Mathematics</option>');
            dynamicOptions2.append('<option value="M.Sc. Information Technology">M.Sc. Information Technology</option>');
            dynamicOptions2.append('<option value="anotherSubOption12">M.Sc. Food Science and Nutrition</option>');
            dynamicOptions2.append('<option value="M.Sc. Data Science">M.Sc. Data Science</option>');
            dynamicOptions2.append('<option value="M.Sc. Computer Science">M.Sc. Computer Science</option>');
            dynamicOptions2.append('<option value="M.Sc. Chemistry">M.Sc. Chemistry</option>');
            dynamicOptions2.append('<option value="M.Sc. Botany">M.Sc. Botany</option>');
            dynamicOptions2.append('<option value="M.Sc. Biotechnology">M.Sc. Biotechnology</option>');
            dynamicOptions2.append('<option value="M.Sc. Bioinformatics">M.Sc. Bioinformatics</option>');
            dynamicOptions2.append('<option value="M.Sc. Actuarial Science">M.Sc. Actuarial Science</option>');

            // Add more options as needed
        } else if (selectedOption2 === "Selected Non-Teaching") {
            dynamicOptions2.append('<option value="anotherSubOption1">Selected Non-Teaching</option>');
            dynamicOptions2.append('<option value="Non-Teaching Staff">Non-Teaching Staff</option>');
        }
    }

    const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
    const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl, {
        trigger: 'focus'
    }))
</script>

</html>
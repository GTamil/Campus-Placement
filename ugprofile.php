<?php
session_start();
require_once 'connectdb.php';
@$rollno = $_SESSION["rollno"];
$sql = "SELECT * FROM studentugform where rollno='$rollno'";
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

<body>
    <!-- Profile -->
    <?php
    // Check if there are rows returned
    if ($profile && $profile->num_rows > 0) {
        // Data exists, display the information
        // Display your data here using a loop or fetching individual rows
        while ($row = mysqli_fetch_assoc($profile)) {
            // Display data from $row
            // Example: echo $row['column_name'];
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
                                    <a class="nav-link text-dark" aria-current="page" href="./studentmainug.php">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-dark" href="./studentmainug.php">Post</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-dark" href="./studentugform.php">Forms</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-dark navbar-nav" type="button" href="./ugprofile.php"><i class="bi bi-person-circle"></i><b class="mx-2"><?php echo $row["name"]; ?></b></a>
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

            <!-- Profile -->
            <section id="profile">
                <div class="container py-5 h-100 mb-5">
                    <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                        <div class="card-body p-4 p-md-5">
                            <div class="row bg-body-tertiary">
                                <div class="col-lg-4 col-md-4 col-12 bg-body-secondary rounded-2 text-center p-5">
                                    <h1>Student Profile</h1>
                                    <center>
                                        <div class="m-5">
                                            <img src="<?php echo $row["photo_path"]; ?>" class="img-fluid shadow-lg rounded-3" style="width: 200px; height: 250px; object-fit: cover;" alt="..." data-bs-toggle="modal" data-bs-target="#Profile1">
                                        </div>
                                        <!-- Modal -->
                                        <div class="modal fade" id="Profile1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Change Profile Photo</h1>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post" action="updateugphoto.php" class="p-5" enctype="multipart/form-data">
                                                            <img src="<?php echo $row["photo_path"]; ?>" id="imagePreview" class="img-fluid" style="width: 200px; height: 250px; object-fit: cover;" alt="...">
                                                            <div id="HelpBlock" class="form-text mb-3 text-end">
                                                                *Photo Size Max 10MB
                                                            </div>
                                                            <div class="input-group mb-3">
                                                                <input type="file" class="form-control" id="uploadInput" name="user_photo" accept="image/*" onchange="previewImage(event)">
                                                                <label class="input-group-text" for="inputGroupFile02">Upload Profile Photo</label>
                                                            </div>
                                                            <div class="col-6">
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
                                    </center>
                                    <div class="row">
                                        <div class="col-lg-12 col-12">
                                            <h2>Name</h2>
                                            <h6 class="mb-5"><?php echo $row["name"];  ?></h6>
                                        </div>
                                        <div class="col-lg-12 col-12">
                                            <h2>Roll Number</h2>
                                            <h6 class="mb-5"><?php echo $row["rollno"];  ?></h6>
                                        </div>
                                        <div class="col-lg-12 col-12">
                                            <h2>Stream</h2>
                                            <h6 class="mb-5"><?php echo $row["course"];  ?></h6>
                                        </div>
                                        <div class="col-lg-12 col-12">
                                            <h2>Department</h2>
                                            <h6 class="mb-5"><?php echo $row["dept"];  ?></h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8 col-md-8 col-12 bg-body-tertiary rounded-2 p-4">
                                    <table class="table table-hover table-borderless h-100">
                                        <tbody>
                                            <tr>
                                                <th scope="row">
                                                <td>Name</td>
                                                <td><?php echo $row["name"];  ?></td>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th scope="row">
                                                <td>Roll Number</td>
                                                <td><?php echo $row["rollno"];  ?></td>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th scope="row">
                                                <td>Date of birth</td>
                                                <td><?php echo $row["dob"];  ?></td>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th scope="row">
                                                <td>Stream</td>
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
                                                <td>Father Name</td>
                                                <td><?php echo $row["fname"];  ?></td>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th scope="row">
                                                <td>Mother Name</td>
                                                <td><?php echo $row["mname"];  ?></td>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th scope="row">
                                                <td>Phone Number</td>
                                                <td><?php echo $row["phone"];  ?></td>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th scope="row">
                                                <td>Email</td>
                                                <td><?php echo $row["email"];  ?></td>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th scope="row">
                                                <td>Address</td>
                                                <td>
                                                    <?php echo $row["peradd"];  ?>,<br>
                                                    <?php echo $row["city"];  ?> - <?php echo $row["pincode"];  ?>,<br>
                                                    <?php echo $row["state"];  ?>,<br>
                                                    <?php echo $row["country"];  ?>.
                                                </td>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th scope="row">
                                                <td>10th Percentage</td>
                                                <td><?php echo $row["tenth"];  ?></td>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th scope="row">
                                                <td>12th Percentage</td>
                                                <td><?php echo $row["twelveth"];  ?></td>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th scope="row">
                                                <td>UG Percentage</td>
                                                <td><?php echo $row["ug"];  ?></td>
                                                </th>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- view files -->
                            <div class="row">
                                <div class="col">
                                    <button type="submit" class="btn btn-secondary col-12 mt-3" data-bs-toggle="modal" data-bs-target="#viewfiles">View Uploaded Files</button>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="viewfiles" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">View Files</h1>
                                            </div>
                                            <div class="modal-body">
                                                <table class="table table-hover table-borderless h-100">
                                                    <thead>

                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <th>Roll No</th>
                                                            <td><?php echo $row['rollno']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Name</th>
                                                            <td><?php echo $row['name']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>10th Certificate</th>
                                                            <td><?php echo $row['file_path1']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>12th Certificate</th>
                                                            <td><?php echo $row['file_path2']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>UG Certificate</th>
                                                            <td><?php echo $row['file_path3']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Cv</th>
                                                            <td><?php echo $row['file_path4']; ?></td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Edit profile -->
                                <div class="col">
                                    <button type="button" class="btn btn-secondary col-12 mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap">Edit Profile</button>
                                </div>
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Profile</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" action="updateug.php" enctype="multipart/form-data" class="p-5">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-floating mb-3">
                                                                <input type="text" class="form-control" name="name" id="floatingInput" value="<?php echo $row["name"]; ?>" placeholder="Name" required>
                                                                <label for="floatingInput">Name</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-floating mb-3">
                                                                <input type="text" class="form-control" name="rollno" id="floatingInput" placeholder="Roll Number" value="<?php echo $row["rollno"]; ?>" disabled>
                                                                <label for="floatingInput">Roll No</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-floating mb-3">
                                                                <input type="text" class="form-control" name="phone" id="floatingInput" placeholder="1234567890" value="<?php echo $row["phone"]; ?>" required>
                                                                <label for="floatingInput">Phone Number</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-floating mb-3">
                                                                <input type="email" class="form-control" name="email" id="floatingInput" placeholder="name@example.com" value="<?php echo $row["email"]; ?>" required>
                                                                <label for="floatingInput">Email address</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-floating mb-3">
                                                                <input type="text" class="form-control" name="fname" id="floatingInput" placeholder="Father Name" value="<?php echo $row["fname"]; ?>" required>
                                                                <label for="floatingInput">Father Name</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-floating mb-3">
                                                                <input type="text" class="form-control" name="mname" id="floatingInput" placeholder="Mother Name" value="<?php echo $row["mname"]; ?>" required>
                                                                <label for="floatingInput">Mother Name</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-floating mb-3">
                                                                <input type="text" class="form-control" name="peradd" placeholder="Address" id="floatingInput" value="<?php echo $row["peradd"]; ?>" required>
                                                                <label for="floatingInput">Address</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-12">
                                                            <div class="form-floating mb-3">
                                                                <input type="text" class="form-control" name="city" id="floatingInput" placeholder="City" value="<?php echo $row["city"]; ?>" required>
                                                                <label for="floatingInput">City *</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-12">
                                                            <div class="form-floating mb-3">
                                                                <input type="text" class="form-control" name="pincode" id="floatingInput" placeholder="PinCode" value="<?php echo $row["pincode"]; ?>" required>
                                                                <label for="floatingInput">Pin Code *</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-12">
                                                            <div class="form-floating mb-3">
                                                                <input type="text" class="form-control" name="state" id="floatingInput" placeholder="State" value="<?php echo $row["state"]; ?>" required>
                                                                <label for="floatingInput">State *</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-12">
                                                            <div class="form-floating mb-3">
                                                                <input type="text" class="form-control" name="country" id="floatingInput" placeholder="Country" value="<?php echo $row["country"]; ?>" required>
                                                                <label for="floatingInput">Country *</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-floating mb-3">
                                                                <input type="text" class="form-control" name="course" id="floatingInput" placeholder="Stream" value="<?php echo $row["course"]; ?>" disabled>
                                                                <label for="options">Stream</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-floating mb-3">
                                                                <input type="text" class="form-control" name="dept" id="floatingInput" placeholder="Department" value="<?php echo $row["dept"]; ?>" disabled>
                                                                <label for="options">Department</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-floating mb-3">
                                                                <input type="text" class="form-control" name="school1" id="floatingInput" placeholder="school Studied" value="<?php echo $row["school1"]; ?>" required>
                                                                <label for="floatingInput">School Studied</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-12">
                                                            <div class="form-floating mb-3">
                                                                <input type="text" class="form-control" name="tenth" id="floatingInput" placeholder="10th Percentage" value="<?php echo $row["tenth"]; ?>" required>
                                                                <label for="floatingInput">10th Percentage</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-floating mb-3">
                                                                <input type="text" class="form-control" name="school2" id="floatingInput" placeholder="school Studied" value="<?php echo $row["school2"]; ?>" required>
                                                                <label for="floatingInput">School Studied</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-floating mb-3">
                                                                <input type="text" class="form-control" name="twelveth" id="floatingInput" placeholder="12th Percentage" value="<?php echo $row["twelveth"]; ?>" required>
                                                                <label for="floatingInput">12th Percentage</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-floating mb-3">
                                                                <input type="text" class="form-control" name="ug" id="floatingInput" placeholder="UG Percentage" value="<?php echo $row["ug"]; ?>" required>
                                                                <label for="floatingInput">UG Percentage * (Enter the Percentage Till Concluded Semester)</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="input-group mb-3">
                                                                <input type="file" class="form-control" name="user_file1" accept=".pdf">
                                                                <label class="input-group-text" for="inputGroupFile02">10th Certificate</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="input-group mb-3">
                                                                <input type="file" class="form-control" name="user_file2" accept=".pdf">
                                                                <label class="input-group-text" for="inputGroupFile02">12th Certificate</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="input-group mb-3">
                                                                <input type="file" class="form-control" name="user_file3" accept=".pdf">
                                                                <label class="input-group-text" for="inputGroupFile02">UG Marksheet</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="input-group mb-3">
                                                                <input type="file" class="form-control" name="user_file4" accept=".pdf">
                                                                <label class="input-group-text" for="inputGroupFile02">Upload CV</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-6">
                                                            <button type="submit" class="btn btn-secondary col-12 mt-3">Submit</button>
                                                        </div>
                                                        <div class="col-6">
                                                            <button type="reset" class="btn btn-secondary col-12 mt-3">Clear</button>
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
                        </div>
                    </div>
                </div>
            </section>

            <!-- Job Application -->
            <?php
            // Use the user ID to fetch related data from jobapplication
            $sql_jobapplication = "SELECT * FROM jobapplication WHERE rollno='$rollno'";
            $result_jobapplication = $conn->query($sql_jobapplication);

            $userCount = $result_jobapplication->num_rows; // Count of job applications for the user

            if ($result_jobapplication->num_rows > 0) {
            ?>
                <!-- List of Applications -->
                <section>
                    <div class="container table-responsive mb-5">
                        <h1 class="text-Start mb-4">Registered List</h1>
                        <p>Total job applications: <?php echo $userCount; ?></p>
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
                                // Display jobapplication data
                                while ($row_jobapplication = $result_jobapplication->fetch_assoc()) {
                                    // Access data using $row_jobapplication['column_name']
                                ?>
                                    <tr class="text-center">
                                        <th scope="row"><?php echo $row_jobapplication['cname']; ?></th>
                                        <th scope="row"><?php echo $row_jobapplication['title']; ?></th>
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
                echo "<center>No job applications.</center>";
            }
            ?>
    <?php
        }
    } else {
        // No data exists, redirect to another page
        $message = "Please fill the details";
        echo "<script type='text/javascript'>alert('$message');</script>";
        echo ("<script>window.location = 'studentugform.php';</script>");
        exit;
    }
    ?>


    <!-- libraries -->
    <script src="./Assets/js/jquery.min.js"></script>
    <script src="./Assets/js/bootstrap.min.js"></script>
    <script src="./Assets/js/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>

    <!-- script -->
    <script>
        // image preview
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('imagePreview');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }

        const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
        const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl, {
            trigger: 'focus'
        }))
    </script>
</body>

</html>
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
    <title>PG Student Table</title>
</head>

<body>
    <div id="header">
        <?php include 'header.html'; ?>
    </div>

    <?php
    $sql = "SELECT * FROM studentpgform sp JOIN studentlogin sl ON sp.rollno = sl.rollno";
    $pgprofile = $conn->query($sql);
    $userCount = $pgprofile->num_rows; // Count of job applications for the user
    // Check if there are rows returned
    if ($pgprofile && $pgprofile->num_rows > 0) {
        // Data exists, display the information
    ?>
        <div class="container mt-5">
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
                            mysqli_data_seek($pgprofile, 0); // Reset result pointer
                            while ($row = mysqli_fetch_assoc($pgprofile)) {
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
            <div class="d-flex justify-content-md-start justify-content-center flex-wrap gap-2 mb-4" id="data-container">
                <?php
                // Display your data here using a loop or fetching individual rows
                mysqli_data_seek($pgprofile, 0); // Reset result pointer
                $rowCounter = 0;
                $modalCounter = 0;
                $offcanvasCounter = 0;
                while ($row = mysqli_fetch_assoc($pgprofile)) {
                    // Display data from $row
                    // Example: echo $row['column_name'];
                    $rowCounter++;
                    $modalCounter++; // Increment the counter for each iteration
                    $offcanvasCounter++; // Increment the counter for each iteration
                    $modalID = "ViewDetails" . $modalCounter; // Unique modal ID for each job post
                    $offCanvaID = "EditProfile" . $offcanvasCounter; // Unique modal ID for each job post
                ?>

                    <div class="card mt-3 justify-content-center" style="width: 180px; height: 250px;">
                        <div class="card-body text-center">
                            <center><img src="<?php echo "../" . $row["photo_path"]; ?>" class="card-img-top mb-2" alt="" style="border-radius: 50%;  height:100px; width:100px; object-fit: cover;"></center>
                            <h5 class="card-title mb-2"><?php echo $row["name"]; ?></h5>
                            <p class="card-dept mb-2" style="font-size: small;"><?php echo $row["dept"]; ?></p> <!-- Added department information -->
                            <a href="0" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#<?php echo $modalID; ?>">View Full Details</a>
                        </div>
                    </div>



                    <!-- Modal -->
                    <div class="modal fade" id="<?php echo $modalID; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-fullscreen">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel"><?php echo $row["name"]; ?></h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <!-- Profile -->
                                <div class="modal-body">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-12 bg-body-secondary text-center p-5">
                                                <h1>Student Profile</h1>
                                                <center>
                                                    <div class="m-5">
                                                        <img src="<?php echo "../" . $row["photo_path"]; ?>" class="img-fluid" style="width: 200px; height: 250px; object-fit: cover;" alt="...">
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
                                                        <h2>Year of Passing</h2>
                                                        <h6 class="mb-5"><?php echo $row["yop"];  ?></h6>
                                                    </div>
                                                    <div class="col-lg-12 col-12">
                                                        <h2>Department</h2>
                                                        <h6 class="mb-5"><?php echo $row["dept"];  ?></h6>
                                                    </div>
                                                    <div class="col-lg-12 col-12">
                                                        <h2>Password</h2>
                                                        <h6 class="mb-5"><?php echo $row["password"];  ?></h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-12 bg-body-tertiary p-5">
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
                                                        <tr>
                                                            <th scope="row">
                                                            <td>PG Percentage</td>
                                                            <td><?php echo $row["pg"];  ?></td>
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">
                                                            <td>10th Certificate</td>
                                                            <td><small><?php echo $row['file_path1']; ?></small></td>
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">
                                                            <td>12th Certificate</td>
                                                            <td><small><?php echo $row['file_path2']; ?></small></td>
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">
                                                            <td>Ug Certificate</td>
                                                            <td><small><?php echo $row['file_path3']; ?></small></td>
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">
                                                            <td>Pg Certificate</td>
                                                            <td><small><?php echo $row['file_path4']; ?></small></td>
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">
                                                            <td>Cv</td>
                                                            <td><small><?php echo $row['file_path5']; ?></small></td>
                                                            </th>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="d-flex gap-2 align-items-start justify-content-end mt-3">
                                            <a type="button" class="btn btn-info" data-bs-toggle="offcanvas" data-bs-target="#<?php echo $offCanvaID; ?>" aria-controls="offcanvasTop">Edit Profile</a>
                                            <form method="POST" action="./Manageuser/deleteuguser.php">
                                                <input type="hidden" name="rollno" value="<?php echo $row['rollno']; ?>">
                                                <button type="submit" class="btn btn-danger" name="delete_user" onclick="return confirm('Are You Sure Do You Want To Delete This User?')">Delete</button>
                                            </form>
                                        </div>
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
                                <form method="post" action="../updatepg.php" class="p-5" enctype="multipart/form-data">
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
                                                <input type="text" class="form-control" name="college" id="floatingInput" placeholder="college Studied" value="<?php echo $row["college"]; ?>" required>
                                                <label for="floatingInput">College Studied</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" name="ug" id="floatingInput" placeholder="UG Percentage" value="<?php echo $row["ug"]; ?>" required>
                                                <label for="floatingInput">UG Percentage</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" name="pg" id="floatingInput" placeholder="PG Percentage" value="<?php echo $row["pg"]; ?>" required>
                                                <label for="floatingInput">PG Percentage * (Enter the Percentage Till Concluded Semester)</label>
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
                                                <label class="input-group-text" for="inputGroupFile02">PG Marksheet</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="input-group mb-3">
                                                <input type="file" class="form-control" name="user_file5" accept=".pdf">
                                                <label class="input-group-text" for="inputGroupFile02">Update Resume</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <button type="submit" class="btn btn-secondary col-12 mt-3" value="NEXT">Submit</button>
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
    // Filter
    function applyFilter() {
        const nameFilter = document.getElementById('filter').value.toLowerCase();
        const deptFilter = document.getElementById('deptFilter').value.toLowerCase();
        const cards = document.querySelectorAll('.card');
        cards.forEach(card => {
            const name = card.querySelector('.card-title').textContent.toLowerCase();
            const dept = card.querySelector('.card-dept').textContent.toLowerCase();
            if ((name.includes(nameFilter) || nameFilter === '') && (dept.includes(deptFilter) || deptFilter === '')) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
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
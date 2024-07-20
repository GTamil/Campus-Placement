<?php
session_start();

require_once 'connectdb.php';
@$idnum = $_SESSION["idnum"];
$sql = "SELECT * FROM staffform WHERE idnum='$idnum'";
$profile = $conn->query($sql);
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Assets/css/style.css">
    <link rel="stylesheet" href="./Assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>UG Student Table</title>
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
                                    <a href="./staffprofile.php" class="nav-link text-dark navbar-nav" type="button"><i class="bi bi-person-circle my-1"></i><b class="mx-2"><?php echo $row["name"]; ?></b></a>
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

    <?php
        }
    } else {
        // No data exists, redirect to another page

    }
    ?>
    
    <?php
    $sql = "SELECT * FROM studentugform su JOIN studentlogin sl ON su.rollno = sl.rollno;";
    $ugprofile = $conn->query($sql);
    $userCount = $ugprofile->num_rows; // Count of job applications for the user
    // Check if there are rows returned
    if ($ugprofile && $ugprofile->num_rows > 0) {
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
                            mysqli_data_seek($ugprofile, 0); // Reset result pointer
                            while ($row = mysqli_fetch_assoc($ugprofile)) {
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
                mysqli_data_seek($ugprofile, 0); // Reset result pointer
                $rowCounter = 0;
                $modalCounter = 0;
                $offcanvasCounter = 0;
                while ($row = mysqli_fetch_assoc($ugprofile)) {
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
                            <center><img src="<?php echo $row["photo_path"]; ?>" class="card-img-top mb-2" alt="" style="border-radius: 50%;  height:100px; width:100px; object-fit: cover;"></center>
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
                                                        <img src="<?php echo $row["photo_path"]; ?>" class="img-fluid" style="width: 200px; height: 250px; object-fit: cover;" alt="...">
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
                                                            <td>Cv</td>
                                                            <td><small><?php echo $row['file_path4']; ?></small></td>
                                                            </th>
                                                        </tr>
                                                    </tbody>
                                                </table>
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
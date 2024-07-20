<?php
session_start();
require_once 'connectdb.php';
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
<body>
    <!-- Profile -->
    <?php
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


        <!-- form -->
        <section id="stform">
            <h1 class="text-center display-2 p-2 fw-bold">Student Fill Details</h1>
            <div class="container p-2 w-100 mb-5 rounded-4 shadow">
                <form method="post" action="ugform.php" enctype="multipart/form-data" class="p-5">
                    <div class="row">
                        <div class="col-12">
                            <center>
                                <div class="mb-3 d-grid align-items-center bg-secondary-subtle border rounded" style="width: 200px; height: 250px;">
                                    <h5 class="text-center" id="textPlaceholder1" style="display: block;">Upload Profile</h5>
                                    <img src="" id="imagePreview1" class="img-fluid mb-3 border-0 rounded" style="width: 200px; height: 250px; object-fit: cover; display: none;" alt="">
                                </div>
                            </center>
                            <div class="input-group mb-3">
                                <input type="file" class="form-control" id="inputGroupFile02" name="user_photo" accept="image/*" onchange="previewImage1(event)">
                                <label class="input-group-text" for="inputGroupFile02">Photo Size Max 10MB</label>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="name" id="floatingInput" placeholder="Name" value="<?php echo $row["name"]; ?>" required>
                                <label for="floatingInput">Name *</label>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="rollno" id="floatingInput" placeholder="Roll Number" value="<?php echo $row["rollno"]; ?>" required>
                                <label for="floatingInput">Roll Number *</label>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="form-floating mb-3">
                                <input type="date" class="form-control" name="dob" id="dob" placeholder="Date of Birth" required>
                                <label for="floatingInput">Date of Birth *</label>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" name="age" id="ageInput" placeholder="Age" required>
                                <label for="floatingInput">Age *</label>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="phone" id="floatingInput" placeholder="1234567890" value="<?php echo $row["phone"]; ?>" required>
                                <label for="floatingInput">Phone Number *</label>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" name="email" id="floatingInput" placeholder="name@example.com" value="<?php echo $row["email"]; ?>" required>
                                <label for="floatingInput">Email address *</label>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="fname" id="floatingInput" placeholder="Father Name" required>
                                <label for="floatingInput">Father Name *</label>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="mname" id="floatingInput" placeholder="Mother Name" required>
                                <label for="floatingInput">Mother Name *</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="peradd" id="floatingInput" placeholder="Address" required>
                                <label for="floatingInput">Address *</label>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="city" id="floatingInput" placeholder="City" required>
                                <label for="floatingInput">City *</label>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="pincode" id="floatingInput" placeholder="PinCode" required>
                                <label for="floatingInput">Pin Code *</label>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="state" id="floatingInput" placeholder="State" required>
                                <label for="floatingInput">State *</label>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="country" id="floatingInput" placeholder="Country" required>
                                <label for="floatingInput">Country *</label>
                            </div>
                        </div>

                        <div class="col-lg-6 col-12">
                            <div class="form-floating">
                                <select class="form-select form-select mb-3" id="options" name="course" onchange="selectOption()" required>
                                    <option class="floatingInput" selected>Select Course</option>
                                    <option value="UG">UG</option>
                                </select>
                                <label for="options">Select Course *</label>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="form-floating">
                                <select class="form-select form-select mb-3" name="dept" id="dynamicOptions" required>
                                    <option value="subOption0">Select UG Department</option>
                                    <option value="B.A. Economics">B.A. Economics</option>
                                    <option value="B.A. English">B.A. English</option>
                                    <option value="B.B.A.">B.B.A.</option>
                                    <option value="B.A. Tamil">B.A. Tamil</option>
                                    <option value="B.Com">B.Com</option>
                                    <option value="B.B.A Aviation">B.B.A Aviation</option>
                                    <option value="B.Voc. Accounting Taxation">B.Voc. Accounting Taxation</option>
                                    <option value="B.Voc. Information Technology">B.Voc. Information Technology</option>
                                    <option value="B.S.W. Social Work">B.S.W. Social Work</option>
                                    <option value="B.Sc. Actuarial Mathematics Science">B.Sc. Actuarial Mathematics Science
                                    </option>
                                    <option value="B.Sc. Aviation">B.Sc. Aviation</option>
                                    <option value="B.Sc. Biotechnology">B.Sc. Biotechnology</option>
                                    <option value="B.Sc. Botany">B.Sc. Botany</option>
                                    <option value="B.Sc. Chemistry">B.Sc. Chemistry</option>
                                    <option value="B.Sc. Computer Science">B.Sc. Computer Science</option>
                                    <option value="B.Sc. Environmental Sciences">B.Sc. Environmental Sciences</option>
                                    <option value="B.Sc. Nutrition">B.Sc. Nutrition</option>
                                    <option value="B.Sc. Mathematics">B.Sc. Mathematics</option>
                                    <option value="B.Sc. Physics">B.Sc. Physics</option>
                                    <option value="B.Sc. Zoology">B.Sc. Zoology</option>
                                    <option value="B.C.A. Computer Applicaitons">B.C.A. Computer Applicaitons</option>
                                </select>
                                <label for="options">Select Department *</label>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="school1" id="floatingInput" placeholder="school Studied" required>
                                <label for="floatingInput">School Studied *</label>
                            </div>
                        </div>

                        <div class="col-lg-6 col-12">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="tenth" id="floatingInput" placeholder="10th Percentage" required>
                                <label for="floatingInput">10th Percentage *</label>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="school2" id="floatingInput" placeholder="school Studied" required>
                                <label for="floatingInput">School Studied *</label>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="twelveth" id="floatingInput" placeholder="12th Percentage" required>
                                <label for="floatingInput">12th Percentage *</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating is-invalid mb-3">
                                <input type="text" class="form-control" name="ug" id="floatingInput" placeholder="UG Percentage" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter Last Concluded Semester Percentage" required>
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
                        <div class="row">
                            <div class="col-6">
                                <button type="submit" class="btn btn-secondary col-12 mt-3" id="submitButton">Submit</button>
                            </div>
                            <div class="col-6">
                                <button type="reset" class="btn btn-secondary col-12 mt-3">Clear</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            </div>
        <?php
    }

        ?>
        </section>
        <!-- form -->

        <!-- libraries -->
        <script src="./Assets/js/jquery.min.js"></script>
        <script src="./Assets/js/bootstrap.min.js"></script>
        <script src="./Assets/js/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>


        <!-- script -->
        <script>
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
            document.getElementById('dob').addEventListener('change', function() {
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
</body>

</html>
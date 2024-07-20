<?php
session_start();

require_once 'connectdb.php';

@$idnum = $_SESSION["idnum"];

$sql = "SELECT * FROM stafflogin WHERE idnum='$idnum'";
$profile = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./Assets/css/style.css">
    <link rel="stylesheet" href="./Assets/css/bootstrap.min.css">
    <title>Training and Placement</title>
</head>

<body class="bg-secondary">
    <?php
    while ($row = mysqli_fetch_assoc($profile)) {

    ?>

        <section id="stform">
            <div class="container py-5 h-100 ">
                <div class="row justify-content-center align-items-center h-100">
                    <div class="col-12">
                        <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                            <div class="card-body p-4 p-md-5">
                                <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Staff details</h3>
                                <form method="post" action="staffdetailfill.php" enctype="multipart/form-data" class="">
                                    <div class="row">
                                        <div id="HelpBlock" class="form-text mb-3 text-end">
                                            *Photo Size Max 10MB
                                        </div>
                                        <div class="col-12">
                                            <center>
                                                <div class="mb-3 d-grid align-items-center bg-secondary-subtle border rounded" style="width: 200px; height: 250px;">
                                                    <h5 class="text-center" id="textPlaceholder1" style="display: block;">Upload Profile</h5>
                                                    <img src="" id="imagePreview1" class="img-fluid mb-3 border-0 rounded" style="width: 200px; height: 250px; object-fit: cover; display: none;" alt="">
                                                </div>
                                            </center>
                                            <div class="input-group mb-3">
                                                <input type="file" class="form-control" id="inputGroupFile02" name="user_photo1" accept="image/*" onchange="previewImage1(event)">
                                                <label class="input-group-text" for="inputGroupFile02">Photo Size Max 10MB</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" name="userid" id="floatingInput" placeholder="userid" value="<?php echo $row["userid"]; ?>" hidden>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" name="name" id="floatingInput" placeholder="Name" value="<?php echo $row["name"]; ?>" readonly>
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
                                                <input type="date" class="form-control" name="dob" id="dob" placeholder="Date of Birth" required>
                                                <label for="floatingInput">Date of Birth*</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating mb-3">
                                                <input type="number" class="form-control" name="age" id="ageInput" placeholder="Age" required>
                                                <label for="floatingInput">Age*</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating mb-3">
                                                <select class="form-control" name="stype" id="" required>
                                                    <option class="" value="<?php echo $row["stype"]; ?>" selected><?php echo $row["stype"]; ?></option>
                                                </select>
                                                <label for="floatingInput">Teaching or Non-Teaching</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating mb-3">
                                                <select class="form-control" name="role" id="" required>
                                                    <option class="" value="<?php echo $row["role"]; ?>" selected><?php echo $row["role"]; ?></option>
                                                </select>
                                                <label for="floatingInput">Role</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating mb-3">
                                                <select class="form-control" name="staff" id="" required>
                                                    <option class="" value="<?php echo $row["staff"]; ?>" selected><?php echo $row["staff"]; ?>   </option>
                                                </select>
                                                <label for="floatingInput">Aided / SF</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating mb-3">
                                                <select class="form-control" name="dept" id="" required>
                                                    <option class="" value="<?php echo $row["dept"]; ?>" selected><?php echo $row["dept"]; ?>   </option>
                                                </select>
                                                <label for="floatingInput">Department</label>
                                            </div>
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
                </div>
            </div>
        </section>
        <!-- form -->

    <?php
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
<?php
session_start();

require_once 'connectdb.php';

@$username = $_SESSION["username"];

$sql = "SELECT * FROM recruiterlogin WHERE username='$username'";
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

        <!-- form -->
        <section id="stform">
            <h3 class="text-center p-2 fw-bold mt-5 mb-5">HI <?php echo $row["username"]; ?></h3>
            <div class="container p-2 w-100 mb-5 rounded-4 bg-light shadow">
                <form method="post" action="recruiterfill.php" enctype="multipart/form-data" class="p-5">
                    <div class="row">
                        <div id="HelpBlock" class="form-text mb-3 text-end">
                            *Photo Size Max 10MB
                        </div>
                        <div class="col-lg-4 col-12">
                            <center>
                                <div class="mb-3 d-grid align-items-center bg-secondary-subtle border rounded" style="width: 200px; height: 250px;">
                                    <h5 class="text-center" id="textPlaceholder1" style="display: block;">Upload Profile</h5>
                                    <img src="" id="imagePreview1" class="img-fluid mb-3 border-0 rounded" style="width: 200px; height: 250px; object-fit: cover; display: none;" alt="">
                                </div>
                            </center>
                            <div class="input-group mb-3">
                                <input type="file" class="form-control" name="user_photo1" accept="image/*" onchange="previewImage1(event)">
                            </div>
                        </div>
                        <div class="col-lg-8 col-12">
                            <div class="mb-3 d-grid align-items-center bg-secondary-subtle border rounded" style="height: 250px;">
                                <h5 class="text-center" id="textPlaceholder2" style="display: block;">Upload Cover</h5>
                                <img src="" id="imagePreview2" class="img-fluid mb-3 border-0 rounded" style="width: 800px; height: 250px; object-fit: cover; display: none;" alt="">
                            </div>
                            <div class="input-group mb-3">
                                <input type="file" class="form-control" name="user_photo2" accept="image/*" onchange="previewImage2(event)">
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="userid" id="floatingInput" placeholder="userid" value="<?php echo $row["userid"]; ?>" readonly>
                                <label for="floatingInput">User ID*</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="username" id="floatingInput" placeholder="UserName" value="<?php echo $row["username"]; ?>" required>
                                <label for="floatingInput">User Name*</label>
                            </div>
                        </div>
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
                                <input type="text" class="form-control" name="cphone" id="floatingInput" placeholder="1234567890" value="<?php echo $row["cphone"]; ?>" required>
                                <label for="floatingInput">Company Phone Number *</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" placeholder="Address" id="floatingInput" name="caddress" required>
                                <label for="floatingInput">Company Address *</label>
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
                                <input type="text" class="form-control" name="pincode" id="floatingInput" placeholder="City" required>
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
                        <div class="col-12">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="hrname" id="floatingInput" placeholder="HR Name" required>
                                <label for="floatingInput">HR Name*</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" name="hremail" id="floatingInput" placeholder="HR Email Address" required>
                                <label for="floatingInput">HR Email Address*</label>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="hrphone" id="floatingInput" placeholder="HR Phone Number" required>
                                <label for="floatingInput">HR Phone Number*</label>
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



        const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
        const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl, {
            trigger: 'focus'
        }))
    </script>
</body>

</html>
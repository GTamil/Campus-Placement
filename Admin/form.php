<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Assets/css/style.css">
    <link rel="stylesheet" href="./Assets/css/bootstrap.min.css">
    <title>Staff Form</title>
</head>
<style>
    .card-registration .select-input.form-control[readonly]:not([disabled]) {
        font-size: 1rem;
        line-height: 2.15;
        padding-left: .75em;
        padding-right: .75em;
    }

    .card-registration .select-arrow {
        top: 13px;
    }
</style>

<body>
<div id="header">
    <?php include 'header.html';?>
    </div>
    <div class="container py-5 h-100 ">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-12 col-lg-9 col-xl-7">
                <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                    <div class="card-body p-4 p-md-5">
                        <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Staff Registration Form</h3>
                        <form method="post" action="staffregister.php" class="">

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <label class="form-label" for="name">Name</label>
                                        <input type="text" id="name" name="name" class="form-control form-control-lg" />
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <label class="form-label" for="idnumber">ID Number</label>
                                        <input type="text" id="idnum" name="idnum"
                                            class="form-control form-control-lg" />
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4 pb-2">
                                    <div class="form-outline">
                                        <label class="form-label" for="emailAddress">Email</label>
                                        <input type="email" id="emailAddress" name="email"
                                            class="form-control form-control-lg" />
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4 pb-2">
                                    <div class="form-outline">
                                        <label class="form-label" for="phoneNumber">Phone Number</label>
                                        <input type="text" id="phoneNumber" name="phone"
                                            class="form-control form-control-lg" />
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <!-- <div class="col-md-4 mb-4 d-flex align-items-center">
                                    <div class="form-outline datepicker w-100">
                                        <label for="birthdayDate" class="form-label">Birthday</label>
                                        <input type="date" class="form-control form-control-lg" id="birthdayDate"
                                            name="dob" />
                                    </div>
                                </div>
                                <div class="col-md-4 mb-4 d-flex align-items-center">
                                    <div class="form-outline datepicker w-100">
                                        <label for="Age" class="form-label">Age</label>
                                        <input type="number" class="form-control form-control-lg" id="age"
                                            name="age" />
                                    </div>
                                </div> -->
                                <div class="col-md-12 mb-4 align-self-center">
                                    <div class="form-outline">
                                        <label class="form-label" for="gender">Gender</label>
                                        <select class="form-control form-control-lg" name="gender" id="gender" required>
                                            <option class="" selected>Select Gender</option>
                                            <option class="" value="Male">Male</option>
                                            <option class="" value="Female">Female</option>
                                            <option class="" value="Other">Other</option>
                                            <!-- <option class="" value="Non-Applicable">Non-Applicable</option> -->
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <label class="col-form-label" for="stype">Teaching or Non-Teaching</label>
                                        <select class="form-control form-control-lg" name="stype" id="options"
                                            onchange="selectOption()" required>
                                            <option class="" selected>Select Teaching or Non-Teaching</option>
                                            <option class="Teaching" value="Teaching">Teaching</option>
                                            <option class="Non-Teaching" value="Non-Teaching">Non-Teaching</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <label class="form-label" for="role">Select Role</label>
                                        <select class="form-control form-control-lg" name="role" id="dynamicOptions"
                                            required>
                                            <option class="" selected>Select Role</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <label class="form-label" for="staff">Aided or SF</label>
                                        <select class="form-control form-control-lg" name="staff" id="options2"
                                            onchange="selectOption2()" required>
                                            <option class="" selected>Select Aided or Self Financed</option>
                                            <option class="" value="Aided">Aided</option>
                                            <option class="" value="Self Financed">Self Financed</option>
                                            <option class="" value="Selected Non-Teaching">Selected Non-Teaching
                                            </option>
                                            <!-- <option class="" value="Non-Applicable">Non-Applicable</option> -->
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <label class="form-label" for="staff">Department</label>
                                        <select class="form-control form-control-lg" name="dept" id="dynamicOptions2"
                                            required>
                                            <option class="" selected>Select Department</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-4">
                                    <div class="form-outline">
                                        <label class="form-label" for="password">Password</label>
                                        <input type="text" id="password" name="password" class="form-control form-control-lg" />
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4 pt-2">
                                <input class="btn btn-primary btn-lg" type="submit" value="Submit" />
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="./Assets/js/jquery.min.js"></script>
<script src="./Assets/js/bootstrap.min.js"></script>
<script src="./Assets/js/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
<script>
    // option 1
    function selectOption() {
        var selectedOption = $("#options").val();
        var dynamicOptions = $("#dynamicOptions");

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
        var selectedOption2 = $("#options2").val();
        var dynamicOptions2 = $("#dynamicOptions2");

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
            dynamicOptions2.append('<option value="M.Sc. Food Science and Nutrition">M.Sc. Food Science and Nutrition</option>');
            dynamicOptions2.append('<option value="M.Sc. Data Science">M.Sc. Data Science</option>');
            dynamicOptions2.append('<option value="M.Sc. Computer Science">M.Sc. Computer Science</option>');
            dynamicOptions2.append('<option value="M.Sc. Chemistry">M.Sc. Chemistry</option>');
            dynamicOptions2.append('<option value="M.Sc. Botany">M.Sc. Botany</option>');
            dynamicOptions2.append('<option value="M.Sc. Biotechnology">M.Sc. Biotechnology</option>');
            dynamicOptions2.append('<option value="M.Sc. Bioinformatics">M.Sc. Bioinformatics</option>');
            dynamicOptions2.append('<option value="M.Sc. Actuarial Science">M.Sc. Actuarial Science</option>');

            // Add more options as needed
        }
        else if (selectedOption2 === "Selected Non-Teaching") {
            dynamicOptions2.append('<option value="anotherSubOption1">Selected Non-Teaching</option>');
            dynamicOptions2.append('<option value="Non-Teaching Staff">Non-Teaching Staff</option>');
        }
    }
</script>

</html>
<?php
require_once 'connectdb.php';
@$rollno = $_SESSION["rollno"];

$sql = "SELECT * FROM studentlogin where rollno='$rollno'";
$profile = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./Assets/css/style.css">
  <link rel="stylesheet" href="./Assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
  <title>Application Form</title>
</head>

<body>
  <?php
  while ($row = mysqli_fetch_assoc($profile)) {
  ?>
    <div class="container">
      <form method="POST" class="w-100 rounded-1 m-3 p-4 border bg-white" action="jobappl.php" enctype="multipart/form-data">
        <!-- <input required name="userid" type="text" class="form-control" placeholder="" value="<?php echo $row["userid"];  ?>" hidden />
        <input required name="postid" type="text" class="form-control" placeholder="" value="<?php echo $row["postid"];  ?>" hidden />
        <span class="form-label d-block">Company name</span>
        <input required name="cname" type="text" class="form-control" placeholder="" value="<?php echo $row["cname"];  ?>" /> -->
        <span class="form-label d-block">Your name</span>
        <input required name="name" type="text" class="form-control" placeholder="Name"  value="<?php echo $row["name"];  ?>"/>
        <span class="form-label d-block mt-3">Roll Number</span>
        <input required name="rollno" type="text" class="form-control" placeholder="RollNumber" value="<?php echo $row["rollno"];  ?>" />
        <span class="form-label d-block mt-3">Phone Number</span>
        <input required name="phone" type="text" class="form-control" placeholder="Phone Number" value="<?php echo $row["phone"];  ?>" />
        <span class="form-label d-block mt-3">Email</span>
        <input required name="email" type="email" class="form-control" placeholder="Email ID" value="<?php echo $row["email"];  ?>" />
        <span class="form-label d-block mt-3">Select Course</span>
        <select class="form-select" id="options" name="course" onchange="selectOption()" required>
          <option class="form-control" selected><?php echo $row["course"]; ?></option>
          <!-- <option value="UG">UG</option>
          <option value="PG">PG</option> -->
        </select>
        <span class="form-label d-block mt-3">Select Department</span>
        <select class="form-select" name="dept" id="dynamicOptions" required>
          <option class="form-control" selected><?php echo $row["dept"];?></option>
        </select>
        <span class="form-label d-block mt-3">Semester Percentage</span>
        <input required name="per" type="text" class="form-control" placeholder="Enter the Percentage Till Concluded Semester" />
        <span class="form-label d-block mt-3">Your CV</span>
        <input required name="user_file1" type="file" class="form-control" />
        <div class="d-flex gap-3">
          <button type="submit" class="btn btn-dark w-50 mt-3 rounded-3">Submit</button>
        <button type="reset" class="btn btn-dark w-50 mt-3 rounded-3">Clear</button>
      </div>
        
      <?php
    }
      ?>
      </form>
    </div>

    <!-- libraries -->
    <script src="./Assets/js/jquery.min.js"></script>
    <script src="./Assets/js/bootstrap.min.js"></script>
    <script src="./Assets/js/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>

    <script>
    </script>

</body>

</html>
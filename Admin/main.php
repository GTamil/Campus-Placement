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
  <title>Admin Dashboard</title>
</head>

<body>
  <section id="header">
    <?php include 'header.html'; ?>
  </section>

  <!-- Cards -->
  <div class="container mt-5 mb-5">
    <h1>Job Post</h1>

    <!-- Recruiter Post -->
    <?php
    $sql = "SELECT * FROM recruiterpost";
    $recruiterpost = $conn->query($sql);
    $postCount = $recruiterpost->num_rows; // Count of job applications for the user
    ?>
    <div class="card bg-body-tertiary">
      <div class="card-header">
        <div class="card-title">Job Post by Recruiters</div>
      </div>
      <div class="card-content p-4">
        <div class="row justify-content-center">
          <?php
          // Check if there are rows returned
          if ($recruiterpost && $recruiterpost->num_rows > 0) {
            // Data exists, display the information
            // Display your data here using a loop or fetching individual rows
            $rowCounter = 0;
            while ($row = mysqli_fetch_assoc($recruiterpost)) {
              // Display data from $row
              // Example: echo $row['column_name'];
              $rowCounter++;
          ?>
              <div class="col-md-6 mb-4">
                <div class="card mt-2">
                  <div class="card-header">
                    <div class="card-subtitle">
                      <h4><?php echo $row['cname']; ?></h4>
                    </div>
                    <div class="card-category"><b>Job Title: </b><?php echo $row['title']; ?></div>
                  </div>
                  <div class="card-content p-3">
                    <caption><b>Job Description</b></caption>
                    <p><small><?php echo substr($row["description"], 0, 150); ?>...</small></p>
                  </div>
                </div>
              </div>
          <?php
              // Break the loop if 5 rows are reached
              if ($rowCounter >= 5) {
                break;
              }
            }
          } else {
            // No data exists, redirect to another page
            echo "No data exists";
          }
          ?>
        </div>
      </div>
      <div class="card-footer">
        <caption>Total Posts: <?php echo $postCount; ?></caption>
        <a href="./recruitertable.php" class="btn btn-outline-dark float-end">View Full List</a>
      </div>
    </div>
  </div>


  <!-- Tables -->
  <div id="table" class="container mt-5 mb-5">
    <h1>Tables of Users</h1>

    <!-- row1 -->
    <div class="row">
      <!-- Staff -->
      <?php
      $sql = "SELECT * FROM stafflogin";
      $staffprofile = $conn->query($sql);
      $userCount = $staffprofile->num_rows; // Count of job applications for the user
      // Check if there are rows returned
      if ($staffprofile && $staffprofile->num_rows > 0) {
        // Data exists, display the information
      ?>
        <div class="col-md-6">
          <div class="card mt-3">
            <div class="card-header">
              <p class="card-subtitle text-start">Staff Table</p>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-head-bg-success table-striped table-hover text-center align-middle" style="font-size: small;">
                  <thead>
                    <tr>
                      <th scope="col">S.No</th>
                      <th scope="col">Name</th>
                      <th scope="col">ID Number</th>
                      <th scope="col">Aided or Sf</th>
                      <th scope="col">Department</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <?php
                      // Display your data here using a loop or fetching individual rows
                      $rowCounter = 0;
                      while ($row = mysqli_fetch_assoc($staffprofile)) {
                        // Display data from $row
                        // Example: echo $row['column_name'];
                        $rowCounter++;
                      ?>
                        <td><?php echo $rowCounter; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['idnum']; ?></td>
                        <td><?php echo $row['staff']; ?></td>
                        <td><?php echo $row['dept']; ?></td>

                    </tr>
                  <?php
                        // Break the loop if 5 rows are reached
                        if ($rowCounter >= 3) {
                          break;
                        }
                      }
                    } else {
                      // No data exists, display a message
                  ?>
                  <p>No data available</p>
                <?php
                    }
                ?>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="card-footer">
              <caption>Number of Staff: <?php echo $userCount; ?></caption>
              <a href="./stafftable.php" class="btn btn-outline-dark float-end">View Full List</a>
            </div>
          </div>
        </div>

        <!-- Recruiter -->

        <?php
        $sql = "SELECT * FROM recruiterform";
        $recruiterprofile = $conn->query($sql);
        $userCount = $recruiterprofile->num_rows; // Count of job applications for the user
        // Check if there are rows returned
        if ($recruiterprofile && $recruiterprofile->num_rows > 0) {
          // Data exists, display the information
        ?>
          <div class="col-md-6">
            <div class="card mt-3">
              <div class="card-header">
                <p class="card-subtitle text-start">Recruiter Table</p>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-head-bg-success table-striped table-hover text-center align-middle" style="font-size: small;">
                    <thead>
                      <tr>
                        <th scope="col">S.NO</th>
                        <th scope="col">Company Name</th>
                        <th scope="col">Company Location</th>
                        <th scope="col">HR Name</th>
                        <th scope="col">HR Contact</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <?php
                        // Display your data here using a loop or fetching individual rows
                        $rowCounter = 0;
                        while ($row = mysqli_fetch_assoc($recruiterprofile)) {
                          // Display data from $row
                          // Example: echo $row['column_name'];
                          $rowCounter++;
                        ?>
                          <td><?php echo $rowCounter; ?></td>
                          <td><?php echo $row['cname']; ?></td>
                          <td><?php echo $row['city']; ?></td>
                          <td><?php echo $row['hrname']; ?></td>
                          <td><?php echo $row['hrphone']; ?></td>
                      </tr>
                  <?php
                          // Break the loop if 5 rows are reached
                          if ($rowCounter >= 3) {
                            break;
                          }
                        }
                      } else {
                        // No data exists, redirect to another page
                        echo "No data exists";
                      }
                  ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="card-footer">
                <caption>Number of Recruiter: <?php echo $userCount; ?></caption>
                <a href="./recruitertable.php" class="btn btn-outline-dark float-end">View Full List</a>
              </div>
            </div>
          </div>
    </div>

    <!-- Row2 -->
    <div class="row">
      <!-- Ug Student -->
      <?php
      $sql = "SELECT * FROM studentugform";
      $ugprofile = $conn->query($sql);
      $userCount = $ugprofile->num_rows; // Count of job applications for the user
      // Check if there are rows returned
      if ($ugprofile && $ugprofile->num_rows > 0) {
        // Data exists, display the information
      ?>
        <div class="col-md-6">
          <div class="card mt-3">
            <div class="card-header">
              <p class="card-subtitle text-start">UG Student Table</p>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-head-bg-success table-striped table-hover text-center align-middle" style="font-size: small;">
                  <thead>
                    <tr>
                      <th scope="col">S.No</th>
                      <th scope="col">Name</th>
                      <th scope="col">Roll Number</th>
                      <th scope="col">Department</th>
                      <th scope="col">Contact</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <?php
                      // Display your data here using a loop or fetching individual rows
                      $rowCounter = 0;
                      while ($row = mysqli_fetch_assoc($ugprofile)) {
                        // Display data from $row
                        // Example: echo $row['column_name'];
                        $rowCounter++;
                      ?>
                        <td><?php echo $rowCounter; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['rollno']; ?></td>
                        <td><?php echo $row['dept']; ?></td>
                        <td><?php echo $row['phone']; ?></td>
                    </tr>
                <?php
                        // Break the loop if 5 rows are reached
                        if ($rowCounter >= 3) {
                          break;
                        }
                      }
                    } else {
                      // No data exists, redirect to another page
                      echo "No data exists";
                    }
                ?>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="card-footer">
              <caption>Number of UG Students: <?php echo $userCount; ?></caption>
              <a href="./ugstudenttable.php" class="btn btn-outline-dark float-end">View Full List</a>
            </div>
          </div>
        </div>

        <!-- PG Student -->
        <?php
        $sql = "SELECT * FROM studentpgform";
        $pgprofile = $conn->query($sql);
        $userCount = $pgprofile->num_rows; // Count of job applications for the user
        // Check if there are rows returned
        if ($pgprofile && $pgprofile->num_rows > 0) {
          // Data exists, display the information
        ?>
          <div class="col-md-6">
            <div class="card mt-3">
              <div class="card-header">
                <p class="card-subtitle text-start">PG Student Table </p>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-head-bg-success table-striped table-hover text-center align-middle" style="font-size: small;">
                    <thead>
                      <tr>
                        <th scope="col">S.No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Roll Number</th>
                        <th scope="col">Department</th>
                        <th scope="col">Contact</th>
                      </tr>
                    </thead>
                    <tbody>

                      <tr>
                        <?php
                        // Display your data here using a loop or fetching individual rows
                        $rowCounter = 0;
                        while ($row = mysqli_fetch_assoc($pgprofile)) {
                          // Display data from $row
                          // Example: echo $row['column_name'];
                          $rowCounter++;
                        ?>
                          <td><?php echo $rowCounter; ?></td>
                          <td><?php echo $row['name']; ?></td>
                          <td><?php echo $row['rollno']; ?></td>
                          <td><?php echo $row['dept']; ?></td>
                          <td><?php echo $row['phone']; ?></td>
                      </tr>
                  <?php
                          // Break the loop if 5 rows are reached
                          if ($rowCounter >= 3) {
                            break;
                          }
                        }
                      } else {
                        // No data exists, redirect to another page
                        echo "No data exists";
                      }
                  ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="card-footer">
                <caption>Number of PG Students: <?php echo $userCount; ?></caption>
                <a href="./pgstudenttable.php" class="btn btn-outline-dark float-end">View Full List</a>
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

</html>
<?php
// Include your database connection file here
require_once 'connectdb.php';

// Get the selected table name from the AJAX request
$tableName = $_GET['table'];

// Construct SQL query based on the selected table
$sql = "";
$tableHeader = "";
if ($tableName === "recruiterform") {
    $sql = "SELECT * FROM recruiterform LIMIT 5";
    $tableHeader = "<tr><th>S.NO</th><th>Company Name</th><th>Company Location</th><th>HR Name</th><th>HR Contact</th></tr>";
    $viewFullLink = "recruitertable.php";
} elseif ($tableName === "studentugform") {
    $sql = "SELECT * FROM studentugform LIMIT 5";
    $tableHeader = "<tr><th>S.No</th><th>Name</th><th>Roll Number</th><th>Department</th><th>Contact</th></tr>";
    $viewFullLink = "ugstudenttable.php";
} elseif ($tableName === "studentpgform") {
    $sql = "SELECT * FROM studentpgform LIMIT 5";
    $tableHeader = "<tr><th>S.No</th><th>Name</th><th>Roll Number</th><th>Department</th><th>Contact</th></tr>";
    $viewFullLink = "pgstudenttable.php";
}

// Execute the SQL query
$result = $conn->query($sql);

// Get the count of users
$userCount = $result->num_rows;

// Generate HTML table based on query result
if ($result && $result->num_rows > 0) {
    echo "<div class='table-responsive'>";
    echo "<table class='table table-head-bg-success table-striped table-hover text-center align-middle' style='font-size: small;'>";
    echo "<thead>" . $tableHeader . "</thead>";
    echo "<tbody>";
    $rowCounter = 0;
    while ($row = $result->fetch_assoc()) {
        $rowCounter++;
        echo "<tr>";
        echo "<td>" . $rowCounter . "</td>";
        // Output other table data here based on table structure
        if ($tableName === "recruiterform") {
            echo "<td>" . $row['cname'] . "</td>";
            echo "<td>" . $row['city'] . "</td>";
            echo "<td>" . $row['hrname'] . "</td>";
            echo "<td>" . $row['hrphone'] . "</td>";
        } elseif ($tableName === "studentugform" || $tableName === "studentpgform") {
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['rollno'] . "</td>";
            echo "<td>" . $row['dept'] . "</td>";
            echo "<td>" . $row['phone'] . "</td>";
        }
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";

    // Display the user count
    echo "<p>User count: " . $userCount . " <a href='" . $viewFullLink . "' class='text-decoration-none btn btn-sm btn-secondary mx-2'>View Full List</a></p>";

    // // Display link for viewing full details
    // echo "<caption><a href='" . $viewFullLink . "' class=''>View Full Details</a></caption>";

    echo "</div>";
} else {
    echo "<p>No data found</p>";
}

// Close database connection
$conn->close();
?>

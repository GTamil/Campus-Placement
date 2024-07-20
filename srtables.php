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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./Assets/css/style.css">
    <link rel="stylesheet" href="./Assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Student Recruiter Data</title>
</head>

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
                                    <a href="staffprofile.php" class="nav-link text-dark navbar-nav" type="button"><i class="bi bi-person-circle my-1"></i><b class="mx-2"><?php echo $row["name"]; ?></b></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-dark" href="index.html" onclick="return confirm('Do You Want To Logout..?')">Logout</a>
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


    <!-- banner -->
    <section id="banner">
        <div class="image-container" style="min-height: 450px;">
            <img src="./Img/Banner 3.jpg" class="img-fluid bg-dark w-100 h-100 mb-5" style="object-fit: cover;" alt="...">
        </div>
    </section>
    <!-- banner -->

    <!-- Cards -->
    <section id="details" class="mt-5">
    <div class="container mt-5 mb-5">
    <!-- Tables Dropdown -->
    <div class="container mt-5 mb-5">
        <h1>Tables of Users</h1>
        <select id="tableSelect" class="form-select mt-3 mb-3" onchange="displayTable()">
            <option value="recruiterform">Recruiter Table</option>
            <option value="studentugform">UG Student Table</option>
            <option value="studentpgform">PG Student Table</option>
        </select>
    </div>

    <!-- Display Table -->
    <div id="tableDisplay"></div>
</div>

<script>
    function displayTable() {
        var tableSelect = document.getElementById("tableSelect");
        var selectedTable = tableSelect.value;

        // Fetch data based on the selected table
        fetchTable(selectedTable);
    }

    function fetchTable(tableName) {
        fetch('./displaytable.php?table=' + tableName)
            .then(response => response.text())
            .then(data => {
                document.getElementById("tableDisplay").innerHTML = data;
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    // Initial table display
    displayTable();
</script>
    </section>

</body>


<script src="./Assets/js/jquery.min.js"></script>
<script src="./Assets/js/bootstrap.min.js"></script>
<script src="./Assets/js/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>

</html>
<?php

ob_start();
session_start();

if ($_SESSION['name'] != 'oasis') {
    header('location: login.php');
    exit(); // Ensure no further code is executed after the redirect
}

include('connect.php'); // Make sure connect.php uses mysqli

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Online Attendance Management System 1.0</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<header>
    <h1>Online Attendance Management System 1.0</h1>
    <div class="navbar">
        <a href="index.php">Home</a>
        <a href="students.php">Students</a>
        <a href="teachers.php">Faculties</a>
        <a href="attendance.php">Attendance</a>
        <a href="report.php">Report</a>
        <a href="../logout.php">Logout</a>
    </div>
</header>

<center>
<div class="row">
    <div class="content">
        <h3>Student List</h3>
        <br>
        <form method="post" action="">
            <label>Batch (ex. 2020)</label>
            <input type="text" name="sr_batch">
            <input type="submit" name="sr_btn" value="Go!">
        </form>
        <br>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Registration No.</th>
                    <th scope="col">Name</th>
                    <th scope="col">Department</th>
                    <th scope="col">Batch</th>
                    <th scope="col">Semester</th>
                    <th scope="col">Email</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($_POST['sr_btn'])) {
                    $srbatch = $_POST['sr_batch'];

                    // Use prepared statements to avoid SQL injection
                    $stmt = $conn->prepare("SELECT * FROM students WHERE st_batch = ? ORDER BY st_id ASC");
                    $stmt->bind_param("s", $srbatch);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    while ($data = $result->fetch_assoc()) {
                ?>
                    <tr>
                        <td><?php echo htmlspecialchars($data['st_id']); ?></td>
                        <td><?php echo htmlspecialchars($data['st_name']); ?></td>
                        <td><?php echo htmlspecialchars($data['st_dept']); ?></td>
                        <td><?php echo htmlspecialchars($data['st_batch']); ?></td>
                        <td><?php echo htmlspecialchars($data['st_sem']); ?></td>
                        <td><?php echo htmlspecialchars($data['st_email']); ?></td>
                    </tr>
                <?php
                    }
                    $stmt->close(); // Close the statement
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
</center>

</body>
</html>

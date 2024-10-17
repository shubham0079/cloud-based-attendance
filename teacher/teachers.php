<?php

ob_start();
session_start();

if ($_SESSION['name'] != 'oasis') {
    header('location: login.php');
    exit(); // Ensure no further code is executed after the redirect
}

include('connect.php'); // Make sure this file uses mysqli

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
        <h3>Teacher List</h3>
        
        <table class="table table-striped">
            <thead>  
                <tr>
                    <th scope="col">Teacher ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Department</th>
                    <th scope="col">Email</th>
                    <th scope="col">Course</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Use mysqli to fetch data
                $tcr_query = $conn->query("SELECT * FROM teachers ORDER BY tc_id ASC");

                while ($tcr_data = $tcr_query->fetch_assoc()) {
                ?>
                    <tr>
                        <td><?php echo htmlspecialchars($tcr_data['tc_id']); ?></td>
                        <td><?php echo htmlspecialchars($tcr_data['tc_name']); ?></td>
                        <td><?php echo htmlspecialchars($tcr_data['tc_dept']); ?></td>
                        <td><?php echo htmlspecialchars($tcr_data['tc_email']); ?></td>
                        <td><?php echo htmlspecialchars($tcr_data['tc_course']); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

</center>

</body>
</html>

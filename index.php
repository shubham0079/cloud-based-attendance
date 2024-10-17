<?php

if (isset($_POST['login'])) {
    try {
        // Checking empty fields
        if (empty($_POST['username'])) {
            throw new Exception("Username is required!");
        }
        if (empty($_POST['password'])) {
            throw new Exception("Password is required!");
        }

        // Establishing connection with db
        include('connect.php');

        // Preparing and executing the login query
        $stmt = $conn->prepare("SELECT * FROM admininfo WHERE username = ? AND password = ? AND type = ?");
        $stmt->bind_param("sss", $_POST['username'], $_POST['password'], $_POST['type']);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            session_start();
            $_SESSION['name'] = "oasis";

            // Redirecting based on user type
            if ($_POST["type"] == 'teacher') {
                header('location: teacher/index.php');
            } elseif ($_POST["type"] == 'student') {
                header('location: student/index.php');
            } elseif ($_POST["type"] == 'admin') {
                header('location: admin/index.php');
            }
            exit(); // Make sure to exit after header redirection
        } else {
            throw new Exception("Username, Password, or Role is wrong, try again!");
        }
    } catch (Exception $e) {
        $error_msg = $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Online Attendance Management System</title>
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
    <style>
        body {
    background-color: #f4f4f4;
    font-family: Arial, sans-serif;
}

header {
    background-color: #007bff;
    color: white;
    padding: 10px 0;
    margin-bottom: 20px;
}

h1 {
    margin: 20px 0;
}

.content {
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
}

.form-horizontal {
    margin-top: 20px;
}

.form-group {
    margin-bottom: 15px;
}

.control-label {
    font-weight: bold;
}

.alert {
    margin: 20px 0;
}

.btn-primary {
    background-color: #007bff;
    border-color: #007bff;
}

.btn-primary:hover {
    background-color: #0056b3;
    border-color: #0056b3;
}

footer {
    margin-top: 20px;
}

    </style>
</head>

<body>
<center>

<header>
    <h1>Online Attendance Management System 1.0</h1>
</header>

<h1>Login</h1>

<?php
// Printing error message
if (isset($error_msg)) {
    echo "<div class='alert alert-danger'>$error_msg</div>";
}
?>

<div class="content">
    <div class="row">
        <form method="post" class="form-horizontal col-md-6 col-md-offset-3">
            <div class="form-group">
                <label for="input1" class="col-sm-3 control-label">Username</label>
                <div class="col-sm-7">
                    <input type="text" name="username" class="form-control" id="input1" placeholder="your username" required />
                </div>
            </div>

            <div class="form-group">
                <label for="input2" class="col-sm-3 control-label">Password</label>
                <div class="col-sm-7">
                    <input type="password" name="password" class="form-control" id="input2" placeholder="your password" required />
                </div>
            </div>

            <div class="form-group">
                <label for="input3" class="col-sm-3 control-label">Role</label>
                <div class="col-sm-7">
                    <label><input type="radio" name="type" value="student" checked> Student</label>
                    <label><input type="radio" name="type" value="teacher"> Teacher</label>
                    <label><input type="radio" name="type" value="admin"> Admin</label>
                </div>
            </div>

            <input type="submit" class="btn btn-primary col-md-3 col-md-offset-7" value="Login" name="login" />
        </form>
    </div>
</div>

<br><br>
<p><strong>Have you forgotten your password? <a href="reset.php">Reset here.</a></strong></p>
<p><strong>If you don't have an account, <a href="signup.php">Signup</a> here</strong></p>

</center>
</body>
</html>

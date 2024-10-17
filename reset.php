<?php
include('connect.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Online Attendance Management System 1.0</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<header>
    <h1>Online Attendance Management System 1.0</h1>
    <div class="navbar">
        <a href="index.php">Login</a>
    </div>
</header>

<center>
<div class="content">
    <div class="row">
        <form method="post" class="form-horizontal col-md-6 col-md-offset-3">
            <h3>Recover your password</h3>
            <div class="form-group">
                <label for="input1" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" name="email" class="form-control" id="input1" placeholder="your email" required />
                </div>
            </div>
            <input type="submit" class="btn btn-primary col-md-2 col-md-offset-10" value="Go" name="reset" />
        </form>
        <br>

        <?php
        if (isset($_POST['reset'])) {
            $email = $_POST['email'];
            $query = $conn->prepare("SELECT password FROM admininfo WHERE email = ?");
            $query->bind_param("s", $email);
            $query->execute();
            $result = $query->get_result();

            if ($result->num_rows == 0) {
                echo '<div class="content"><p>Email is not associated with any account. Contact OAMS 1.0</p></div>';
            } else {
                $dat = $result->fetch_assoc();
                echo '<strong><p style="text-align: left;">Hi there!<br>You requested for a password recovery. You may <a href="index.php">Login here</a> and enter this key as your password to login. Recovery key: <mark>' . htmlspecialchars($dat['password']) . '</mark><br>Regards,<br>Online Attendance Management System 1.0</p></strong>';
            }
        }
        ?>

    </div>
</div>

</center>

</body>
</html>

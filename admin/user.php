<?php
//require_once("includes/sessions.php");
//confirm_logged_in();
require_once("includes/connection.php");
require_once("includes/functions.php");
if (isset($_POST['submit'])) { //Form has been submitted.
    $errors = array();

    //perform validation in the form data
    $required_fields = array('username', 'password');
    $errors = array_merge($errors, check_required_fields($required_fields, $_POST));

    $fields_with_lengths = array('username' => 30, 'password' => 30);
    $errors = array_merge($errors, check_max_field_lengths($fields_with_lengths, $_POST));

    $username = trim(mysqli_real_escape_string($mysqli, $_POST['username']));
    $password = trim(mysqli_real_escape_string($mysqli, $_POST['password']));
    $hashed_password = sha1($password);

    if (empty($errors)) {
        $query = "INSERT INTO admin (username, hashed_password) VALUES(?,?)";
        $stmt = mysqli_stmt_init($mysqli);
        if (!mysqli_stmt_prepare($stmt, $query)) {
            echo "SQL Insert Error";
        } else {
            mysqli_stmt_bind_param($stmt, "ss", $username, $hashed_password);
            $result = mysqli_stmt_execute($stmt);
            // $result = $mysqli->query($query) or die($mysqli->error);
            if ($result) {
                //$message = "The user was successfully created.";
                echo "<script>alert(' User Created Successfully ')</script>";
            } else {
                echo "<script>alert('error creating user')</script>";
                //$message = "The user could not be successfully created.";
                //$message = "<br />". mysql_error();
            }
        }
    } else {
        if (count($errors) == 1) {
            echo "<script>alert('There was 1 error in the form.')</script>";
            // $message = "There was 1 error in the form.";
        } else {
            echo "<script>alert('There were " . count($errors) . "errors in the form.')</script>";
            //$message = "There were " . count($errors) . "errors in the form.";
        }
    }
} else { //Form has notbeen submitted.
    $username = "";
    $password = "";
    //echo "Form has not been submitted.";
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>New User</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/libs/css/style.css">
    <link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <style>
        html,
        body {
            height: 100%;
        }

        body {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: center;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
        }
    </style>
</head>

<body>
    <!-- ============================================================== -->
    <!-- login page  -->
    <!-- ============================================================== -->
    <div class="splash-container">
        <div class="card ">
            <div class="card-header text-center"><a href="../index.php"><img class="logo-img" src="../cf5.png" alt="logo"></a><span class="splash-description">Please enter your user information.</span></div>
            <div class="card-body">
                <form action="user.php" method="post">
                    <div class="form-group">
                        <input class="form-control form-control-lg" id="username" type="text" placeholder="Username" autocomplete="off" name="username">
                    </div>
                    <div class="form-group">
                        <input class="form-control form-control-lg" id="password" type="password" placeholder="Password" name="password">
                    </div>
                    <div class="form-group">
                        <label class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox"><span class="custom-control-label">Remember Me</span>
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg btn-block" name="submit" id="submit">Register</button>
                </form>
            </div>
            <div class="card-footer bg-white p-0  ">
                <div class="card-footer-item card-footer-item-bordered">
                    <a href="#" class="footer-link">Create An Account</a></div>
                <div class="card-footer-item card-footer-item-bordered">
                    <a href="#" class="footer-link">Forgot Password</a>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- end login page  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
</body>

</html>
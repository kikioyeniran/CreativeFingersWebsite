<?php require_once("includes/sessions.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>

<?php
if (logged_in()) {
    redirect_to("about.php");
}
?>

<?php
if (isset($_POST['submit'])) { //Form has been submitted.
    $errors = array();

    //perform validation in the form data
    $required_fields = array('username', 'password');
    $errors = array_merge($errors, check_required_fields($required_fields, $_POST));

    $fields_with_lengths = array('username' => 30, 'password' => 30);
    $errors = array_merge($errors, check_max_field_lengths($fields_with_lengths, $_POST));

    $username = trim(mysql_prep($_POST['username']));
    $password = trim(mysql_prep($_POST['password']));
    $hashed_password = sha1($password);

    if (empty($errors)) {
        // $query = "SELECT id, username FROM admin ";
        // $query .= "WHERE username = '{$username}' ";
        // $query .= "AND hashed_password = '{$hashed_password}' ";
        //Create template
        $query = "SELECT id, username FROM admin WHERE username = ? AND hashed_password = ?";
        //create prepared statement
        $stmt = mysqli_stmt_init($mysqli);
        //Prepare prepared Statement
        if (!mysqli_stmt_prepare($stmt, $query)) {
            echo "SQL statement failed";
        } else {
            //Bind Parameters to the placeholders
            mysqli_stmt_bind_param($stmt, "ss", $username, $hashed_password);
            // Run parameters inside database
            mysqli_stmt_execute($stmt);
            $result_set = mysqli_stmt_get_result($stmt);
            confirm_query($result_set);
            if (mysqli_num_rows($result_set) == 1) {
                //username and password authenticated
                // and only 1 match
                //$found_user = mysql_fetch_array($result_set);
                $found_user = $result_set->fetch_assoc();
                $_SESSION['user_id']  = $found_user['id'];
                $_SESSION['username']  = $found_user['username'];
                redirect_to("about.php");
            } else {

                $message = "Username/password combination incorrect. <br />
                        Make sure your caps lock key is off and try again.";
            }
        }
        // $result_set = $mysqli->query($query);

    }
} else { //Form has notbeen submitted.
    $message = " ";
    if (isset($_GET['logout']) && $_GET['logout'] == 1) {
        $message = "You are now logged out.";
    }
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
    <title>Login</title>
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
            <div class="card-header text-center"><a href="#"><img class="logo-img" src="../cf5.png" alt="logo"></a><span class="splash-description">Please enter your user information.</span></div>
            <div class="card-body">
                <form action="login.php" method="post">
                    <div class="form-group">
                        <input class="form-control form-control-lg" id="username" type="text" placeholder="Username" autocomplete="off" name="username">
                    </div>
                    <div class="form-group">
                        <input class="form-control form-control-lg" id="password" type="password" placeholder="Password" name="password">
                    </div>
                    <div class="form-group">
                        <label class="custom-control">
                            <p><span class="custom-control-label"><?php echo $message; ?></span></p>
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg btn-block" name="submit" id="submit">Sign in</button>
                </form>
            </div>
            <div class="card-footer bg-white p-0  ">
                <div class="card-footer-item card-footer-item-bordered">
                    <a href="../index.php" class="footer-link">Public Page</a></div>
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
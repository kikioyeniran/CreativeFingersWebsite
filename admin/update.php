<?php require_once("includes/sessions.php"); ?>
<?php confirm_logged_in(); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php
if (isset($_GET["pic"])) {
    $target = "images/" . basename($_FILES['image']['name']);
    $errors = array();
    $required_fields = array('artist', 'category', 'description', 'measurement');
    foreach ($required_fields as $fieldname) {
        //var_dump($_POST[$fieldname]);
        if (!isset($_POST[$fieldname]) || (empty($_POST[$fieldname]))) {
            $errors[] = $fieldname;
        }
    }
    if (empty($errors)) {
        $id = mysqli_real_escape_string($mysqli, $_GET['pic']);
        $artist = mysqli_real_escape_string($mysqli, $_POST['artist']);
        $category = mysqli_real_escape_string($mysqli, $_POST['category']);
        $description = mysqli_real_escape_string($mysqli, $_POST['description']);
        $measurement = mysqli_real_escape_string($mysqli, $_POST['measurement']);
        $image = $_FILES['image']['name'];
        if (empty($image)) {
            $stmt = $mysqli->prepare("UPDATE pictures SET artist = ?, category = ?, description = ?, measurement = ? WHERE id = ? ");
            $stmt->bind_param("ssssi", $artist, $category, $description, $measurement, $id);
        } else {
            $info = getimagesize($_FILES["image"]["tmp_name"]);
            $allowed_types = array(IMG_GIF, IMG_JPEG, IMG_PNG);
            $show2 = "<h1>Invalid Image Type Selected. <a href='edit.php?pic=$id' class='btn btn-primary btn-lg btn-block'>Go Back</a></h1>";
            if (!in_array($info[2], $allowed_types)) exit($show2);
            $stmt = $mysqli->prepare("UPDATE pictures SET artist = ?, category = ?, description = ?, measurement = ?, picture = ? WHERE id = ? ");
            $stmt->bind_param("sssssi", $artist, $category, $description, $measurement, $image, $id);
        }
        if ($stmt->execute()) {
            if (mysqli_affected_rows($mysqli) == 1 || move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                // $stmt->close();
                redirect_to("pictures.php");
                echo "<script>alert(\"Update Successful\")<script>";
            } else {
                echo "<script>alert(\"The update failed\")<script>";
            }
        } else {
            echo "<script>alert('Info not inserted into the database')</script>";
        }
    } else {
        echo "there r errors";
        var_dump($errors);
    }
}

if (isset($_POST["update"])) {
    $target = "images/" . basename($_FILES['image']['name']);
    $errors = array();
    $required_fields = array('details');
    foreach ($required_fields as $fieldname) {
        if (!isset($_POST[$fieldname]) || (empty($_POST[$fieldname]))) {
            $errors[] = $fieldname;
        }
    }
    if (empty($errors)) {
        $id = 1;
        $details = mysqli_real_escape_string($mysqli, $_POST['details']);
        $image = $_FILES['image']['name'];
        if (empty($image)) {
            $stmt = $mysqli->prepare("UPDATE about SET details = ? WHERE id = ? ");
            $stmt->bind_param("si", $details, $id);
        } else {
            $info = getimagesize($_FILES["image"]["tmp_name"]);
            $allowed_types = array(IMG_GIF, IMG_JPEG, IMG_PNG);
            $show2 = "<h1>Invalid Image Type Selected. <a href='about.php' class='btn btn-primary btn-lg btn-block'>Go Back</a></h1>";
            if (!in_array($info[2], $allowed_types)) exit($show2);
            $stmt = $mysqli->prepare("UPDATE about SET details = ?, picture = ? WHERE id = ? ");
            $stmt->bind_param("ssi", $details, $image, $id);
        }
        if ($stmt->execute()) {
            if (mysqli_affected_rows($mysqli) == 1 && move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                // $stmt->close();
                redirect_to("about.php");
                echo "<script>alert(\"Update Successful\")<script>";
            } else {
                echo "<script>alert(\"The update failed\")<script>";
            }
        } else {
            echo "<script>alert('Info not inserted into the database')</script>";
        }
    } else {
        echo "there r errors";
        var_dump($errors);
    }
}

if (isset($_GET["prof"])) {
    $target = "images/" . basename($_FILES['image']['name']);
    $errors = array();
    $required_fields = array('artist', 'description');
    foreach ($required_fields as $fieldname) {
        //var_dump($_POST[$fieldname]);
        if (!isset($_POST[$fieldname]) || (empty($_POST[$fieldname]))) {
            $errors[] = $fieldname;
        }
    }
    if (empty($errors)) {
        $id = mysqli_real_escape_string($mysqli, $_GET['prof']);
        $artist = mysqli_real_escape_string($mysqli, $_POST['artist']);
        $description = mysqli_real_escape_string($mysqli, $_POST['description']);
        $image = $_FILES['image']['name'];
        if (empty($image)) {
            $stmt = $mysqli->prepare("UPDATE profiles SET name = ?, description = ? WHERE id = ? ");
            $stmt->bind_param("ssi", $artist, $description, $id);
        } else {
            $info = getimagesize($_FILES["image"]["tmp_name"]);
            $allowed_types = array(IMG_GIF, IMG_JPEG, IMG_PNG);
            $show2 = "<h1>Invalid Image Type Selected. <a href='edit.php?prof=$id' class='btn btn-primary btn-lg btn-block'>Go Back</a></h1>";
            if (!in_array($info[2], $allowed_types)) exit($show2);
            $stmt = $mysqli->prepare("UPDATE pictures SET name = ?, description = ?, picture = ? WHERE id = ? ");
            $stmt->bind_param("sssi", $artist, $description, $image, $id);
        }
        if ($stmt->execute()) {
            if (mysqli_affected_rows($mysqli) == 1 || move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                // $stmt->close();
                redirect_to("profiles.php");
                echo "<script>alert(\"Update Successful\")<script>";
            } else {
                echo "<script>alert(\"The update failed\")<script>";
            }
        } else {
            echo "<script>alert('Info not inserted into the database')</script>";
        }
    } else {
        echo "there r errors";
        var_dump($errors);
    }
}
?>
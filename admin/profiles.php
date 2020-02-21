<?php require_once("includes/sessions.php"); ?>
<?php confirm_logged_in(); ?>
<?php require_once("includes/connection.php"); ?>

<?php

if (isset($_POST['insert'])) {
    $target = "images/" . basename($_FILES['image']['name']);
    $image = $_FILES['image']['name'];
    $info = getimagesize($_FILES["image"]["tmp_name"]);
    $allowed_types = array(IMG_GIF, IMG_JPEG, IMG_PNG, IMG_JPG);
    $name = mysqli_real_escape_string($mysqli, $_POST['name']);
    $description = mysqli_real_escape_string($mysqli, $_POST['description']);

    $query = "INSERT INTO profiles(name,description,picture) Values (?,?,?)";
    $stmt = mysqli_stmt_init($mysqli);
    if (!mysqli_stmt_prepare($stmt, $query)) {
        echo "SQL Insert Error";
    } else {
        mysqli_stmt_bind_param($stmt, "sss", $name, $description, $image);
        if (!in_array($info[2], $allowed_types)) {
            echo "<script>alert('Invalid file type chosen. Please select a valid picture type')</script>";
        } else {
            $result = mysqli_stmt_execute($stmt);
            if ($result) {
                if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                    echo "<script>alert('image uploaded succesfully')</script>";
                } else {
                    echo "<script>alert('error uploading image')</script>";
                }
            } else {
                echo "<script>alert('error connecting to DB')</script>";
            }
        }
    }
    // if ($mysqli->query($query) or die($mysqli->error)) {
    //     if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
    //         echo "<script>alert('image uploaded succesfully')</script>";
    //     } else {
    //         echo "<script>alert('error uploading image')</script>";
    //     }
    // } else {
    //     echo "<script>alert('error connecting to DB')</script>";
    // }
}
?>

<?php
include("includes/header.php")
?>
<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">

            <!-- ============================================================== -->
            <!-- pageheader  -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">
                        <h2 class="pageheader-title">Profiles</h2>
                        <p class="pageheader-text">Insert New Artist Profiles</p>
                        <div class="page-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Profiles</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end pageheader  -->
            <!-- ============================================================== -->


            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card">
                        <h5 class="card-header">Create New Profile</h5>
                        <div class="card-body">
                            <form method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="inputText3" class="col-form-label">Artist Name</label>
                                    <input id="inputText3" type="text" class="form-control" name="name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Artist Bio</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"></textarea>
                                </div>
                                <div class="custom-file mb-3">
                                    <input type="hidden" name="sixe" value="2000000">
                                    <input type="file" class="custom-file-input" id="customFile" name="image">

                                    <br />
                                    <label class="custom-file-label" for="customFile">Select Picture</label>
                                </div>
                                <input type="submit" name="insert" id="insert" value="Submit" class="btn btn-primary">
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <h3 class="text-center">Click the image to edit the post</h3>
                </div>
                <?php
                $stmt = mysqli_stmt_init($mysqli);
                $stmt = $mysqli->prepare("SELECT * FROM profiles ORDER by id DESC");
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows === 0) exit('No rows');
                while ($row = $result->fetch_assoc()) { ?>
                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="card">
                            <h5 class="card-header">ARTIST: <?php echo $row['name']; ?></h5>
                            <div class="card-body">
                                <div>
                                    <a href="edit.php?prof=<?php echo urlencode($row['id']); ?>"><img src='images/<?php echo $row['picture'] ?>' alt="user" class="rounded" width="100%"></a>
                                </div>
                            </div>
                            <div class="card-body bg-light">
                                <h6><?php echo $row['description']; ?><h6>
                            </div>
                            <div class="card-footer text-center bg-white">
                                <a href="delete.php?prof=<?php echo  urlencode($row['id']); ?>" onclick="return confirm('Are you sure you want to delete this picture?');">Delete Post</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<?php
include("includes/footer.php");
?>
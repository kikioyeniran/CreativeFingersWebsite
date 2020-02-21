<?php require_once("includes/sessions.php"); ?>
<?php confirm_logged_in(); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>


<?php
include("includes/header.php");
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
                        <h2 class="pageheader-title">Home</h2>
                        <p class="pageheader-text">Edit the background image, vision and mission statement of newbreed.</p>
                        <div class="page-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">about</li>
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
                <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card">
                        <h5 class="card-header">Update About Page Image</h5>
                        <div class="card-body">
                            <form method="post" enctype="multipart/form-data" action="update.php">
                                <?php
                                $query2 = "SELECT * FROM about WHERE id = 1";
                                $result = $mysqli->query($query2) or die($mysqli->error);
                                while ($row = $result->fetch_assoc()) { ?>
                                    <img src='images/<?php echo $row['picture'] ?>' alt="user" class="rounded" width="100%">
                                    <div class="custom-file mb-3">
                                        <input type="file" class="custom-file-input" id="customFile" name="image">
                                        <br />
                                        <label class="custom-file-label" for="customFile">Select another picture</label>
                                    </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card">
                        <h5 class="card-header">Company Description Update</h5>
                        <div class="card-body">

                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Company Description</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="6" name="details"><?php echo $row['details']; ?></textarea>
                            </div>
                        <?php } ?>
                        <!-- <a href="#" class="btn btn-primary">Update</a> -->
                        <input type="submit" name="update" id="update" value="Update" class="btn btn-primary">

                        </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

</div>

<?php
include("includes/footer.php");
?>
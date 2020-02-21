<?php require_once("includes/sessions.php"); ?>
<?php confirm_logged_in(); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>

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
                        <h2 class="pageheader-title">Home</h2>
                        <p class="pageheader-text">Edit</p>
                        <div class="page-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Events</li>
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
                        <h5 class="card-header">Edit Pictures in gallery</h5>
                        <div class="card-body">
                            <?php

                            if (isset($_GET['pic'])) {
                                // $id = $_GET['pic'];
                                // $query = "SELECT * FROM pictures WHERE id = {$id} ORDER BY id ASC";
                                // $result = $mysqli->query($query) or die($mysqli->error);
                                // $row = $result->fetch_assoc();
                                $stmt = $mysqli->prepare("SELECT * FROM pictures WHERE id = ? ORDER BY id ASC ");
                                $stmt->bind_param("i", $_GET['pic']);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                if ($result->num_rows === 0) exit('No rows');
                                $row = $result->fetch_assoc();
                            ?>


                                <form method="post" enctype="multipart/form-data" action="update.php?pic=<?php echo $_GET['pic'] ?>">
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Artist Name</label>
                                        <input id="inputText3" type="text" class="form-control" name="artist" value="<?php echo $row['artist']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control" name="category">
                                            <option value="Abstract Art">Abstract Art</option>
                                            <option value="Wood Works">Wood Works</option>
                                            <option value="Mixed Media">Mixed Media</option>
                                            <option value="Portrait Painting">Portrait Painting</option>
                                            <option value="Wearable Art">Wearable Art</option>
                                            <option value="Exhibitions">Exhibitions</option>
                                            <option value="Sculptures">Sculptures</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Measurement</label>
                                        <input id="inputText3" type="text" class="form-control" name="measurement" value="<?php echo $row['measurement']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Art Description</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"><?php echo $row['description']; ?></textarea>
                                    </div>
                                    <div class="custom-file mb-3">
                                        <input type="hidden" name="sixe" value="2000000">
                                        <input type="file" class="custom-file-input" id="customFile" name="image">

                                        <br />
                                        <label class="custom-file-label" for="customFile">Select Picture</label>
                                    </div>
                                    <input type="submit" name="insert" id="insert" value="Submit" class="btn btn-primary">
                                </form>
                            <?php
                            }
                            ?>
                            <?php

                            if (isset($_GET['prof'])) {
                                // $id = $_GET['prof'];
                                // $query = "SELECT * FROM profiles WHERE id = {$id} ORDER BY id ASC";
                                // $result = $mysqli->query($query) or die($mysqli->error);
                                // $row = $result->fetch_assoc();
                                $stmt = $mysqli->prepare("SELECT * FROM profiles WHERE id = ? ORDER BY id ASC ");
                                $stmt->bind_param("i", $_GET['prof']);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                if ($result->num_rows === 0) exit('No rows');
                                $row = $result->fetch_assoc();
                            ?>
                                <form method="post" enctype="multipart/form-data" action="update.php?prof=<?php echo $_GET['prof'] ?>">
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Artist</label>
                                        <input id="inputText3" type="text" class="form-control" name="artist" value="<?php echo $row['name']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Artist Bio</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"><?php echo $row['description']; ?></textarea>
                                    </div>
                                    <div class="custom-file mb-3">
                                        <input type="file" class="custom-file-input" id="customFile" name="image">
                                        <br />
                                        <label class="custom-file-label" for="customFile">Select Picture</label>
                                    </div>
                                    <input type="submit" name="upd_prof" id="upd_prof" value="Update" class="btn btn-primary" />
                                </form>
                            <?php
                            }
                            ?>

                        </div>
                    </div>
                </div>


            </div>
        </div>



        <?php
        include("includes/footer.php");
        ?>
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
                        <p class="pageheader-text">View List of Contacts</p>
                        <div class="page-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Contact</li>
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
                        <h5 class="card-header">List of Contacts</h5>

                        <div class="table-responsive ">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">First Name</th>
                                        <th scope="col">First Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Subject</th>
                                        <th scope="col">Message</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $stmt = mysqli_stmt_init($mysqli);
                                    $stmt = $mysqli->prepare("SELECT * FROM contact ORDER by id DESC");
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    if ($result->num_rows === 0) exit('No rows');
                                    while ($row = $result->fetch_assoc()) {
                                    ?>
                                        <tr>
                                            <th scope="row"><?php echo $row['id']; ?></th>
                                            <td><?php echo $row['firstName']; ?></td>
                                            <td><?php echo $row['lastName']; ?></td>
                                            <td><a href="#"><?php echo $row['email']; ?></a></td>
                                            <td><?php echo $row['subject']; ?></td>
                                            <td><?php echo $row['message']; ?></td>

                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>



    <?php
    include("includes/footer.php");
    ?>
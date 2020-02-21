<?php
include("includes/header.php")
?>

<div class="" data-aos="fade">
  <div class="container-fluid">

    <div class="row justify-content-center">
      <div class="col-md-7">
        <div class="row mb-5 site-section">
          <div class="col-12 ">
            <h2 class="site-section-heading text-center">About Us</h2>
          </div>
        </div>
        <?php
        $id = 1;
        $stmt = mysqli_stmt_init($mysqli);
        $stmt = $mysqli->prepare("SELECT * FROM about WHERE id = ? ORDER by id DESC");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows === 0) exit('No rows');
        $row = $result->fetch_assoc();
        ?>

        <div class="row mb-5">
          <div class="col-md-7">
            <img src="admin/images/<?php echo $row['picture'] ?>" alt="Images" class="img-fluid">
          </div>
          <div class="col-md-4 ml-auto">
            <h3>Our Mission</h3>
            <p><?php echo $row['details']; ?>
            </p>
          </div>
        </div>


        <div class="row site-section">
          <?php
          $stmt = mysqli_stmt_init($mysqli);
          $stmt = $mysqli->prepare("SELECT * FROM profiles ORDER by id DESC");
          $stmt->execute();
          $result = $stmt->get_result();
          if ($result->num_rows === 0) exit('No rows');
          while ($row = $result->fetch_assoc()) { ?>
            <div class="col-md-6 col-lg-6 col-xl-4 text-center mb-5">
              <img src="admin/images/<?php echo $row['picture'] ?>" alt="Image" class="img-fluid w-50 rounded-circle mb-4">
              <h2 class="text-black font-weight-light mb-4"><?php echo $row['name'] ?></h2>
              <p class="mb-4"><?php echo $row['description'] ?></p>
              <p>
                <a href="#" class="pl-0 pr-3"><span class="icon-twitter"></span></a>
                <a href="#" class="pl-3 pr-3"><span class="icon-instagram"></span></a>
                <a href="#" class="pl-3 pr-3"><span class="icon-facebook"></span></a>
              </p>
            </div>
          <?php } ?>
        </div>
      </div>

    </div>
  </div>
</div>


<?php include("includes/footer.php"); ?>
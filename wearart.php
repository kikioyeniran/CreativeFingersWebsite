<?php
include("includes/header.php")
?>

<div class="site-section" data-aos="fade">
  <div class="container-fluid">

    <div class="row justify-content-center">

      <div class="col-md-7">
        <div class="row mb-5">
          <div class="col-12 ">
            <h2 class="site-section-heading text-center">Wearable Art Gallery</h2>
          </div>
        </div>
      </div>

    </div>
    <div class="row" id="lightgallery">
      <?php
      $cat = "Wearable Art";
      $stmt = mysqli_stmt_init($mysqli);
      $stmt = $mysqli->prepare("SELECT * FROM pictures WHERE category = ? ORDER by id DESC");
      $stmt->bind_param("s", $cat);
      $stmt->execute();
      $result = $stmt->get_result();
      if ($result->num_rows === 0) exit('No rows');
      while ($row = $result->fetch_assoc()) {
      ?>
        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2 item" data-download-url=false data-aos="fade" data-src="admin/images/<?php echo $row['picture']; ?>" data-sub-html="<h4><?php echo $row['artist'] ?></h4><h4><?php echo $row['measurement'] ?></h4><p><?php echo $row['description']; ?></p>">
          <a href="#"><img src="admin/images/<?php echo $row['picture']; ?>" alt="IMage" class="img-fluid"></a>
        </div>
      <?php } ?>
      <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2 item" data-aos="fade" data-src="images/wearart/we04.jpg" data-sub-html="<h4>Victoria Udoh</h4><p>This work is aimed at making art part of people's lifestyle. You can now wear a work of art everywhere you go.</p>">
        <a href="#"><img src="images/wearart/we04.jpg" alt="IMage" class="img-fluid"></a>
      </div>



    </div>
  </div>
</div>



<?php include("includes/footer.php"); ?>
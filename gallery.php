<?php
include("includes/header.php")
?>

<div class="site-section"  data-aos="fade">
    <div class="container-fluid">

      <div class="row justify-content-center">

        <div class="col-md-7">
          <div class="row mb-5">
            <div class="col-12 ">
              <h2 class="site-section-heading text-center">Gallery</h2>
            </div>
          </div>
        </div>

      </div>
      <div class="row" id="lightgallery">
      <?php
                    $query = "SELECT * FROM pictures ORDER BY id ASC";
                    $result = $mysqli->query($query) or die($mysqli->error);
                    while ($row = $result->fetch_assoc()){
                     ?>
          <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2 item" data-download-url= false data-aos="fade" data-src="admin/images/<?php echo $row['picture'];?>" data-sub-html="<h4><?php echo $row['artist']?></h4><h4><?php echo $row['measurement']?></h4><p><?php echo $row['description'];?></p>">
          <a href="#"><img src="admin/images/<?php echo $row['picture'];?>" alt="IMage" class="img-fluid"></a>
        </div>
        <?php }?>
        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2 item" data-aos="fade" data-src="images/wood/w23.jpg" data-sub-html="<h4>Odo Melford</h4><p>Woodworking is an ancient form of art that has existed for thousands of years. We creatively produce amazing works of art from wood that can also be used as furniture. Talk about value creation!</p>">
          <a href="#"><img src="images/wood/w23.jpg" alt="IMage" class="img-fluid"></a>
                    </div>
      </div>
    </div>
  </div>



<?php include("includes/footer.php"); ?>
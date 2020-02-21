<?php
include("includes/header.php")
?>

<div class="site-section" data-aos="fade">
  <div class="container-fluid">

    <div class="row justify-content-center">

      <div class="col-md-7">
        <div class="row mb-5">
          <div class="col-12 ">
            <h2 class="site-section-heading text-center">Mixed Media Gallery</h2>
          </div>
        </div>
      </div>

    </div>
    <div class="row" id="lightgallery">
      <?php
      $cat = "Mixed Media";
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

      <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2 item" data-aos="fade" data-src="images/mixed/142,000 moses Ibanga. mixed media.jpg" data-sub-html="<h4>Moses Ibanga</h4><p>In visual art, mixed media is an artwork in which more than one medium or material has been employed. Assemblages and collages are two common examples of art using different media that will make use of different materials including cloth, paper, and/or wood.</p>">
        <a href="#"><img src="images/mixed/142,000 moses Ibanga. mixed media.jpg" alt="IMage" class="img-fluid"></a>
      </div>
      <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2 item" data-aos="fade" data-src="images/mixed/150,000Title_ Four market days, Mixed media on canvas, Date _ 2018.jpg" data-sub-html="<h4>Moses Ibanga</h4><h4>4 Markets 4 days</h4><p>In visual art, mixed media is an artwork in which more than one medium or material has been employed. Assemblages and collages are two common examples of art using different media that will make use of different materials including cloth, paper, and/or wood.</p>">
        <a href="#"><img src="images/mixed/sm2.jpg" alt="IMage" class="img-fluid"></a>
      </div>
      <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2 item" data-aos="fade" data-src="images/mixed/210,000Moses Ibanga, Bond , mixed media, 78 x 48 inchs., 2012..JPGimpressionism.jpg" data-sub-html="<h4>Moses Ibanga</h4><p>In visual art, mixed media is an artwork in which more than one medium or material has been employed. Assemblages and collages are two common examples of art using different media that will make use of different materials including cloth, paper, and/or wood.</p>">
        <a href="#"><img src="images/mixed/sm3.jpg" alt="IMage" class="img-fluid"></a>
      </div>
      <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2 item" data-aos="fade" data-src="images/mixed/142,000 moses Ibanga. mixed media.jpg" data-sub-html="<h4>Moses Ibanga</h4><p>In visual art, mixed media is an artwork in which more than one medium or material has been employed. Assemblages and collages are two common examples of art using different media that will make use of different materials including cloth, paper, and/or wood.</p>">
        <a href="#"><img src="images/mixed/142,000 moses Ibanga. mixed media.jpg" alt="IMage" class="img-fluid"></a>
      </div>
      <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2 item" data-aos="fade" data-src="images/mixed/150,000Title_ Four market days, Mixed media on canvas, Date _ 2018.jpg" data-sub-html="<h4>Moses Ibanga</h4><h4>4 Markets 4 days</h4><p>In visual art, mixed media is an artwork in which more than one medium or material has been employed. Assemblages and collages are two common examples of art using different media that will make use of different materials including cloth, paper, and/or wood.</p>">
        <a href="#"><img src="images/mixed/sm2.jpg" alt="IMage" class="img-fluid"></a>
      </div>
      <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2 item" data-aos="fade" data-src="images/mixed/210,000Moses Ibanga, Bond , mixed media, 78 x 48 inchs., 2012..JPGimpressionism.jpg" data-sub-html="<h4>Moses Ibanga</h4><p>In visual art, mixed media is an artwork in which more than one medium or material has been employed. Assemblages and collages are two common examples of art using different media that will make use of different materials including cloth, paper, and/or wood.</p>">
        <a href="#"><img src="images/mixed/sm3.jpg" alt="IMage" class="img-fluid"></a>
      </div>
      <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2 item" data-aos="fade" data-src="images/mixed/142,000 moses Ibanga. mixed media.jpg" data-sub-html="<h4>Moses Ibanga</h4><p>In visual art, mixed media is an artwork in which more than one medium or material has been employed. Assemblages and collages are two common examples of art using different media that will make use of different materials including cloth, paper, and/or wood.</p>">
        <a href="#"><img src="images/mixed/142,000 moses Ibanga. mixed media.jpg" alt="IMage" class="img-fluid"></a>
      </div>
      <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2 item" data-aos="fade" data-src="images/mixed/150,000Title_ Four market days, Mixed media on canvas, Date _ 2018.jpg" data-sub-html="<h4>Moses Ibanga</h4><h4>4 Markets 4 days</h4><p>In visual art, mixed media is an artwork in which more than one medium or material has been employed. Assemblages and collages are two common examples of art using different media that will make use of different materials including cloth, paper, and/or wood.</p>">
        <a href="#"><img src="images/mixed/sm2.jpg" alt="IMage" class="img-fluid"></a>
      </div>
      <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2 item" data-aos="fade" data-src="images/mixed/210,000Moses Ibanga, Bond , mixed media, 78 x 48 inchs., 2012..JPGimpressionism.jpg" data-sub-html="<h4>Moses Ibanga</h4><p>In visual art, mixed media is an artwork in which more than one medium or material has been employed. Assemblages and collages are two common examples of art using different media that will make use of different materials including cloth, paper, and/or wood.</p>">
        <a href="#"><img src="images/mixed/sm3.jpg" alt="IMage" class="img-fluid"></a>
      </div>
      <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2 item" data-aos="fade" data-src="images/mixed/142,000 moses Ibanga. mixed media.jpg" data-sub-html="<h4>Moses Ibanga</h4><p>In visual art, mixed media is an artwork in which more than one medium or material has been employed. Assemblages and collages are two common examples of art using different media that will make use of different materials including cloth, paper, and/or wood.</p>">
        <a href="#"><img src="images/mixed/142,000 moses Ibanga. mixed media.jpg" alt="IMage" class="img-fluid"></a>
      </div>
      <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2 item" data-aos="fade" data-src="images/mixed/150,000Title_ Four market days, Mixed media on canvas, Date _ 2018.jpg" data-sub-html="<h4>Moses Ibanga</h4><h4>4 Markets 4 days</h4><p>In visual art, mixed media is an artwork in which more than one medium or material has been employed. Assemblages and collages are two common examples of art using different media that will make use of different materials including cloth, paper, and/or wood.</p>">
        <a href="#"><img src="images/mixed/sm2.jpg" alt="IMage" class="img-fluid"></a>
      </div>
      <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2 item" data-aos="fade" data-src="images/mixed/210,000Moses Ibanga, Bond , mixed media, 78 x 48 inchs., 2012..JPGimpressionism.jpg" data-sub-html="<h4>Moses Ibanga</h4><p>In visual art, mixed media is an artwork in which more than one medium or material has been employed. Assemblages and collages are two common examples of art using different media that will make use of different materials including cloth, paper, and/or wood.</p>">
        <a href="#"><img src="images/mixed/sm3.jpg" alt="IMage" class="img-fluid"></a>
      </div>





    </div>
  </div>
</div>



<?php include("includes/footer.php"); ?>
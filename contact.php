<?php
include("includes/header.php");
include("admin/includes/functions.php");

?>

<?php
//require_once("admin/includes/connection.php");
if (isset($_POST['submit'])) {
  $Fname = mysqli_real_escape_string($mysqli, $_POST['fname']);
  $Lname = mysqli_real_escape_string($mysqli, $_POST['lname']);
  $email = mysqli_real_escape_string($mysqli, $_POST['email']);
  $subject = mysqli_real_escape_string($mysqli, $_POST['subject']);
  $message = mysqli_real_escape_string($mysqli, $_POST['message']);


  $query = "INSERT INTO contact(firstName, lastName, email, subject, message) Values (?,?,?,?,?)";
  $stmt = mysqli_stmt_init($mysqli);
  if (!mysqli_stmt_prepare($stmt, $query)) {
    echo "SQL Insert Error";
  } else {
    mysqli_stmt_bind_param($stmt, "sssss", $Fname, $Lname, $email, $subject, $message);
    $result = mysqli_stmt_execute($stmt);
    if ($result) {
      echo "<script>alert('Your message has been sent Succesfully.')</script>";
    } else {
      echo "<script>alert('error connecting to DB')</script>";
    }
  }
}
?>




<div class="site-section" data-aos="fade">
  <div class="container-fluid">

    <div class="row justify-content-center">
      <div class="col-md-7">
        <div class="row mb-5">
          <div class="col-12 ">
            <h2 class="site-section-heading text-center">Contact Us</h2>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-8 mb-5">
            <form method="post" enctype="multipart/form-data">


              <div class="row form-group">
                <div class="col-md-6 mb-3 mb-md-0">
                  <label class="text-black" for="fname">First Name</label>
                  <input type="text" name="fname" id="fname" class="form-control">
                </div>
                <div class="col-md-6">
                  <label class="text-black" for="lname">Last Name</label>
                  <input type="text" name="lname" id="lname" class="form-control">
                </div>
              </div>

              <div class="row form-group">

                <div class="col-md-12">
                  <label class="text-black" for="email">Email</label>
                  <input type="email" name="email" id="email" class="form-control">
                </div>
              </div>

              <div class="row form-group">

                <div class="col-md-12">
                  <label class="text-black" for="subject">Subject</label>
                  <input type="subject" name="subject" id="subject" class="form-control">
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="message">Message</label>
                  <textarea name="message" id="message" cols="30" rows="7" class="form-control" placeholder="Write your notes or questions here..."></textarea>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <input type="submit" name="submit" value="Send Message" class="btn btn-primary py-2 px-4 text-white">
                </div>
              </div>


            </form>
          </div>
          <div class="col-lg-3 ml-auto">
            <div class="mb-3 bg-white">
              <p class="mb-0 font-weight-bold">Address</p>
              <p class="mb-4">Enugu State, Nigeria</p>

              <p class="mb-0 font-weight-bold">Phone</p>
              <p class="mb-4"><a href="#">+234 810 417 4223</a></p>

              <p class="mb-0 font-weight-bold">Email Address</p>
              <p class="mb-0"><a href="#">info@cfartnexus.com</a></p>

            </div>

          </div>
        </div>
      </div>

    </div>
  </div>
</div>


<?php include("includes/footer.php"); ?>
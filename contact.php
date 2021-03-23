<?php 

// INSERT INTO `contact1` (`sr_no`, `name`, `email`, `phone_no`, `msg`, `date`) VALUES ('1', 'shadab', 'shadab@gmail.com', '998765409', 'gfwtdfgcdghadgacd', current_timestamp());



  $showAlert = false;
  include "partials/_dbconnect.php";
  if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_POST['msg-submit']) ){
      if((isset($_POST['name']) && !empty($_POST['name'])) && (isset($_POST['email']) && !empty($_POST['email'])) && (isset($_POST['phone_no']) && !empty($_POST['phone_no'])) && (isset($_POST['msg']) && !empty($_POST['msg'])))
    {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone_no']);
    $message = mysqli_real_escape_string($conn, $_POST['msg']);
  
  $msgquery = "INSERT INTO `contact` (`name`, `email`, `phone_no`, `msg`, `date`) VALUES ('$name', '$email', '$phone', '$message', current_timestamp())";
  $result = mysqli_query($conn, $msgquery);
  if ($result){
    $showAlert=true;
  }
    }}}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Antara Yoga Center | Contact Us</title>
</head>

<body>
  <?php
        require 'partials/_header.php';
        ?>
<section class="container my-3">
  <div class="row">

  <div class="col-md-6">
    <h1> Reach Us </h1>
  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3770.7505567443413!2d72.83201304966998!3d19.074701856908614!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7c90e6740a08b%3A0x17eb1ecd5461f9d3!2sLinking%20Rd%2C%20Mumbai%2C%20Maharashtra!5e0!3m2!1sen!2sin!4v1614612516663!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
  </div>
    <div class="col-md-6">
    <!-- <div id="sent"> -->
          <?php
        if($showAlert){
          echo ' <div class="alert alert-success" role="alert">
          We Will Revert You Back Soon!
          </div> '; 
        }
        ?>
      <form method = "POST">
        <h1> Connect With Us </h1>
        <div class="mb-3">
          <label for="name" class="form-label">Name</label>
          <input type="text" class="form-control" id="name" name="name">
    </div>
    <div class="mb-3">
      <label for="email" class="form-label">Email Address</label>
      <input type="email" class="form-control" id="email" name="email">
      <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
    </div>
    <div class="mb-3">
      <label for="phone_no" class="form-label">Phone No.</label>
      <input type="phone" class="form-control" id="phone_no" name="phone_no">
    </div>
    <div class="mb-3">
      <label for="msg" class="form-label">Ask Your Questions!</label>
      <textarea cols="3" rows="4" class="form-control" id="msg" name="msg"></textarea>
    </div>
    <button type="submit" name = "msg-submit" class="btn btn-primary">Submit</button>
  </form>
  
</div>
</div>
</section>
 
<!-- Address Information -->
<section class="container text-center">
    <hr class="featurette-divider">

    <div class="row mt-5">
      <div class="col-md-4 order-md-1">
        <img src="img/phone.png" alt="phone no.">
        <h2 class="my-3">Phone No.</h2>
        <a href="tel:+91 00000 00000" style="text-decoration: none; color:black;">
          <p>+91 99307 89765</p>
        </a>

        <a href="tel:+91 00000 00000" style="text-decoration: none; color:black;">
          <p>+91 98765 43210</p>
        </a>
      </div>

      <div class="col-md-4 order-md-2">
        <img src="img/email.png" alt="email id">
        <h2 class="my-3">Email Address</h2>
        <a href="mailto:antara.yoga@mail.com" style="text-decoration: none; color:black;">
          <p>antara.yoga@mail.com</p>
        </a>
        <a href="mailto:antara.yoga@mail.com" style="text-decoration: none; color:black;">
          <p>support@antarayoga.com</p>
        </a>
      </div>

      <div class="col-md-4 order-md-3">
        <img src="img/address.png" alt="office address ">
        <h2 class="my-3">Office Address</h2>
        <a href="https://goo.gl/maps/xAbRFKY9WnbjiW1z5" style="text-decoration: none; color:black;">
          <p>Linking Road, <br>
           Bandra(w), <br>
           Mumbai-400050</p>
        </a>
      </div>
    </div>
  </section>
<?php
        require 'partials/_footer.php';
        ?>
</body>

</html>
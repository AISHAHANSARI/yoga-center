<?php
session_start();

$membername = "None, Please Sign In!";
$memberemail = "None, Please Sign In!";
if (isset($_SESSION['user']) && ($_SESSION['LoggedIn'] == true)){

$membername = $_SESSION['name'];
$memberemail = $_SESSION['user'];
}
$showAlert = false;
include "partials/_dbconnect.php";
if($_SERVER['REQUEST_METHOD'] == "POST"){
  if(isset($_POST['review-submit']) ){
    if((isset($_POST['name']) && !empty($_POST['name'])) && (isset($_POST['phone_no']) && !empty($_POST['phone_no'])) && (isset($_POST['msg']) && !empty($_POST['msg'])))
  {
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $phone = mysqli_real_escape_string($conn, $_POST['phone_no']);
  $message = mysqli_real_escape_string($conn, $_POST['msg']);

$msgquery = "INSERT INTO `review` (`name`, `email`, `phone_no`, `reviews`, `date`) VALUES ('$name', '$email', '$phone', '$message', current_timestamp())";
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
  <title>Antara Yoga Centre | Classes</title>
</head>

<body>
  <?php
        require 'partials/_header.php';
        ?>

<section class="container my-5 position-relative">
  <div class="row">
    <div class="quotes col-6">

      <h3>Lorem, ipsum.</h3>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam placeat iure corporis neque ducimus vero voluptatibus quas sint, praesentium consectetur, quos alias aperiam facere odit?</p>
    </div>

    
    <div class="col-md-4 end-0 container position-relative  my-3 px-5 float-right">
      <div class="card" style="width: 25rem;">
        <!-- <img src="img/pose2.jpg" class="card-img-top" alt="..."> -->

        <div class="card-body text-center">
          <h5 class="card-title"><b>You're Logged In as:</b>
           </h5>
          <p class="card-title"><b>Name : </b>  <?php echo $membername; ?>
          </p>
          
          <p class="card-text"><b>Email : </b>
            <?php echo $memberemail; ?></p>
      
        </div>
        <!-- <div class="text-center mb-3">
          <button class="btn btn-primary">Sign Out</button>
        </div> -->
      </div>
    </div>
  </div>
</section>

  <!-- Session Booking  -->

  <section class="container mt-5 text-center">
    <div class="d-flex justify-content-center">
    <div class="row text-center ">

      

      <div class="col-lg-6 text-center my-3 px-5">
        <div class="card" style="width: 25rem;">
          <img src="img/pose2.jpg" class="card-img-top" alt="...">

          <div class="card-body">
            <h5 class="card-title text-center"><b>3 DAYS IN A WEEK</b></h5>
            <p class="card-text text-center">Mon-Wed-Fri<br>
              Time: 9:00 AM to 12:00 noon</p>
        
              <form action="payment.php" method="post">
            <input class="form-check-input" type="radio" name="sessionBooking" id="sessionBooking1" value="1500" checked>
            <label class="form-check-label" for="sessionBooking1">
              <b>₹ : 1500.00</b>
            </label>
          </div>
        </div>

      </div>

      <div class="col-lg-6 text-center my-3 px-5">
        <div class="card" style="width: 25rem;">
          <img src="img/pose.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title text-center"><b>6 DAYS IN A WEEK</b></h5>
            <p class="card-text text-center">Mon-Tue-Wed-Thu-Fri-Sat<br>
              Time: 9:00 AM to 12:00 noon</p>
            
            <input class="form-check-input" type="radio" name="sessionBooking" id="sessionBooking2" value="2500">
            <label class="form-check-label" for="sessionBooking2">
              <b>₹ : 2500.00</b>
            </label>
          </div>
        </div>
      </div>
    </div>
  </div>
  

    


    <?php
             if (isset($_SESSION['user']) && ($_SESSION['LoggedIn'] == true)){

              
               echo '<button type="submit" name ="book-submit" class=" my-3 p-2 col-3 btn btn-primary">Book Now</button>';
             }else
            {
              echo '<button type="button"  data-bs-toggle="modal" data-bs-target="#exampleModal" class="my-3 p-2 col-3 btn btn-primary">Book Now</button>';
            }
        ?>
  </form>

  </section>


  <!-- Review Section  -->
  <section class="container my-5">
    <div class="row">
      <div class="col-6">
        <div id="sent">
          <?php
        if($showAlert){
          echo ' <div class="alert alert-success" role="alert">
          Thanks For Your Review!
          </div> '; 
        }
        ?>
        </div>
        <form method="POST">
          <h1> Review </h1>
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
            <label for="msg" class="form-label">give us your review!</label>
            <textarea cols="3" rows="4" class="form-control" id="msg" name="msg"></textarea>
          </div>
          <button type="submit" name="review-submit" class="btn btn-primary">Submit</button>

          
        </form>

      </div>
    </div>
  </section>

  <?php
        require 'partials/_footer.php';
        ?>
</body>

</html>
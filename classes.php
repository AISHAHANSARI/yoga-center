<?php
session_start();

$session1 = false;
 $session2 = false;

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

  <section class="container mt-5 position-relative">
    <div class="row">
      <div class="quotes col-6 mt-5">


        <h4>
          <p>“Yoga is a light, which once lit will never dim. The better your practice, the brighter your flame.”</p>
        </h4>
      </div>


      <div class="col-md-4 end-0 container position-relative  my-3 px-5 float-right">
        <div class="card" style="width: 25rem;">
          <!-- <img src="img/pose2.jpg" class="card-img-top" alt="..."> -->

          <div class="card-body text-center">
            <h5 class="card-title"><b>You're Logged In as:</b>
            </h5>
            <p class="card-title"><b>Name : </b>
              <?php echo $membername; ?>
            </p>

            <p class="card-text"><b>Email : </b>
              <?php echo $memberemail; ?>
            </p>

          </div>
          <!-- <div class="text-center mb-3">
          <button class="btn btn-primary">Sign Out</button>
        </div> -->
        </div>
      </div>
    </div>
  </section>

  <?php
  $booked = false;
  if (isset($_SESSION['user']) && ($_SESSION['LoggedIn'] == true)){
  
  $sessSql = "SELECT * FROM `sessionbooking` WHERE `email` = '$memberemail'";
  $sessionresult = mysqli_query($conn, $sessSql);
  
  $sessrow = mysqli_fetch_array($sessionresult);
  $sessnum = mysqli_num_rows($sessionresult);
  if($sessnum >=1){
    $booked = true;
  } } ?>
  
  <!-- users course (if logged in)-->


  <?php
   if (isset($_SESSION['user']) && ($_SESSION['LoggedIn'] == true)){

    if ($booked){
        

        $sessionQuery = "SELECT * FROM `sessionbooking` WHERE `email` = '$memberemail' and `paystatus` = 'success' ";
        $bookresult = mysqli_query($conn, $sessionQuery);
        $bookrow = mysqli_fetch_assoc($bookresult);

        $book_oid = $bookrow['o_id'];
        $book_amt = $bookrow['amount'];
        $bookeddate = $bookrow['bookdate'];
        $book1 = $bookrow['session1'];
        $book2 = $bookrow['session2'];
        $bookpay = $bookrow['paystatus'];
        $book_paymode = $bookrow['paymode'];


        $bookexpiry = $bookrow['expirydate'];
        $todaydate = date("Y-m-d");


        if (($book1 == 1) && ($bookpay=="success")){
          $session1 = true;
          $session2 = false;

        }elseif(($book2 == 1 && ($bookpay=="success")) ){
          $session2 = true;
          $session1 = false;
        }else{
          $booked = false;
        }

//agar epiry date aaj se match karta hai to session1 aur session2 false

          if($bookexpiry <= $todaydate){
            $session1 = false;
            $session2 = false;
            
            
            $memberphone = $_SESSION['phone'];
            $expinsert = "INSERT INTO `expiredbookedsession` (`o_id`, `name`, `phone_no`, `email`, `amount`, `bookdate`, `expirydate`, `session1`, `session2`, `paystatus`, `paymode`) VALUES ('$book_oid', '$membername', '$memberphone', '$memberemail', '$book_amt', '$bookeddate', '$bookexpiry', '$book1', '$book2', '$bookpay', '$book_paymode')";
            $expdelete = "DELETE FROM `sessionbooking` WHERE `sessionbooking`.`email` = '$memberemail' and `sessionbooking`.`paystatus` = 'success' ";
            mysqli_query($conn, $expinsert);
            mysqli_query($conn, $expdelete);
          }


  ?>






<!-- Session 1 -->

<?php if($session1){ ?>
  <section class="container text-center mt-3">
      <h2 class="title">Your Booked Course</h2>
      
    <div class="d-flex justify-content-center">

      <div class="row text-center ">



        <div class="col-lg-6 text-center my-3 px-5">
          <div class="card" style="width: 25rem;">
            <img src="img/pose2.jpg" class="card-img-top" alt="...">


          </div>

        </div>

        <div class="col-lg-6 text-center my-3 px-5">
          <div class="card" style="width: 25rem;">
            <!-- <img src="img/pose2.jpg" class="card-img-top" alt="..."> -->

            <div class="card-body">
              <h5 class="card-title text-center"><b>3 DAYS IN A WEEK</b></h5>
              <p class="card-text text-center">Mon-Wed-Fri<br>
                Time: 9:00 AM to 12:00 noon<br> 1 Month Course.</p>

                <h6>Expiry Date : <?php echo $bookexpiry ?></h6>
                <!-- <h6>Today Date : <?php echo $todaydate ?></h6> -->

             
            </div>
          </div>

        </div>

      </div>
    </div>
<?php }
elseif($session2){
  ?>
    <!-- Session 2 -->
    <section class="container text-center mt-3">
    <h2 class="title">Your Booked Course</h2>
    <div class="d-flex justify-content-center">


      <div class="row text-center ">

        <div class="col-lg-6 text-center my-3 px-5">
          <div class="card" style="width: 25rem;">
            <img src="img/pose.jpg" class="card-img-top" alt="...">

          </div>
        </div>



        <div class="col-lg-6 text-center my-3 px-5">
          <div class="card" style="width: 25rem;">

            <div class="card-body">
              <h5 class="card-title text-center"><b>6 DAYS IN A WEEK</b></h5>
              <p class="card-text text-center">Mon-Tue-Wed-Thu-Fri-Sat<br>
                Time: 9:00 AM to 12:00 noon<br> 1 Month Course.</p>

                <h6>Expiry Date : <?php echo $bookexpiry ?></h6>
            </div>
          </div>



        </div>
      </div>
    </div>

<?php }
?>


 <!-- Video Section -->

 <?php 
 if(($session1 == true || $session2 == true) && ($booked==true)){ 
   ?>
<section class="container">
		<h2 class="title">Practice Videos</h2>
		<div class=" mt-3">
			<div class="row">
				<?php
				include "partials/_dbconnect.php";
					
				$q = "SELECT * FROM video";

				$query = mysqli_query($conn,$q);
				
				while($row=mysqli_fetch_array($query)) { 
          $ftitle = $row['title'];
					$name = $row['name'];
					?>

				<div class="col-md-4 p-2">
          <video width="100%" controls>
            <source src="<?php echo 'admin/upload/'.$name;?>">
					</video>
          <h5 class="title"><?php echo $ftitle;?></h5>
				</div>

				<?php }
?>
			</div>
		</div>
	</section>
<?php
 }
 ?>

 <!-- Video end  -->


  </section>
  <?php }
}
 if(($session1 == false && $session2 == false) || ($booked == false)){ ?>
  <!-- Session Booking  -->

  <section class="container mt-3 text-center">
    <h2 class="title">Courses Available</h2>
    <div class="d-flex justify-content-center">


      <div class="row text-center ">



        <div class="col-lg-6 text-center my-3 px-5">
          <div class="card" style="width: 25rem;">
            <img src="img/pose2.jpg" class="card-img-top" alt="...">

            <div class="card-body">
              <h5 class="card-title text-center"><b>3 DAYS IN A WEEK</b></h5>
              <p class="card-text text-center">Mon-Wed-Fri<br>
                Time: 9:00 AM to 12:00 noon<br> 1 Month Course.</p>

              <form action="payment.php" method="post">
                <input class="form-check-input" type="radio" name="sessionBooking" id="sessionBooking1"
                  value="sessionBooking1" checked>
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
                Time: 9:00 AM to 12:00 noon<br> 1 Month Course.</p>

              <input class="form-check-input" type="radio" name="sessionBooking" id="sessionBooking2"
                value="sessionBooking2">
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

<?php }
?>



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
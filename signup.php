<?php
$showAlert = false;
include "partials/_dbconnect.php";
if($_SERVER['REQUEST_METHOD'] == "POST"){
  if(isset($_POST['review-submit']) ){
    if((isset($_POST['name']) && !empty($_POST['name'])) && (isset($_POST['phone_no']) && !empty($_POST['phone_no'])) && (isset($_POST['email']) && !empty($_POST['email']))&& (isset($_POST['dob']) && !empty($_POST['dob']))&& (isset($_POST['gender']) && !empty($_POST['gender']))&& (isset($_POST['password']) && !empty($_POST['password']))&& (isset($_POST['cpassword']) && !empty($_POST['cpassword'])))
  {
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $phone = mysqli_real_escape_string($conn, $_POST['phone_no']);
  $dob = mysqli_real_escape_string($conn, $_POST['dob']);
  $gender = mysqli_real_escape_string($conn, $_POST['gender']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);
  $cpassword= mysqli_real_escape_string($conn, $_POST['cpassword']);

$msgquery = "INSERT INTO `signup` (`email`, `phone_no`, `name`, `dob`, `gender`, `password`, `cpassword`, `date`) VALUES ('umayma@gmail.com', '998765409', 'umayma', '12-03-99', 'gender', 'umayma786', 'umayma786', current_timestamp());"
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
  <title>Document</title>
</head>

<body>
  <?php
        require 'partials/_header.php';
        ?>
         <section class="my-5">
          <h1 class="text-center mt-3 "> Welcome To Antara Family!</h1>
          <div class="container col-6">
        <?php
        if($showAlert){
          echo ' <div class="alert alert-success" role="alert">
          Thanks For Your Review!
          </div> '; 
        }
        ?>
        <form method="POST">
          
          <div>
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name">
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" class="form-control" id="email" name="email">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
          </div>
          <div class="mb-3">
            <label for="phone_no" class="form-label">Phone No</label>
            <input type="phone" class="form-control" id="phone_no" name="phone_no">
          </div>
          <div class="mb-3">
            <label for="dob" class="form-label">Date Of Birth</label>
            <input type="date" class="form-control" id="dob" name="dob">
          </div>
          <label class= "form-label"> Gender </label>
          <div class="mb-3">
            <input type="radio"  id="male" name="gender">
            <label for="male" class="form-label">Male</label> <br>

            <input type="radio"  id="female" name="gender">
            <label for="female" class="form-label">Female</label><br>

            <input type="radio"  id="Others" name="gender">
            <label for="Others" class="form-label">Others</label>

          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password">
          </div>
          <div class="mb-3">
            <label for="Cpassword" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="cpassword" name="Cpassword">
          </div>
          
          <button type="submit" name="review-submit" class="btn btn-primary">Sign Up</button>
        </form>
</div>
         </section>

<?php
        require 'partials/_footer.php';
        ?>
</body>

</html>
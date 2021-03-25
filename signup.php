<?php
session_start();
if (isset($_SESSION['user']) && ($_SESSION['LoggedIn'] == true)){
  header("location: index.php");
}
$showAlert = false;
include "partials/_dbconnect.php";
if($_SERVER['REQUEST_METHOD'] == "POST"){
  if(isset($_POST['register-submit']) ){
    if((isset($_POST['name']) && !empty($_POST['name'])) && (isset($_POST['phone_no']) && !empty($_POST['phone_no'])) && (isset($_POST['email']) && !empty($_POST['email']))&& (isset($_POST['dob']) && !empty($_POST['dob']))&& (isset($_POST['gender']) && !empty($_POST['gender']))&& (isset($_POST['password']) && !empty($_POST['password']))&& (isset($_POST['cpassword']) && !empty($_POST['cpassword']))&& (isset($_POST['quest1']) && !empty($_POST['quest1']))&& (isset($_POST['quest2']) && !empty($_POST['quest2']))&& (isset($_POST['quest3']) && !empty($_POST['quest3'])))
  {
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $phone = mysqli_real_escape_string($conn, $_POST['phone_no']);
  $dob = mysqli_real_escape_string($conn, $_POST['dob']);
  $gender = mysqli_real_escape_string($conn, $_POST['gender']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);
  $cpassword= mysqli_real_escape_string($conn, $_POST['cpassword']);
  $quest1= mysqli_real_escape_string($conn, $_POST['quest1']);
  $quest2= mysqli_real_escape_string($conn, $_POST['quest2']);
  $quest3= mysqli_real_escape_string($conn, $_POST['quest3']);
  
  
  if($password == $cpassword){
    $msgquery = "INSERT INTO `member` (`email`, `phone_no`, `name`, `dob`, `gender`, `password`, `date` , `quest1` , `quest2` , `quest3` ) VALUES ('$email', '$phone', '$name', '$dob', '$gender', '$password',  current_timestamp(), '$quest1' , '$quest2' , '$quest3')";
    $result = mysqli_query($conn, $msgquery);
    if ($result){
      $showAlert=true;
    }
  }else if ($password != $cpassword){
       echo '<script>alert("password does not match!")</script>';
    }
    else{
      die("error". error());
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
          You have been registered successfully please sign in!
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
        <label class="form-label"> Gender </label>
        <div class="mb-3">
          <input type="radio" value="male" id="male" name="gender">
          <label for="male" class="form-label">Male</label> <br>

          <input type="radio" value="female" id="female" name="gender">
          <label for="female" class="form-label">Female</label><br>

          <input type="radio" value="others" id="Others" name="gender">
          <label for="Others" class="form-label">Others</label>

        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password">
        </div>
        <div class="mb-3">
          <label for="Cpassword" class="form-label">Confirm Password</label>
          <input type="password" class="form-control" id="cpassword" name="cpassword">
        </div>

        <div>
          <label for="quest1" class="form-label">What Is Your School Name?</label>
          <input type="text" class="form-control" id="quest1" name="quest1">
        </div>

        <div>
          <label for="quest2" class="form-label">What Is Your Father Name?</label>
          <input type="text" class="form-control" id="quest2" name="quest2">
        </div>

        <div>
          <label for="quest3" class="form-label">What Is Your Pet Name?</label>
          <input type="text" class="form-control" id="quest3" name="quest3">
        </div>

        <button type="submit" name="register-submit" class="btn btn-primary">Sign Up</button>
      </form>
    </div>
  </section>

  <?php
        require 'partials/_footer.php';
        ?>
</body>

</html>
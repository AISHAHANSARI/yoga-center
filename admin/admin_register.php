<?php
session_start();
include "partials/_dbconnect.php";
$showAlert = false;


if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_POST['msubmit']) ){
        if((isset($_POST['memail']) && !empty($_POST['memail'])) && (isset($_POST['mpassword']) && !empty($_POST['mpassword']))){
            $memail = mysqli_real_escape_string($conn, $_POST['memail']);
            $mpassword = mysqli_real_escape_string($conn, $_POST['mpassword']);

            $mquery = "select * from masteradmin where email='$memail' and password = '$mpassword' ";
      
    $mresult = mysqli_query($conn,$mquery);
    // $frow = mysqli_fetch_array($mresult);
    $fnum = mysqli_num_rows($mresult);
    if($fnum ==1){
        $mverify = "success";
        $_SESSION['master'] = $memail;
        $_SESION['adminLogged'] = true;
        
    }else{
        $mverify = "failure";
    }    
    }
}
if(isset($_POST['admin-submit']) ){
    if((isset($_POST['admin-name']) && !empty($_POST['admin-name'])) && (isset($_POST['admin-phone_no']) && !empty($_POST['admin-phone_no'])) && (isset($_POST['admin-email']) && !empty($_POST['admin-email']))&& (isset($_POST['admin-dob']) && !empty($_POST['admin-dob']))&& (isset($_POST['admin-gender']) && !empty($_POST['admin-gender']))&& (isset($_POST['admin-password']) && !empty($_POST['admin-password']))&& (isset($_POST['admin-cpassword']) && !empty($_POST['admin-cpassword'])))
    {
    $admin_name = mysqli_real_escape_string($conn, $_POST['admin-name']);
    $admin_email = mysqli_real_escape_string($conn, $_POST['admin-email']);
    $admin_phone = mysqli_real_escape_string($conn, $_POST['admin-phone_no']);
    $admin_dob = mysqli_real_escape_string($conn, $_POST['admin-dob']);
    $admin_gender = mysqli_real_escape_string($conn, $_POST['admin-gender']);
    $admin_password = mysqli_real_escape_string($conn, $_POST['admin-password']);
    $admin_cpassword= mysqli_real_escape_string($conn, $_POST['admin-cpassword']);
   
    
    
    if($admin_password == $admin_cpassword){
      $msgquery = "INSERT INTO `admin` (`email`, `phone_no`, `name`, `dob`, `gender`, `password`, `date` ) VALUES ('$admin_email', '$admin_phone', '$admin_name', '$admin_dob', '$admin_gender', '$admin_password',  current_timestamp())";
      $result = mysqli_query($conn, $msgquery);
      if ($result){
        $mverify = "success";
          echo ' <div class="alert alert-success" role="alert">
          Admin registered successfully please sign in!
          </div> ';
      }
    }else if ($admin_password != $admin_cpassword){
         echo '<script>alert("password does not match!")</script>';
      }
      else{
        die("error". error());
    }
    
    }
}

}

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

 <?php if ($mverify == "success"){ ?>     

  <section class="my-5">
    <h1 class="text-center mt-3 "> Welcome To Antara Family!</h1>
    <div class="container col-6">
      

      <form method="POST">

        <div class="mb-3 form-group">
          <label for="admin-name" class="form-label">Name</label>
          <input type="text" class="form-control" id="admin-name" name="admin-name">
        </div>
        <div class="mb-3 form-group">
          <label for="admin-email" class="form-label">Email Address</label>
          <input type="email" class="form-control" id="admin-email" name="admin-email">
          <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3 form-group">
          <label for="admin-phone_no" class="form-label">Phone No</label>
          <input type="phone" class="form-control" id="admin-phone_no" name="admin-phone_no">
        </div>
        <div class="mb-3 form-group">
          <label for="admin-dob" class="form-label">Date Of Birth</label>
          <input type="date" class="form-control" id="admin-dob" name="admin-dob">
        </div>
        <label class="admin-form-label"> Gender </label>
        <div class="mb-3 form-group">
          <input type="radio" value="male" id="admin-male" name="admin-gender">
          <label for="male" class="form-label">Male</label> <br>

          <input type="radio" value="female" id="female" name="admin-gender">
          <label for="female" class="form-label">Female</label><br>

          <input type="radio" value="others" id="Others" name="admin-gender">
          <label for="Others" class="form-label">Others</label>

        </div>
        <div class="mb-3 form-group">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="admin-password">
        </div>
        <div class="mb-3 form-group">
          <label for="Cpassword" class="form-label">Confirm Password</label>
          <input type="password" class="form-control" id="cpassword" name="admin-cpassword">
        </div>


        <button type="submit" name="admin-submit" class="btn btn-primary">Sign Up</button>
      </form>
    </div>

  </section>
  <?php } ?>

  <?php if ($mverify == "failure"){ ?> 
<div class="container my-5">
    <h1 class="text-center">You Are Not Allowed to register the Admin, Access Denied.</h1>
</div>
  <?php } ?>
  <?php
        require 'partials/_footer.php';
        ?>
</body>

</html>
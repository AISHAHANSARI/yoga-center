<?php

// include "partials/_dbconnect.php";
// if($_SERVER['REQUEST_METHOD'] == "POST"){

//   if (isset ($_POST['btn-logout'])){
//     session_unset();
//   session_destroy();
//   }
  
//   if (isset ($_POST['signin-submit'])){
//     if((isset($_POST['email']) && !empty($_POST['email'])) && (isset($_POST['password']) && !empty($_POST['password']))){

//       $email = mysqli_real_escape _string($conn, $_POST['email']);
//       $password = mysqli_real_escape_string($conn, $_POST['password']);
//       $query = "select * from member where email='$email' and password = '$password'";
      
//       $result = mysqli_query($conn,$query);
//       $row = mysqli_fetch_array($result);
//       $num = mysqli_num_rows($result);
//       if($num ==1){

        
         
       
//         session_start();
//         $_SESSION['user'] = $email;
//         $_SESSION['name'] = $row['name'];
//         $_SESSION['phone'] = $row['phone_no'];
//         $_SESSION['LoggedIn'] = true;


//         header("location: classes.php");

//       }


//     }
//   }
// }

// if($_SERVER['REQUEST_METHOD'] == "GET"){
//   if (isset($_SESSION['user']) && ($_SESSION['LoggedIn'] == true)){
//     echo '<script></script>';
//   }
// }

// ?>



<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

<!-- Custom Css  -->
<link rel="stylesheet" href="../css/style.css">

<!-- Bootstrap css end  -->

<!-- Favicon  -->
<link href="img-copy/logo.png" rel="icon" type="image/png" />

<!-- navbar  -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Antara</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="manage.php">Gallery</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="member.php">Member</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="">Session Booking</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="">Detail Information</a>
        </li>
        </ul>
        <ul class="navbar-nav navbar-right me-md-3">
        <li>
         
          <button type="button" data-bs-target="#exampleModal" data-bs-toggle="modal" class="btn btn-md btn-success px-5">Sign In</button>
          <!-- <form method="GET"> -->
            <?php
            //  if (isset($_SESSION['user']) && ($_SESSION['LoggedIn'] == true)){
            //    echo '<button type="button" class="btn btn-md btn-primary px-5" data-bs-toggle="modal" data-bs-target="#loggedInModal">
            //    Sign Out
            //  </button>';
        //      }else
        //     {
        //       echo '<button type="button"  data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-md btn-success px-5">Sign In</button>';
        //     }
        // ?>
      <!-- </form> -->
        </li>
        </ul>
    </div>
  </div>
</nav>

<!-- Sign In Modal  -->
<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Sign In</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">





      <form method ="POST">
    <div class="mb-3">
      <label for="email" class="form-label">Email Address</label>
      <input type="email" class="form-control" id="email" name="email">
      <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password" class="form-control" id="password" name="password">
    </div>
    <p class="text-center">New Member? <a href="signup.php"> Sign Up</a></p>
    





      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name ="signin-submit" class="btn btn-success">Sign In</button>
      </div>
  </form>
    </div>
  </div>
</div>








<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="loggedInModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       <h3>Are You Sure Want to Sign Out ?</h3>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>



        <form  method="POST">
        <button type="submit" name="btn-logout" class="btn btn-primary">Sign Out</button>
        </form>
 

      </div>
    </div>
  </div>
</div>
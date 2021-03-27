<?php 
require 'partials/_dbconnect.php';

if((isset($_SESSION['adminEmail']) || isset($_SESSION['master'])) && $_SESION['adminLogged'] ==true  ){
    header("location: index.php");
}



if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_POST['admin_signin']) ){
        if((isset($_POST['admin_email']) && !empty($_POST['admin_email'])) && (isset($_POST['admin_password']) && !empty($_POST['admin_password']))){
            $adminEmail = mysqli_real_escape_string($conn, $_POST['admin_email']);
            $adminPassword = mysqli_real_escape_string($conn, $_POST['admin_password']);

            $adQuery = "select * from admin where email='$adminEmail' and password = '$adminPassword' ";
      
    $adResult = mysqli_query($conn,$adQuery);
    // $frow = mysqli_fetch_array($adResult);
    $adNnum = mysqli_num_rows($adResult);
    if($adNnum == 1){
        session_start();
        $_SESSION['adminEmail'] = $adminEmail;
       
        $_SESION['adminLogged'] = true;
        header("location: index.php");
        
    }   
    }
}
}




?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php include "partials/_header.php"; ?>
<section class="container col-6">

    <form method ="POST">
        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" class="form-control" id="email" name="admin_email">
      <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
 
    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password" class="form-control" id="password" name="admin_password">
    </div>
    

    

    <div class="mb-3">
    <button type="submit" name ="admin_signin" class="btn btn-success">Sign In</button>
</div>
</form>
</section>
    


    <?php include "partials/_footer.php"; ?>


</body>
</html>
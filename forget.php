<?php

session_start();
if (isset($_SESSION['user']) && ($_SESSION['LoggedIn'] == true)){
  header("location: index.php");
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password</title>
</head>
<body>

    <?php include "partials/_header.php";
    ?>
<section class="col-6 container my-5">
    <h2 class="title text-center"> Please Verify Your Credentials!</h2>
   
    <form action ="new_password.php" method = "POST">
        
    <div class="form-group mb-3">
          <label for="email" class="form-label">Email Address</label>
          <input type="email" class="form-control" id="email" name="femail" required>
          <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>

        <div class="form-group mb-3">
          <label for="quest1" class="form-label">What Is Your School Name?</label>
          <input type="text" class="form-control" id="quest1" name="fquest1" required>
        </div>

        <div class="form-group mb-3">
          <label for="quest2" class="form-label">What Is Your Father Name?</label>
          <input type="text" class="form-control" id="quest2" name="fquest2" required>
        </div>

        <div class="form-group mb-3">
          <label for="quest3" class="form-label">What Is Your Pet Name?</label>
          <input type="text" class="form-control" id="quest3" name="fquest3" required>
        </div>
<div class="form-group mb-3">
        <button type="submit" name="forget-submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
</section>

    <?php include "partials/_footer.php";
    ?>
</body>
</html>
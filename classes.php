<?php
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

  <section class="container my-3">
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
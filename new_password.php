<?php include "partials/_dbconnect.php";

session_start();

if (isset($_SESSION['user']) && ($_SESSION['LoggedIn'] == true)){
    header("location: index.php");
}

// $fverify = false;
$mismatch = false;
$changed = false;


if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_POST['forget-submit']) ){
      if((isset($_POST['femail']) && !empty($_POST['femail'])) && (isset($_POST['fquest1']) && !empty($_POST['fquest1'])) && (isset($_POST['fquest2']) && !empty($_POST['fquest2'])) && (isset($_POST['fquest3']) && !empty($_POST['fquest3'])))
    {
    $femail = mysqli_real_escape_string($conn, $_POST['femail']);
    $fquest1 = mysqli_real_escape_string($conn, $_POST['fquest1']);
    $fquest2 = mysqli_real_escape_string($conn, $_POST['fquest2']);
    $fquest3 = mysqli_real_escape_string($conn, $_POST['fquest3']);
    $_SESSION['change_pwd_mail'] = $femail;
    $fquery = "select * from member where email='$femail' and quest1 = '$fquest1' and quest2 = '$fquest2' and quest3 = '$fquest3' ";
      
    $fresult = mysqli_query($conn,$fquery);
    $frow = mysqli_fetch_array($fresult);
    $fnum = mysqli_num_rows($fresult);
    if($fnum ==1){

        $_SESSION['db-match'] = true;
    }else{
        $_SESSION['db-match'] = false;
    }
    }}

$fverify = $_SESSION['db-match'];
if ($fverify){
    if(isset($_POST['Verifysubmit']) ){
      if((isset($_POST['verifypassword']) && !empty($_POST['verifypassword'])) && (isset($_POST['verifycpassword']) && !empty($_POST['verifycpassword'])))
        {
            $verifypassword = mysqli_real_escape_string($conn, $_POST['verifypassword']);
            $verifycpassword = mysqli_real_escape_string($conn, $_POST['verifycpassword']);

            $verifyemail = $_SESSION['change_pwd_mail'];

            if($verifypassword == $verifycpassword){

                $verifyquery= "UPDATE `member` SET `password` = '$verifypassword' WHERE `member`.`email` = '$verifyemail'";
                $verifyresult = mysqli_query($conn, $verifyquery);
                if($verifyresult){
                    $changed = true;
                }


            }
            else{
                $mismatch = true;

            }
        }
    }}

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
    <?php include "partials/_header.php";

?>
    <?php
        if($mismatch){
          echo ' <div class="alert alert-success" role="alert">
          Your Entered Password Does not match!
          </div> '; 
        }
        
        ?>

    <?php if($changed){
    echo ' <div class="alert alert-success" role="alert">
    Your Password has been changed Successfully!
    </div> 
    <div class="container text-center">
<h2 class="title">Head to Home and Sign In!</h2>
<a href="index.php" class="btn-lg btn-success p-3 my-3 ">OK</a>
</div>'; 
  }
  else{
  ?>




    <section class="container col-6">
    <form method="POST">


        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="verifypassword">
        </div>
        <div class="mb-3">
            <label for="Cpassword" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="cpassword" name="verifycpassword">
        </div>
        <div class=" mb-3">
            <button type="submit" name="Verifysubmit" class="btn btn-primary">Submit</button>
        </div>
    </form>
    </section>
    <?php }
    
        if($fverify){
            echo '
            <div class="container text-center">
<h2 class="title">Your Credentials does not match, Please contact the help desk!</h2>
<a href="index.php" class="btn-lg btn-success p-3 my-3 ">OK</a>
</div>'; 
          }
      
    ?>
    <?php include "partials/_footer.php";
    ?>
</body>

</html>
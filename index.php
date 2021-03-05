<?php include "partials/_dbconnect.php";
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Antara Yoga Classes | Home</title>
</head>

<body>
  <?php include "partials/_header.php";
  ?>

  <!-- carousel  -->
  <div id="carouselExampleControls" class="carousel slide home-carousel" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="img/pose.jpg" class="d-block w-100 home-carousel-img" alt="...">
      </div>
      <div class="carousel-item">
        <img src="img/pose2.jpg" class="d-block w-100 home-carousel-img" alt="...">
      </div>
      <div class="carousel-item">
        <img src="img/pose3.jpg" class="d-block w-100 home-carousel-img" alt="...">
      </div>
      <div class="carousel-item">
        <img src="img/pose4.jpg" class="d-block w-100 home-carousel-img" alt="...">
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
  <!-- Carousel End  -->


  <!-- Review Carousel  -->
<section class="review">
<div class="container py-5">
  <div id="carouselreview" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner text-center">



      <?php 

$query = "SELECT * FROM review";
if($result = mysqli_query($conn, $query))
{
  if(mysqli_num_rows($result) > 0)
	{
    
    
    
    while($row = mysqli_fetch_array($result)){
      
      if ($row['sr_no'] == 1){
        echo '<div class="carousel-item active">';
        
        echo '<p class="d-block w-100">' . $row['name'] . "</p>";
        echo '<p class="d-block w-100">' . $row['email'] . "</p>";
        echo '<p class="d-block w-100">' . $row['reviews'] . "</p>";
        
        echo '</div>';        
      }
      if ($row['sr_no'] > 1){
        echo '<div class="carousel-item">';
        
        echo '<p class="d-block w-100">' . $row['name'] . "</p>";
        echo '<p class="d-block w-100">' . $row['email'] . "</p>";
        echo '<p class="d-block w-100">' . $row['reviews'] . "</p>";
        
        echo '</div>';
        // <img src="img/pose.jpg" class="d-block w-100" alt="...">
      }
    }
  }}
  
  
  
  
  ?>

    </div class="">
    <button class="carousel-control-prev text-primary" type="button" data-bs-target="#carouselreview" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselreview" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
  </div>
  </section>



  <?php include "partials/_footer.php";
  ?>
</body>

</html>
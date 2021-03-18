<?php include "partials/_dbconnect.php";

session_start();

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

  <!-- paragraph -->

  <section class="container mt-5 intro-para">
    <div>
     
      <p class="lead">The Yoga Institute, Bandara (West), Mumbai, India was founded in 1950.
      We believed that yoga was not meant exclusively for bearded men living in the mountains, and we wanted to bring it to householders—the men and women who have to work, toil, commute, earn a living, raise children, and fight the battle of life everyday. 
      We wanted to bring it to people living in the town and the city, because We believed that the householder could benefit immensely from this knowledge. </p>

      <p></p>
    </div>
  </section>

  <!-- pragraph end -->


  


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

       echo  '<img src="img/Aishah_Ansari.jpg" alt=""
          class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="60" height="60">';
        
        echo '<h4><p class="d-block w-100">' . $row['name'] . "</p></h4>";
        
        // echo '<p class="d-block w-100">' . $row['email'] . "</p>";
        echo '<p class="d-block w-100">' . $row['reviews'] . "</p>";
        
        echo '</div>';        
      }
      if ($row['sr_no'] > 1){
        echo '<div class="carousel-item">';

        echo  '<img src="img/Aishah_Ansari.jpg" alt=""
          class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="60" height="60">';
        
        echo '<h4><p class="d-block w-100">' . $row['name'] . "</p></h4>";
        // echo '<p class="d-block w-100">' . $row['email'] . "</p>";
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


<!-- Footer  -->
  <?php include "partials/_footer.php";
  ?>
</body>

</html>
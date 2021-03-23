<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<title>Display All Videos from database using php</title>
</head>

<body>
	<?php include 'partials/_header.php' ?>

	<section class="container">
		<h1><b>Practice Videos</b></h1>
		<div class="d-flex justify-align-center mt-3">

			<!-- if($result = mysqli_query($conn, $query))
{
  if(mysqli_num_rows($result) > 0)
	{
    
    
    
    while($row = mysqli_fetch_array($result)){
      
      if ($row['sr_no'] == 1){ -->

			<div class="row">
				<?php
				include "partials/_dbconnect.php";
					
				$q = "SELECT * FROM video";

				$query = mysqli_query($conn,$q);
				
				while($row=mysqli_fetch_array($query)) { 

					$name = $row['name'];
					?>

				<div class="col-md-4">
					<video width="100%" controls>
						<source src="<?php echo 'upload/'.$name;?>">
					</video>
				</div>

				<?php }
?>
			</div>
		</div>
	</section>
	<?php include 'partials/_footer.php' ?>
</body>

</html>
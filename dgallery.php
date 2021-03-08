<?php

session_start();

require_once 'DB.class.php';
$db = new DB();

//Fetch the images data
$condition = array('where' => array('status' => 1));
$images = $db -> getRows('images', $condition);
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Image Gallery</title>

	<!-- fancybox css -->
	<link rel="stylesheet" type="text/css" href="fancybox/jquery.fancybox.min.css">

	<!-- stylesheet file-->
	<!-- <link rel="stylesheet" type="text/css" href="admin/css/style.css"> -->

	<!-- jquery library -->
	<script src="js/jquery.min.js"></script>

	<!-- fancybox js library -->
	<script src="fancybox/jquery.fancybox.min.js"></script>

   <!-- bootstrap css  -->
   <!-- <link rel="stylesheet" href="admin/bootstrap/bootstrap.min.css"> -->

<!-- bootstrap script  -->
<!-- <script src="admin/bootstrap/bootstrap.min.js"></script> -->

	<!-- initialize fancybox -->
	<script>
		$("[data-fancybox]").fancybox();
	</script>
</head>
<body>
<?php
        require 'partials/_header.php';
        ?>

<section class="container-fluid gallery-banner">
    <div class="container ">
      
    </div>
  </section>

<section>
	<div class="container mt-5">
		
		<div class="gallery">
            <div class="row">
            <!-- <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 my-2"> -->
            <!-- <div class="row row-cols-2 row-cols-lg-5 g-2 g-lg-3"> -->
			<?php
            if(!empty($images)){
							foreach($images as $row){
                                $uploadDir = 'uploads/images/';
								$imageURL = $uploadDir.$row["file_name"];
								
                                ?>
			<div class="col-lg-3">
				<a href="<?php echo $imageURL; ?>" data-fancybox="gallery" data-caption="<?php echo $row["title"];?>">
					<img src="<?php echo $imageURL;?> " alt="" />
					<p><?php echo $row["title"];?></p>

				</a>
			</div>
			<?php }
           }?>
           </div>
		</div>
	</div>				

   <?php require'partials/_footer.php' ?> 
    </section>
    

</body>
</html>
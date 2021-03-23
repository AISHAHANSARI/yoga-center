<?php 

include "partials/_dbconnect.php";

if (isset($_POST['upload'])) {
	// $name = $_FILES['file'];
	// echo "<pre>";
	// print_r($name);
	// exit();
	$ftitle = $_POST['ftitle'];
	$file_name = $_FILES['file']['name'];
	$file_type = $_FILES['file']['type'];	
	$temp_name = $_FILES['file']['tmp_name'];
	$file_size = $_FILES['file']['size'];
	
	$file_destination = "upload/".$file_name;

	if (move_uploaded_file($temp_name,$file_destination)) { 
	
	$q = "INSERT INTO video (`title`, `name`) VALUES ('$ftitle', '$file_name')";

	if(mysqli_query($conn,$q)) {

		$success = "Video uploaded successfully.";
	}
	else {
		
		$failed = "Something went wrong??";
	}
}
else {

	$msz = "Please select a video to upload..!";
}
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>Upload Video into the Database Using Php</title>
	<!-- <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css"> -->
	<!-- <script src="assets/js/jquery.min.js"></script> -->
</head>

<body>
	<?php include 'partials/_header.php' ?>

	<div class="container mt-3">

		<h1 class="text-center"><b>Upload Video into the Database Using Php</b></h1>
		<div class=" d-flex justify-content-center my-3">
			<form action="upload.php" method="post" enctype="multipart/form-data">
				<div class="form-group">
					<label class="mt-3"><strong>Title : </strong></label>
					<input type="text" name="ftitle" class="form-control mt-3" placeholder="Day 10">
				</div>
				<div class="form-group">
					<label class="mt-3"><strong>Upload a Video:</strong></label>
					<input type="file" name="file" class="form-control mt-3">
				</div>
				<?php if(isset($success)) { ?>
				<div class="alert alert-success">



					<?php echo $success;?>

				</div>
				<?php } ?>
				<?php if(isset($failed)) { ?>
				<div class="alert alert-danger">



					<?php echo $failed;?>

				</div>
				<?php } ?>

				<?php if(isset($msz)) { ?>
				<div class="alert alert-danger">



					<?php echo $msz;?>

				</div>
				<?php } ?>
				<input type="submit" name="upload" value="Upload" class="mt-3 btn btn-success">
			</form>
		</div>
	</div>
	<?php include 'partials/_footer.php' ?>
</body>

</html>
<?php
session_start();
$mememail = $_SESSION['user'];

$amount= $_POST['sessionBooking'];
// header("Pragma: no-cache");
// header("Cache-Control: no-cache");
// header("Expires: 0");


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
	<title>Antara Yoga Center | Session Booking</title>
	<meta name="GENERATOR" content="Evrsoft First Page">
</head>

<body>
	<?php
        require 'partials/_header.php';
        ?>
	<pre>
	</pre>
	<section class="container">
		<form method="post" action="pgRedirect.php">
			<div class="container">
				<div class="text-center">
					<a class="text-center" href="index.php">
						<img src="img/logo1.png" alt="Sampurn Kirtiman" height="150px">
					</a>
					<h2>Antara Yoga Center </h2>
					<p class="lead">Your privacy and payment is our prior concern.</p>

				</div>

				<input hidden id="ORDER_ID" tabindex="1" maxlength="20" size="20" name="ORDER_ID" autocomplete="off"
					value="<?php echo  'ORDS' . rand(10000,99999999)?>">




				<input hidden id="CUST_ID" tabindex="2" maxlength="12" size="12" name="CUST_ID" autocomplete="off"
					value="<?php echo $mememail; ?>"></td>


				<div hidden class="form-group">
					<label>INDUSTRY_TYPE_ID ::*</label>
					<input id="INDUSTRY_TYPE_ID" class="form-control" tabindex="4" maxlength="12" size="12"
						name="INDUSTRY_TYPE_ID" autocomplete="off" value="Retail"></td>
				</div>

				<div hidden class="form-group">
					<label>Channel ()::*</label>
					<input id="CHANNEL_ID" tabindex="4" class="form-control" maxlength="12" size="12" name="CHANNEL_ID"
						autocomplete="off" value="WEB">
				</div>

				<div class="form-group col-4">
					<label for="amountl">Session Fee *</label>
					<div class="d-flex justify-content-center"> 
						<input title="TXN_AMOUNT" id="amount" class="form-control" tabindex="10" type="text" name="TXN_AMOUNT" value="<?php echo $amount; ?>" readonly>
					</div>

					<div class="form-group text-center">
						<input value="CheckOut" class="btn btn-success my-5" type="submit" onclick="">
					</div>
				</div>
				* - Mandatory Fields
		</form>

	</section>
	<?php
        require 'partials/_footer.php';
        ?>
</body>

</html>
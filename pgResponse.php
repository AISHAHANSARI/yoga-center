<?php
include 'partials/_header.php';



// following files need to be included
require_once("./lib/config_paytm.php");
require_once("./lib/encdec_paytm.php");

include 'partials/_dbconnect.php';

$paytmChecksum = "";
$paramList = array();
$isValidChecksum = "FALSE";

$paramList = $_POST;
$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg

//Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application�s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
$isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.

echo '<section class=" my-3"> 
<div class="container">';

if($isValidChecksum == "TRUE") {
	echo '<h1>Thank you</h1>';
	echo "<b>Checksum matched and following are the transaction details:</b>" . "<br/>";
	if ($_POST["STATUS"] == "TXN_SUCCESS") {

		


		$ORDERID = $_POST['ORDERID'];
		$MID  = $_POST['MID'];
		$TXNID = $_POST['TXNID'];
		$TXNAMOUNT = $_POST['TXNAMOUNT'];
		$PAYMENTMODE = $_POST['PAYMENTMODE'];
		$CURRENCY = $_POST['CURRENCY'];
		$TXNDATE = $_POST['TXNDATE'];
		$STATUS = $_POST['STATUS'];
		$RESPCODE = $_POST['RESPCODE'];
		$RESPMSG = $_POST['RESPMSG'];
		$GATEWAYNAME = $_POST['GATEWAYNAME'];
		$BANKTXNID = $_POST['BANKTXNID'];
		$BANKNAME = $_POST['BANKNAME'];
		$CHECKSUMHASH = $_POST['CHECKSUMHASH'];

		

		if (!isset($_SESSION['user']) && !isset($_SESSION['LoggedIn'])){

			$query = "select * from `sessionbooking` where o_id='$ORDERID'";
      
      $result = mysqli_query($conn,$query);
      $row = mysqli_fetch_array($result);
      $num = mysqli_num_rows($result);
      if($num ==1){

        
        $_SESSION['user'] = $row['email'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['phone'] = $row['phone_no'];
        $_SESSION['LoggedIn'] = true;
	}

			$mememail = $_SESSION['user'];
			$memname = $_SESSION['name'];
			$memphone = $_SESSION['phone'];

			$query1 = "UPDATE `sessionbooking` SET `paystatus` = 'success' WHERE `sessionbooking`.`o_id` = '$ORDERID'";

			$query2 = "INSERT INTO `sessiontxn` (`name`, `email`, `phone`, `orderid`, `mid`, `txnid`, `tamount`, `paymode`, `currency`, `tdate`, `status`, `respmsg`, `gatewayname`, `banktxnid`, `bankname`) VALUES ('$memname', '$mememail', '$memphone', '$ORDERID', '$MID', '$TXNID', '$TXNAMOUNT', '$PAYMENTMODE', '$CURRENCY', current_timestamp(), '$STATUS', '$RESPMSG', '$GATEWAYNAME', '$BANKTXNID', '$BANKNAME')";
			
			mysqli_query($conn, $query1);
			mysqli_query($conn, $query2);

		}elseif(isset($_SESSION['user']) && ($_SESSION['LoggedIn'] == true)){
			$mememail = $_SESSION['user'];
			$memname = $_SESSION['name'];
			$memphone = $_SESSION['phone'];
			
			$query1 = "UPDATE `sessionbooking` SET `paystatus` = 'success' WHERE `sessionbooking`.`o_id` = '$ORDERID'";

			$query2 = "INSERT INTO `sessiontxn` (`name`, `email`, `phone`, `orderid`, `mid`, `txnid`, `tamount`, `paymode`, `currency`, `tdate`, `status`, `respmsg`, `gatewayname`, `banktxnid`, `bankname`) VALUES ('$memname', '$mememail', '$memphone', '$ORDERID', '$MID', '$TXNID', '$TXNAMOUNT', '$PAYMENTMODE', '$CURRENCY', current_timestamp(), '$STATUS', '$RESPMSG', '$GATEWAYNAME', '$BANKTXNID', '$BANKNAME')";

			mysqli_query($conn, $query1);
			mysqli_query($conn, $query2);

		}else{
			echo 'Error';
		}
		
		echo "<b>Transaction status is success</b>" . "<br/>";
		
		//Process your transaction here as success transaction.
		//Verify amount & order id received from Payment gateway with your application's order id and amount.
	}
	else {

		$ORDERID = $_POST['ORDERID'];
		$MID  = $_POST['MID'];
		$TXNID = $_POST['TXNID'];
		$TXNAMOUNT = $_POST['TXNAMOUNT'];
		$PAYMENTMODE = $_POST['PAYMENTMODE'];
		$CURRENCY = $_POST['CURRENCY'];
		$TXNDATE = $_POST['TXNDATE'];
		$STATUS = $_POST['STATUS'];
		$RESPCODE = $_POST['RESPCODE'];
		$RESPMSG = $_POST['RESPMSG'];
		$GATEWAYNAME = $_POST['GATEWAYNAME'];
		$BANKTXNID = $_POST['BANKTXNID'];
		$BANKNAME = $_POST['BANKNAME'];
		$CHECKSUMHASH = $_POST['CHECKSUMHASH'];
		if (!isset($_SESSION['user']) && !isset($_SESSION['LoggedIn'])){

			$query = "select * from `sessionbooking` where o_id='$ORDERID'";
      
      $result = mysqli_query($conn,$query);
      $row = mysqli_fetch_array($result);
      $num = mysqli_num_rows($result);
      if($num ==1){

        
        $_SESSION['user'] = $row['email'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['phone'] = $row['phone_no'];
        $_SESSION['LoggedIn'] = true;
	}

			$mememail = $_SESSION['user'];
			$memname = $_SESSION['name'];
			$memphone = $_SESSION['phone'];

			$query1 = "UPDATE `sessionbooking` SET `paystatus` = 'failure' WHERE `sessionbooking`.`o_id` = '$ORDERID'";

			$query2 = "INSERT INTO `sessiontxn` (`name`, `email`, `phone`, `orderid`, `mid`, `txnid`, `tamount`, `paymode`, `currency`, `tdate`, `status`, `respmsg`, `gatewayname`, `banktxnid`, `bankname`) VALUES ('$memname', '$mememail', '$memphone', '$ORDERID', '$MID', '$TXNID', '$TXNAMOUNT', '$PAYMENTMODE', '$CURRENCY', current_timestamp(), '$STATUS', '$RESPMSG', '$GATEWAYNAME', '$BANKTXNID', '$BANKNAME')";
			
			mysqli_query($conn, $query1);
			mysqli_query($conn, $query2);

		}elseif(isset($_SESSION['user']) && ($_SESSION['LoggedIn'] == true)){
			$mememail = $_SESSION['user'];
			$memname = $_SESSION['name'];
			$memphone = $_SESSION['phone'];

			$query1 = "UPDATE `sessionbooking` SET `paystatus` = 'failure' WHERE `sessionbooking`.`o_id` = '$ORDERID'";

			$query2 = "INSERT INTO `sessiontxn` (`name`, `email`, `phone`, `orderid`, `mid`, `txnid`, `tamount`, `paymode`, `currency`, `tdate`, `status`, `respmsg`, `gatewayname`, `banktxnid`, `bankname`) VALUES ('$memname', '$mememail', '$memphone', '$ORDERID', '$MID', '$TXNID', '$TXNAMOUNT', '$PAYMENTMODE', '$CURRENCY', current_timestamp(), '$STATUS', '$RESPMSG', '$GATEWAYNAME', '$BANKTXNID', '$BANKNAME')";
			
			mysqli_query($conn, $query1);
			mysqli_query($conn, $query2);

		}else{
			echo 'Error';
		}

		echo '<h1>Oops! Something Went Wrong...</h1>';
		echo "<b>Transaction status is failure</b>" . "<br/>";
	}
	
	
	
	if (isset($_POST) && count($_POST)>0 )
	{ 
		foreach($_POST as $paramName => $paramValue) {
			echo '<p class="">' . $paramName . ' = ' . $paramValue . '</p>';
			
			
		}
		echo '
		<p><b><i>please save your transaction detail or take screenshot in case of payment failure.</i></b></p>
		<a class="btn btn-primary px-5 py-1 btn-lg" href="index.php"> OK </a>';
	}
	
	
}
else {
	echo '<h1>Oops! Something Went Wrong...</h1>';
	echo "<b>Checksum mismatched.</b>";
	//Process transaction as suspicious.
}

echo '</div>
</section>';
include 'partials/_footer.php';
?>
<?php
// include 'partials/_header.php';

session_start();
$memname = $_SESSION['name'];
$mememail = $_SESSION['user'];
$memphone = $_SESSION['phone'];
$memtype = $_SESSION['sessType'];


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


if($isValidChecksum == "TRUE") {
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

		

		if ($memtype == 'sessionBooking1'){

			$expiry = date("Y-m-d", strtotime("+1 Months"));
			

			$query1 = "INSERT INTO `sessionbooking` (`name`, `phone_no`, `email`, `amount`, `bookdate`, `expirydate`, `session1`, `session2`, `paystatus`, `paymode`) VALUES ('$memname', '$memphone', '$mememail', '$TXNAMOUNT', current_timestamp(), '$expiry', '1', '0', '1', 'online')";

			$query2 = "INSERT INTO `sessiontxn` (`name`, `email`, `phone`, `orderid`, `mid`, `txnid`, `tamount`, `paymode`, `currency`, `tdate`, `status`, `respmsg`, `gatewayname`, `banktxnid`, `bankname`) VALUES ('$memname', '$mememail', '$memphone', '$ORDERID', '$MID', '$TXNID', '$TXNAMOUNT', '$PAYMENTMODE', '$CURRENCY', current_timestamp(), '$STATUS', '$RESPMSG', '$GATEWAYNAME', '$BANKTXNID', '$BANKNAME')";

			mysqli_query($conn, $query1);
			mysqli_query($conn, $query2);

		}elseif ($memtype == 'sessionBooking2'){
			$expiry = date("Y-m-d", strtotime("+1 Months"));

			$query1 = "INSERT INTO `sessionbooking` (`name`, `phone_no`, `email`, `amount`, `bookdate`, `expirydate`, `session1`, `session2`, `paystatus`, `paymode`) VALUES ('$memname', '$memphone', '$mememail', '$TXNAMOUNT', current_timestamp(), '$expiry', '0', '1', '1', 'online')";

			$query2 = "INSERT INTO `sessiontxn` (`name`, `email`, `phone`, `orderid`, `mid`, `txnid`, `tamount`, `paymode`, `currency`, `tdate`, `status`, `respmsg`, `gatewayname`, `banktxnid`, `bankname`) VALUES ('$memname', '$mememail', '$memphone', '$ORDERID', '$MID', '$TXNID', '$TXNAMOUNT', '$PAYMENTMODE', '$CURRENCY', current_timestamp(), '$STATUS', '$RESPMSG', '$GATEWAYNAME', '$BANKTXNID', '$BANKNAME')";

			mysqli_query($conn, $query1);
			mysqli_query($conn, $query2);
		}
		else{
			echo ' Error';
		}


		// INSERT INTO `sessiontxn` (`sr_no`, `name`, `email`, `phone`, `orderid`, `mid`, `txnid`, `tamount`, `paymode`, `currency`, `tdate`, `status`, `respmsg`, `gatewayname`, `banktxnid`, `bankname`) VALUES ('', 'shadab', 'as@df.com', '9632587410', '1223', '213sdd', '22343', '13234', 'sadas', 'sdas', current_timestamp(), 'sd', 'sdas', 'sdas', '345345', 'dsfsd');
		
		

		echo "<b>Transaction status is success</b>" . "<br/>";
		
		//Process your transaction here as success transaction.
		//Verify amount & order id received from Payment gateway with your application's order id and amount.
	}
	else {

		if ($memtype == 'sessionBooking1'){
		$expiry = date("Y-m-d", strtotime("+1 Months"));

			$query1 = "INSERT INTO `sessionbooking` (`name`, `phone_no`, `email`, `amount`, `bookdate`, `expirydate`, `session1`, `session2`, `paystatus`, `paymode`) VALUES ($memname, $memphone, $mememail, $TXNAMOUNT, 'current_timestamp()', $expiry, '1', '0', '0', 'not paid')";

			mysqli_query($conn, $query1);
		}
		elseif ($memtype == 'sessionBooking2'){
		$expiry = date("Y-m-d", strtotime("+1 Months"));

			$query1 = "INSERT INTO `sessionbooking` (`name`, `phone_no`, `email`, `amount`, `bookdate`, `expirydate`, `session1`, `session2`, `paystatus`, `paymode`) VALUES ($memname, $memphone, $mememail, $TXNAMOUNT, 'current_timestamp()', $expiry, '0', '1', '0', 'not paid')";

			mysqli_query($conn, $query1);
		}else{
			echo 'Failure';
		}

		echo "<b>Transaction status is failure</b>" . "<br/>";
	}

	if (isset($_POST) && count($_POST)>0 )
	{ 
		foreach($_POST as $paramName => $paramValue) {
				echo "<br/>" . $paramName . " = " . $paramValue;

				
		}
	}
	

}
else {
	echo "<b>Checksum mismatched.</b>";
	//Process transaction as suspicious.
}

?>
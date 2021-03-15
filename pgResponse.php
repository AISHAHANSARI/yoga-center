<?php
session_start();
$memname = $_SESSION['name'];
$mememail = $_SESSION['user'];
$memphone = $_SESSION['phone'];



// following files need to be included
require_once("./lib/config_paytm.php");
require_once("./lib/encdec_paytm.php");

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
		$MID  = $_POST['MID '];
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
		
		

		echo "<b>Transaction status is success</b>" . "<br/>";
		// INSERT INTO `sessionbooking` (`sr_no`, `name`, `phone_no`, `email`, `amount`, `bookdate`, `expirydate`, `session1`, `session2`, `paystatus`) VALUES ('1', 'shadab', '998765409', 'shady@gmail.com', '10000', current_timestamp(), current_timestamp(), '1', '', '1');
		//Process your transaction here as success transaction.
		//Verify amount & order id received from Payment gateway with your application's order id and amount.
	}
	else {
		echo "<b>Transaction status is failure</b>" . "<br/>";
	}

	if (isset($_POST) && count($_POST)>0 )
	{ 
		$dummy = $_POST['ORDERID'];
		echo "$dummy";
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
<?php

//Work Completed by Jalaluddin Qureshi (Individually), for HTTP5203, Lab-9, Winter 2021, Humber College.

$link = "";
session_start();

define('PAYPAL_API_URL', 'https://api-m.sandbox.paypal.com');

capture_order();


function capture_order() {
	if(isset(  $_GET["token"] )) {
		//https://www.php.net/manual/en/reserved.variables.get.php
		$order_id = htmlspecialchars($_GET["token"]);
	
		$url = PAYPAL_API_URL . '/v2/checkout/orders/' . $order_id .'/capture';
		$headers = array(
		"Content-Type: application/json",
		"Authorization: Bearer " . $_SESSION['paypal']['token']
		);	
		
		$opts = array(
			CURLOPT_HTTPHEADER => $headers,
			CURLOPT_URL => $url,
			CURLOPT_POST => true,
			CURLOPT_RETURNTRANSFER => true
		);
		
		$c = curl_init(); //initialize curl session
		curl_setopt_array($c, $opts); //set curl options
		$result = json_decode(curl_exec($c));
		curl_close($c);
		
		//thank you message.
		print '<p> Thank you <strong>' . $result->payer->name->given_name . '</strong>. Your payment for Order ID # ' .
				$result->id . ' has been successfully processed.</p>';
	
	}
	
	
}

?>




<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Lab 9, HTTP5203 - Order Confirmation</title>
    <link rel="stylesheet" type="text/css" href="css/main.css"/>
</head>


</html>
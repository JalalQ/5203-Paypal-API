<?php

//Work Completed by Jalaluddin Qureshi (Individually), for HTTP5203, Lab-9, Winter 2021, Humber College.

$link = "";
session_start();

define('PAYPAL_API_URL', 'https://api-m.sandbox.paypal.com');

$PAYPAL = array(
  'client_id' => '',
  'client_secret' => '',
  'redirect_uri' => 'https://localhost/lab5203/lab9/index.php'
);

//echo "<h1>To Make a new payment remove content after ? in the URL bar</h1>";

get_token($PAYPAL);

//create_order($PAYPAL);

function get_token($config) {
	$url = PAYPAL_API_URL . '/v1/oauth2/token';
	$headers = array(
	'Accept: application/json',
	'Accept-Language: en_US'
	);
	//-H corresponds to HTTPHEADER
	//-u corresponds to USERPWD
	//-d corresponds to POSTFIELDS
	$opts = array(
	CURLOPT_HTTPHEADER => $headers,
	CURLOPT_URL => $url,
	CURLOPT_POST => true,
	CURLOPT_USERPWD => $config['client_id'] . ':' . $config['client_secret'],
	CURLOPT_POSTFIELDS => 'grant_type=client_credentials',
	CURLOPT_RETURNTRANSFER => true
	);
	$c = curl_init();
	curl_setopt_array($c, $opts);
	$result = json_decode(curl_exec($c));
	var_dump($result);
	$_SESSION['paypal']['token'] = $result->access_token;
	curl_close($c);
}


function create_order($config) {

	$url = PAYPAL_API_URL . '/v2/checkout/orders';
	$headers = array(
	"Content-Type: application/json",
	"Authorization: Bearer " . $_SESSION['paypal']['token']
	);
	$data = array(
	'intent' => "CAPTURE",
	'purchase_units' => array(
	  array(
		'amount' => array(
		  'currency_code' => "CAD",
		  'value' => "5.00"
		)
	  )
	),
	'application_context' => array(
	  'brand_name' => 'Hogwarts Store',
	  'user_action' => 'PAY_NOW',
	  'return_url' => 'https://localhost/lab5203/lab9/confirmation.php' //
	)
	);
	//print json_encode($data);
	//add CURLOPT_SSL_VERIFYPEER false, CURLOPT_SSL_VERIFYHOST false if not using HTTPS and it doesn't work
	$opts = array(
		CURLOPT_HTTPHEADER => $headers,
		CURLOPT_URL => $url,
		CURLOPT_POST => true,
		CURLOPT_POSTFIELDS => json_encode($data),
		CURLOPT_RETURNTRANSFER => true
	);
	$c = curl_init(); //initialize curl session
	curl_setopt_array($c, $opts); //set curl options
	$result = json_decode(curl_exec($c));
	//var_dump($result); //var_export can also be used for neat display.
	curl_close($c);
	print '<p>Enter your Sandbox username and password to process payment, after clicking the link.</p>';
	print '<p><a rel="' . $result->links[1]->rel . '" href="' . $result->links[1]->href . '">Pay with Paypal</a> for Order ID: ' . $result->id . '</p>';
	//$order_id = $result->{'id'};
	//print 'id:' . $order_id . ' ';

}


?>




<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Lab 9, HTTP5203 - PayPal API Lab, Order Creation and Capturing</title>
    <link rel="stylesheet" type="text/css" href="css/main.css"/>
</head>


</html>
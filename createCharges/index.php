<?php

include_once "../server-config.php";

$url = $gateway_server."/request-receiver/EWallet-Create/";


//Order Details
$reference_id = "order-id-123";
$currency = "PHP";
$amount = 100;
$channel_code = "PH_GCASH";


//Redirect Pages
$success_payment =  $gateway_server."/Redirect/?data=".base64_encode("https://yourwebsite.com/order/success");
$failed_payment =  $gateway_server."/Redirect/?data=".base64_encode("https://yourwebsite.com/order/failed");
$cancel_payment =  $gateway_server."/Redirect/?data=".base64_encode("https://yourwebsite.com/order/cancelled");
$pending_payment =  $gateway_server."/Redirect/?data=".base64_encode("https://yourwebsite.com/order/pending");



//Payloads
$data = [
    "api_key" => $api_key,
    "reference_id" => $reference_id,
    "currency" => $currency,
    "amount" => $amount,
    "channel_code" => $channel_code,
    "channel_properties" => [
        "success_redirect_url" => $success_payment,
        "failure_redirect_url" => $failed_payment,
        "cancel_redirect_url" => $cancel_payment,
        "pending_redirect_url" => $pending_payment
    ]
];


$jsonData = json_encode($data);
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
$response = curl_exec($ch);


// Get the HTTP status code
$httpStatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE); 

if ($httpStatusCode == "200") {

    //Decode Response
    $responseData = json_decode($response, true);
    $checkout_url = $responseData['payment_url'];
    //Redirect to Payment Page
    header("location:" . $checkout_url);
    exit;


} else {
    echo $response;
}


curl_close($ch);
?>
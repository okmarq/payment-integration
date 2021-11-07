<?php

include '../env_util.php';

$transaction_id = $_GET['transaction_id'];

if ($transaction_id == '') {
    header('Location: javascript://history.go(-1)');
}

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.flutterwave.com/v3/transactions/" . rawurlencode($transaction_id) . "/verify",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "Content-Type: application/json",
        "Authorization: Bearer " . getenv('FLUTTERWAVE_SECRET_KEY')
    ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;

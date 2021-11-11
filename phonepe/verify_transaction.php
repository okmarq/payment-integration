<?php

include '../env_util.php';

$reference = $_GET['reference'];

if ($reference == '') {
    header('Location: javascript://history.go(-1)');
}

$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL => "https://mercury-uat.phonepe.com/v4/debit/",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "{\"request\":\"string\"}",
    CURLOPT_HTTPHEADER => [
        "Accept: application/json",
        "Content-Type: application/json",
        "X-CALLBACK-URL: https://payment-integration.test/phonepe/callback",
        "X-VERIFY: SHA256(base64 encoded payload + '/v4/debit' + salt key) + ### + salt index"
    ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    echo $response;
}

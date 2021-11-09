<?php

$Alpha22 = range("A","Z");
$Alpha12 = range("A","Z");
$alpha22 = range("a","z");
$alpha12 = range("a","z");
$num22 = range(1000,9999);
$num12 = range(1000,9999);
$numU22 = range(99999,10000);
$numU12 = range(99999,10000);
$AlphaB22 = array_rand($Alpha22);
$AlphaB12 = array_rand($Alpha12);
$alphaS22 = array_rand($alpha22);
$alphaS12 = array_rand($alpha12);
$Num22 = array_rand($num22);
$NumU22 = array_rand($numU22);
$Num12 = array_rand($num12);
$NumU12 = array_rand($numU12);
$res22 = $Alpha22[$AlphaB22].$num22[$Num22].$Alpha12[$AlphaB12].$numU22[$NumU22].$alpha22[$alphaS22].$num12[$Num12];
$text22 = str_shuffle($res22);

if (isset($_POST['data'])) {
    echo hash("sha256", base64_encode(json_encode($_POST['data']))) . $text22;
}

// $curl = curl_init();

// curl_setopt_array($curl, [
//     CURLOPT_URL => "https://mercury-uat.phonepe.com/v4/debit/",
//     CURLOPT_RETURNTRANSFER => true,
//     CURLOPT_ENCODING => "",
//     CURLOPT_MAXREDIRS => 10,
//     CURLOPT_TIMEOUT => 30,
//     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//     CURLOPT_CUSTOMREQUEST => "POST",
//     CURLOPT_POSTFIELDS => "{\"request\":\"string\"}",
//     CURLOPT_HTTPHEADER => [
//         "Accept: application/json",
//         "Content-Type: application/json",
//         "X-CALLBACK-URL: https://payment-integration.test/phonepe/callback",
//         "X-VERIFY: SHA256({$data})"
//     ],
// ]);

// $response = curl_exec($curl);
// $err = curl_error($curl);

// curl_close($curl);

// if ($err) {
//     echo "cURL Error #:" . $err;
// } else {
//     echo $response;
// }

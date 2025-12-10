<?php

$AUTH_CODE     = "5033fd30d46b11f0b52377d19b408a3c"; // the code you got
$CLIENT_ID     = "084a65be685547d0b9ea91ad48115814";
$CLIENT_SECRET = "69398f43cebf4ee6afac652e14ed6fff62b73b181e59426faff05cf7f2f32f7d";
$REDIRECT_URI  = "https://api.aerlawoffice.com/";  // must match registered URI

$TOKEN_URL = "https://auth.lawcus.com/oauth/token";

$data = [
    "code"          => $AUTH_CODE,
    "grant_type"    => "authorization_code",
    "client_id"     => $CLIENT_ID,
    "client_secret" => $CLIENT_SECRET,
    "redirect_uri"  => $REDIRECT_URI
];

$ch = curl_init($TOKEN_URL);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/x-www-form-urlencoded",
    "Accept: application/json"
]);

$response = curl_exec($ch);

if ($response === false) {
    die("CURL ERROR: " . curl_error($ch));
}

curl_close($ch);

$tokenData = json_decode($response, true);

if (!isset($tokenData["access_token"])) {
    die("❌ Token generation failed:\n" . $response);
}

echo "<pre>";
print_r($tokenData);
echo "</pre>";

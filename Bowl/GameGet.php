<?php


//$json = json_decode($response);
//echo $json;

//$service_url = 'http://localhost:50565/api/game';
$service_url = 'http://nyakehbowl.azurewebsites.net/api/game';

$qry_str = "/5";
$ch = curl_init();

// Set query data here with the URL
curl_setopt($ch, CURLOPT_URL, $service_url . $qry_str);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, '3');
$content = trim(curl_exec($ch));
curl_close($ch);
echo $content;


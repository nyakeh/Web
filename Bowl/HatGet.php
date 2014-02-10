<?php

//$service_url = 'http://localhost:50565/api/hat';
$service_url = 'http://nyakehbowl.azurewebsites.net/api/hat';

$qry_str = $_POST['params'];
$ch = curl_init();

// Set query data here with the URL
curl_setopt($ch, CURLOPT_URL, $service_url . $qry_str);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, '3');
$content = trim(curl_exec($ch));
curl_close($ch);
//$result = json_decode($content);
//echo $result->Name;
//echo $result->Colour;
echo $content;
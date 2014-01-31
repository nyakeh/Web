<?php
//array("myJsonData" => "test")


//$service_url = 'http://localhost:50565/api/game';
$service_url = 'http://nyakehbowl.azurewebsites.net/api/game';
$curl_post_data = json_encode("asghgd");
$ch = curl_init($service_url);

curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $curl_post_data);

curl_setopt($ch, CURLOPT_TIMEOUT, '3');
$content = trim(curl_exec($ch));
curl_close($ch);
echo $content;
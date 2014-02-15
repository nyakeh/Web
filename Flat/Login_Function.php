<?php
/*
$service_url = 'http://http://gauge.azurewebsites.net/api/login';
$curl_post_data = json_encode($account);
$ch = curl_init($service_url);

curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $curl_post_data);

curl_setopt($ch, CURLOPT_TIMEOUT, '3');
$content = trim(curl_exec($ch));
curl_close($ch);
*/

$pass = $_POST['password'];
echo "Email: " . $_POST['email'] . "Pass: " . $pass;
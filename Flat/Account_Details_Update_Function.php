<?php

$account = new AccountDetails();
$account->AccountId = $_POST['accountId']; // retrieve from php cookie
$account->Forename  = $_POST['forename'];
$account->Surname  = $_POST['surname'];
$account->Email = $_POST['email'];
$account->Password  = $_POST['password'];
/*
$service_url = 'http://gauge.azurewebsites.net/api/account'. '/'. $_POST['accountId'];
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
echo "Fname: " . $_POST['forename'] ." Sname: " . $_POST['surname'] ." Email: " . $_POST['email'] . " Pass: " . $pass;
<?php
session_start();
include('Utils.php');

$calculationId  = $_POST['calculationId'];
//$service_url = 'http://127.0.0.1:81/api/mortgage'; //local
$service_url = 'http://mortgagecalculator.cloudapp.net/api/mortgage'; //live
$qry_str = '/' . $calculationId;


$ch = curl_init($service_url . $qry_str);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_PUT, true);
curl_setopt($ch, CURLOPT_TIMEOUT, '20');

$content = trim(curl_exec($ch));
$responseCode =curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if($responseCode == 200) {
	echo 'success';
} else {
	echo 'A problem occurred favouriting the mortgage calculation.';
}
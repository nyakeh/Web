<?php
session_start();
include('Utils.php');

class EmailDetails {
    public $CalculationId = "";
    public $Address = "";
}

$email = new EmailDetails();
$email->CalculationId  = $_POST['calculationId'];
$email->Address  = $_POST['email'];

//$service_url = 'http://127.0.0.1:81/api/email'; //local
$service_url = 'http://mortgagecalculator.cloudapp.net/api/email'; //live

$curl_post_data = json_encode($email);

$ch = curl_init($service_url);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $curl_post_data);
curl_setopt($ch, CURLOPT_TIMEOUT, '20');

$content = trim(curl_exec($ch));
$responseCode =curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if($responseCode == 200) {
	echo 'Email sent successfully';
} else {
	echo 'A problem occurred emailing the mortgage calculation.';
}

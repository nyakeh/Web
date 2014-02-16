<?php
session_start();
class CalculationDetails {
    public $AccountId = "";
    public $HouseValue = "";
    public $InterestRate  = "";
    public $Term  = "";
    public $Fees  = "";
    public $MortgageType  = "";
    public $Source  = "";
}

$accountId = '';
if(isset($_SESSION['userId'])) {
    $accountId = $_SESSION['userId'];
}

$calculation = new CalculationDetails();
$calculation->AccountId = $accountId;
$calculation->HouseValue  = $_POST['houseValue'];
$calculation->InterestRate  = $_POST['interest'];
$calculation->Term = $_POST['term'];
$calculation->Fees  = $_POST['fees'];
$calculation->Source  = 'Gauge';
$calculation->MortgageType  = 'Interest Only';

$service_url = 'http://127.0.0.1:81/api/mortgage';
$curl_post_data = json_encode($calculation);

$ch = curl_init($service_url);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $curl_post_data);
curl_setopt($ch, CURLOPT_TIMEOUT, '3');

$content = trim(curl_exec($ch));
$responseCode =curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if($responseCode == 201) {
    echo $content;
} else if($responseCode == 400) {
    echo 'Error with the calculation figures input.';
} else {
    echo 'A problem occurred calculating the mortgage.';
}
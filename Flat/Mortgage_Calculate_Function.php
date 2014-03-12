<?php
session_start();
include('Utils.php');

class CalculationDetails {
    public $AccountId = "";
    public $CustomerReference = "";
    public $HouseValue = "";
    public $Deposit = "";
    public $InterestRate  = "";
    public $Term  = "";
    public $Fees  = "";
    public $MortgageType  = "";
    public $Source  = "";
}

$expected = array('houseValue', 'deposit','interest', 'term', 'fees');
$validationMessage = validateCalculationInput($expected, 'mortgage');

if($validationMessage) {
    echo 'Please amend the calculation figures';
} else {
    $accountId = '0';
    $customerReference = '00000000-0000-0000-0000-000000000000';
    if(isset($_SESSION['userId'])) {
        $accountId = $_SESSION['userId'];
    } else if(isset($_SESSION['customerReference'])) {
        $customerReference = $_SESSION['customerReference'];
    } else {
        $customerReference = com_create_guid();
        $_SESSION['customerReference'] = $customerReference;
    }

    $calculation = new CalculationDetails();
    $calculation->AccountId = $accountId;
    $calculation->CustomerReference = $customerReference;
    $calculation->HouseValue  = $_POST['houseValue'];
    $calculation->Deposit  = $_POST['deposit'];
    $calculation->InterestRate  = $_POST['interest'];
    $calculation->Term = $_POST['term'];
    $calculation->Fees  = $_POST['fees'];
    $calculation->Source  = 'Gauge Website';
    $calculation->MortgageType  = 'Repayment';

    if($calculation->Deposit === '') {
        $calculation->Deposit = 0;
    }

    if($calculation->Fees === '') {
        $calculation->Fees = 0;
    }
    //$service_url = 'http://127.0.0.1:81/api/mortgage'; //local
    $service_url = 'http://mortgagecalculator.cloudapp.net/api/mortgage'; //live

    $curl_post_data = json_encode($calculation);

    $ch = curl_init($service_url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $curl_post_data);
    curl_setopt($ch, CURLOPT_TIMEOUT, '5');

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
}
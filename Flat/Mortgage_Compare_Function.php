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
	public $Date  = "";
}
$expected = array('houseValue', 'deposit','term');
$inputValid = isCalculationInputValid($expected, 'mortgage_compare');

if(!$inputValid) {
    echo 'Please amend the calculation figures';
} else {
    $accountId = '0';
    $customerReference = '00000000-0000-0000-0000-000000000000';
    if(!empty($_SESSION['userId'])) {
        $accountId = $_SESSION['userId'];
    } else if(!empty($_SESSION['customerReference'])) {
        $customerReference = $_SESSION['customerReference'];
    } else {
		$customerReference = getGUID();
		$_SESSION['customerReference'] = $customerReference;
    }
    $calculation = new CalculationDetails();
    $calculation->AccountId = $accountId;
    $calculation->CustomerReference = $customerReference;
    $calculation->HouseValue  = $_POST['houseValue'];
    $calculation->Deposit  = $_POST['deposit'];
    $calculation->Term = $_POST['term'];
    $calculation->Source  = 'Gauge Website';
    $calculation->MortgageType  = 'Repayment';
    $calculation->InterestRate  = 0;
    $calculation->Fees  = 0;
	
	$tz_object = new DateTimeZone('Europe/London');
	$datetime = new DateTime();
    $datetime->setTimezone($tz_object);
	$calculation->Date = $datetime->format('Y-m-d H:i:s');
	
    //$service_url = 'http://127.0.0.1:81/api/mortgage'; //local
    $service_url = 'http://mortgagecalculator.cloudapp.net/api/mortgage'; //live

    $curl_post_data = json_encode($calculation);

    $ch = curl_init($service_url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $curl_post_data);
    curl_setopt($ch, CURLOPT_TIMEOUT, '20');

    $content = trim(curl_exec($ch));
    $responseCode =curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if($responseCode == 201) {
        $calculationResults = json_decode($content);
		$result = "<table><tr><th>Date</th><th>Interest Rate</th><th>Loan-To-Value</th><th>Product Fees</th><th>Monthly Payment</th><th>Total Interest</th><th>Total Owed</th></tr>";
		foreach($calculationResults as $calculation) {
			$date = date_format(date_create($calculation->Date), 'd/m/y  H:i');
			$result .= "<tr onclick=\"highlightCompare(this, ".$calculation->CalculationId.");\"><td>".$date."</td><td>".$calculation->InterestRate."</td><td>".$calculation->LoanToValue."</td><td>".$calculation->Fees."</td><td>".$calculation->MonthlyRepayment."</td><td>".$calculation->TotalInterest."</td><td>".$calculation->TotalPaid."</td></tr>";
		}
		$result .= "</table>";
		if($calculation->AccountId > 0) {
			$result .= "<div id=\"action_compare_div\"><button id=\"favourite_compare\" class=\"action_button\">FAVOURITE</button><button id=\"email_compare\" class=\"action_button\">EMAIL</button></div>";
		}
	} else if($responseCode == 400) {
		$response = json_decode($content);
		$errorMessage = $response->Message;
		$result = "<p class=\"center_message\">".$errorMessage."</p>";
    } else {
        $result = "<p class=\"center_message\">A problem occurred calculating the mortgage</p>";
    }
	echo $result;
}
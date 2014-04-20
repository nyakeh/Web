<?php 
	//$service_url = 'http://127.0.0.1:81/api/mortgage'; //local
    $service_url = 'http://mortgagecalculator.cloudapp.net/api/mortgage'; //live
	$calcId = $_POST['calculationId'];
    $qry_str = '/' . $calcId;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $service_url . $qry_str);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, '20');
    $content = trim(curl_exec($ch));
    $responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
	$result = "";
    if($responseCode == 200) {
        $calculation = json_decode($content);
		$interestRate = $calculation->InterestRate;
		$loanToValue = $calculation->LoanToValue;
		$fees = $calculation->Fees;
		$monthlyRepayment = $calculation->MonthlyRepayment;
		$totalInterest = $calculation->TotalInterest;
		$totalPaid = $calculation->TotalPaid;
        $result = "<table><tr><th>Date</th><th>Interest Rate</th><th>Loan-To-Value</th><th>Product Fees</th><th>Monthly Payment</th><th>Total Interest</th><th>Total Owed</th></tr>";
		$date = date_format(date_create($calculation->Date), 'd/m/y  H:i');
    	$result .= "<tr><td>".$date."</td><td>".$interestRate."</td><td>".$loanToValue."</td><td>".$fees."</td><td>".$monthlyRepayment."</td><td>".$totalInterest."</td><td>".$totalPaid."</td></tr>";
    	$result .= "</table>";
    } else {
        $result = "<p class=\"center_message\">Calculation could not be found in our records.</p>";
    }
	echo $result;

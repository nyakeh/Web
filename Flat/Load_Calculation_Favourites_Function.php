<?php 
	//$service_url = 'http://127.0.0.1:81/api/mortgage'; //local
    $service_url = 'http://mortgagecalculator.cloudapp.net/api/mortgage'; //live
	$userId = $_POST['userId'];
    $qry_str = '?accountId=' . $userId . '&favourite=true';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $service_url . $qry_str);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, '20');
    $content = trim(curl_exec($ch));
    $responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
	$result = "";
    if($responseCode == 200) {
        $calculationHistory = json_decode($content);
		$result = "<table><tr><th>Date</th><th>Interest Rate</th><th>Loan-To-Value</th><th>Product Fees</th><th>Monthly Payment</th><th>Total Interest</th><th>Total Owed</th></tr>";
		foreach($calculationHistory as $calculation) {
			$date = date_format(date_create($calculation->Date), 'd/m/y  H:i');
			$result .= "<tr onclick=\"highlight(this, ".$calculation->CalculationId.");\"><td>".$date."</td><td>".$calculation->InterestRate."</td><td>".$calculation->LoanToValue."</td><td>".$calculation->Fees."</td><td>".$calculation->MonthlyRepayment."</td><td>".$calculation->TotalInterest."</td><td>".$calculation->TotalPaid."</td></tr>";
		}
		$result .= "</table>";
        
    } else {
        $result = "<p>An error occured retrieving your favourite calculations.</p>";
    }
	echo $result;

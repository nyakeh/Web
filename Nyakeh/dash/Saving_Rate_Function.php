<?php
    include('database.php');
    global $conn;
        
    $accountColour = array(
        "Earned" => "rgba(71,121,101,",
        "Spent" => "rgba(176,0,17,");
        
    class SavingRateAccount {
        public $Name = "";
        public $Data = [];
        public $Colour = "";
    }
    
    class SavingRateResult {
        public $Labels = [];
        public $EarningData;
        public $SpendingData;
    }
    
    $expenseItems = array();
    $spendingResults = mysqli_query($conn,"SELECT * FROM `current_account` WHERE Value < 0 ORDER BY Date");
    $earningResults = mysqli_query($conn,"SELECT * FROM `current_account` WHERE Description LIKE '%CODEWEAVERS%' ORDER BY Date");
    
    $earningAmounts = array();
    $spendingAmounts = array();
    $dates = array();
    
    while($row = mysqli_fetch_assoc($earningResults)){
        $earningAmounts[] = $row['Value'];
    }
    $earning = new SavingRateAccount();
    $earning->Name = "Earned";
    $earning->Data = $earningAmounts;
    $earning->Colour = $accountColour["Earned"];
    
    while($row = mysqli_fetch_assoc($spendingResults)){
        $date = date_create($row['Date']);
        $month = date_format($date, 'M,y');
        
        if(isset($expenseItems[$month])) {
            $expenseItems[$month] += -$row['Value'];
        } else{
            $expenseItems[$month] = -$row['Value'];
            $dates[] = $month;
        }
    }
  
    $spendingMonthSums = array();
    foreach($expenseItems as $key=>$value){
        $spendingMonthSums[] = $value;
    }
    
    $spending = new SavingRateAccount();
    $spending->Name = "Spent";
    $spending->Data = $spendingMonthSums;
    $spending->Colour = $accountColour["Spent"];
    
    $result = new SavingRateResult();
    $result->Labels = $dates;
    $result->EarningData = $earning;
    $result->SpendingData = $spending;
    
    echo json_encode($result);
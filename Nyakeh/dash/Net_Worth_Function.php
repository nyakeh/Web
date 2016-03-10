<?php
    include('database.php');
    global $conn;
        
    $accountColour = array(
        "Current" => "rgba(71,121,101,0.2)",
        "Graduate" => "rgba(61,91,121,0.2)",
        "Pension" => "rgba(176,0,17,0.2)",
        "Investment" => "rgba(121,101,71,0.2)");
        
    class NetWorthDetails {
        public $Name = "";
        public $Data = [];
        public $Colour = "";
    }
    
    $expenseItems = array();
    $sqlResult = mysqli_query($conn,"SELECT * FROM `net_worth`");
    
    $resultsArray = array();
    $dates = array();
    $currentAmounts = array();
    $graduateAmounts = array();
    $pensionAmounts = array();
    $investmentAmounts = array();
    while($row = mysqli_fetch_assoc($sqlResult)){   
        $date = date_create($row['Date']);
        $dates[] = date_format($date, 'd/m/y');;
        $currentAmounts[] = $row['Current'];
        $graduateAmounts[] = $row['Graduate'];
        $pensionAmounts[] = $row['Pension'];
        $investmentAmounts[] = $row['Investment'];
    }
         
    // $netWorthDetail = new NetWorthDetails();
    // $netWorthDetail->Name = "Dates";
    // $netWorthDetail->Data = $dates;
    // $resultsArray[] = $netWorthDetail;
    
    $netWorthDetail = new NetWorthDetails();
    $netWorthDetail->Name = "Current";
    $netWorthDetail->Data = $currentAmounts;
    $netWorthDetail->Colour = $accountColour["Current"];
    $resultsArray[] = $netWorthDetail;
    
    $netWorthDetail = new NetWorthDetails();
    $netWorthDetail->Name = "Graduate";
    $netWorthDetail->Data = $graduateAmounts;
    $netWorthDetail->Colour = $accountColour["Graduate"];
    $resultsArray[] = $netWorthDetail;
    
    $netWorthDetail = new NetWorthDetails();
    $netWorthDetail->Name = "Pension";
    $netWorthDetail->Data = $pensionAmounts;
    $netWorthDetail->Colour = $accountColour["Pension"];
    $resultsArray[] = $netWorthDetail;
    
    $netWorthDetail = new NetWorthDetails();
    $netWorthDetail->Name = "Investment";
    $netWorthDetail->Data = $investmentAmounts;
    $netWorthDetail->Colour = $accountColour["Investment"];
    $resultsArray[] = $netWorthDetail;
    
    echo json_encode($resultsArray);
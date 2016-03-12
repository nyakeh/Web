<?php
    include('database.php');
    global $conn;
        
    $accountColour = array(
        "Current" => "rgba(71,121,101,",
        "Graduate" => "rgba(61,91,121,",
        "Pension" => "rgba(176,0,17,",
        "Investment" => "rgba(121,101,71,");
        
    class NetWorthAccount {
        public $Name = "";
        public $Data = [];
        public $Colour = "";
    }
    
    class NetWorthResult {
        public $Labels = [];
        public $Data = [];
    }
    
    $expenseItems = array();
    $sqlResult = mysqli_query($conn,"SELECT * FROM `net_worth` ORDER BY Date");
    
    $chartData = array();
    $dates = array();
    $currentAmounts = array();
    $graduateAmounts = array();
    $pensionAmounts = array();
    $investmentAmounts = array();
    while($row = mysqli_fetch_assoc($sqlResult)){   
        $date = date_create($row['Date']);
        $dates[] = date_format($date, 'M/y');;
        $currentAmounts[] = $row['Current'];
        $graduateAmounts[] = $row['Graduate'];
        $pensionAmounts[] = $row['Pension'];
        $investmentAmounts[] = $row['Investment'];
    }
    
    $current = new NetWorthAccount();
    $current->Name = "Current";
    $current->Data = $currentAmounts;
    $current->Colour = $accountColour["Current"];
    $chartData[] = $current;
    
    $graduate = new NetWorthAccount();
    $graduate->Name = "Graduate";
    $graduate->Data = $graduateAmounts;
    $graduate->Colour = $accountColour["Graduate"];
    $chartData[] = $graduate;
    
    $pension = new NetWorthAccount();
    $pension->Name = "Pension";
    $pension->Data = $pensionAmounts;
    $pension->Colour = $accountColour["Pension"];
    $chartData[] = $pension;
    
    $investment = new NetWorthAccount();
    $investment->Name = "Investment";
    $investment->Data = $investmentAmounts;
    $investment->Colour = $accountColour["Investment"];
    $chartData[] = $investment;
    
    $result = new NetWorthResult();
    $result->Labels = $dates;
    $result->Data = $chartData;    
    
    echo json_encode($result);
<?php
    include('database.php');
    global $conn;
        
    class ExpenseDetails {
        public $Current = 0;
        public $Graduate = 0;
        public $Pension = 0;
        public $Investment = 0;
    }
    
    $expenseItems = array();
    $sqlResult = mysqli_query($conn,"SELECT * FROM `net_worth`");
    
    $resultsArray = array();
    while($row = mysqli_fetch_assoc($sqlResult)){
        $monthCheckin = new ExpenseDetails();
        $monthCheckin->Current = $row['Current'];
        $monthCheckin->Graduate = $row['Graduate'];
        $monthCheckin->Pension = $row['Pension'];
        $monthCheckin->Investment = $row['Investment'];
        $resultsArray[] = $monthCheckin;
    }
    
    echo json_encode($resultsArray);
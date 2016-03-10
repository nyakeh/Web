<?php
    include('database.php');
    global $conn;
    
    $monthIndex = array(
    "january" => 1,
    "february" => 2,
    "march" => 3,
    "april" => 4,
    "may" => 5,
    "june" => 6,
    "july" => 7,
    "august" => 8,
    "september" => 9,
    "october" => 10,
    "november" => 11,
    "december" => 12);
    
    class ExpenseDetails {
        public $Category = "";
        public $Amount = 0;
    }
    $month = $_POST['month'];
    $year = $_POST['year'];
    $expenseItems = array();
    $sqlResult = mysqli_query($conn,"SELECT * FROM `current_account` WHERE value < 0 AND MONTH(date) = ".$monthIndex[$month]." AND YEAR(date) = " . $year);
    
    while($row = mysqli_fetch_assoc($sqlResult)){
        echo $row['value'];
        if(isset($expenseItems[$row['Category']])) {
            $expenseItems[$row['Category']] += $row['Value'];
        } else{
            $expenseItems[$row['Category']] = $row['Value'];
        }
    }
  
  $resultArray = array();
    foreach($expenseItems as $key=>$value){
        $piecesOfPie = new ExpenseDetails();
        $piecesOfPie->Category = $key;
        $piecesOfPie->Amount = $value;
        $resultArray[] = $piecesOfPie;
    }
    
    echo json_encode($resultArray);

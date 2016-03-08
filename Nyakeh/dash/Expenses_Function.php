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
       // public $Colour  = "";
    }
    $month = "2";
    $year = "2016";
    // $month = $_POST['month'];
    // $year = $_POST['year'];
    $expenseItems = array();
    $sqlResult = mysqli_query($conn,"SELECT * FROM `current_account` WHERE MONTH(date) = 2 and YEAR(date) = " . $year);
    
    while($row = mysqli_fetch_assoc($sqlResult)){
        echo $row['value'];
        if(isset($expenseItems[$row['Category']])) {
            $expenseItems[$row['Category']] += $row['Value'];
        } else{
            $expenseItems[$row['Category']] = $row['Value'];
        }
    }
  //  echo json_encode($expenseItems);
  
  $resultArray = array();
    foreach($expenseItems as $key=>$value){
        $piecesOfPie = new ExpenseDetails();
        $piecesOfPie->Category = $key;
        $piecesOfPie->Amount = $value;
        $resultArray[] = $piecesOfPie;
        #$piecesOfPie->Colour = "#A7464A";
    }
    
    // $piecesOfPie = new ExpenseDetails();
    // $piecesOfPie->Category = "nyakeh";
    // $piecesOfPie->Amount = 200;
    // $piecesOfPie->Colour = "#A7464A";
    
    // $resultArray = [$piecesOfPie];
    
    echo json_encode($resultArray);

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
        public $Colour  = "";
    }
    
    $month = $_POST['month'];
    $year = $_POST['year'];
    
    $result = mysqli_query($conn,"SELECT * FROM `current_account` WHERE MONTH(date) = ".$monthIndex[$month]." and YEAR(date) = " . $year);
    
    while($row = mysqli_fetch_assoc($result)){
        /*echo "ID: ".$row['id'].", Value:".$row['Value'] .", Category:".$row['Category'].", Date:".$row['Date']."<br/>";*/
    }
    
    $piecesOfPie = new ExpenseDetails();
    $piecesOfPie->Category = "nyakeh";
    $piecesOfPie->Amount = 200;
    $piecesOfPie->Colour = "#A7464A";
    
    $resultArray = [$piecesOfPie];
    
    echo json_encode($resultArray);

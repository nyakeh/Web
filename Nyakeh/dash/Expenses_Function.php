<?php
    include('database.php');
    global $conn;
    
    class ExpenseDetails {
        public $Category = "";
        public $Amount = 0;
        public $Colour  = "";
    }
    
    $month = $_POST['month'];
    $year = $_POST['year'];
    
    $result = mysqli_query($conn,"SELECT * FROM `current_account` WHERE MONTH(date) = 2 and YEAR(date) = " . $year);
    
    while($row = mysqli_fetch_assoc($result)){
        /*echo "ID: ".$row['id'].", Value:".$row['Value'] .", Category:".$row['Category'].", Date:".$row['Date']."<br/>";*/
    }
    $piecesOfPie = new ExpenseDetails();
    $piecesOfPie->Category = "nyakeh";
    $piecesOfPie->Amount = 200;
    $piecesOfPie->Colour = "#A7464A";
    
    $resultArray = [$piecesOfPie];
    
    echo json_encode($resultArray);

<?php
    include('database.php');
    global $conn;    
    
    class Entry {
        public $Date = 0;
        public $Made = 0;
        public $Spent = 0;
        public $Invested = 0;
    }
    
    if (isset($_POST['date'])) {
        $date = $_POST['date'];    
        $made = $_POST['made'];
        $spent = $_POST['spent'];
        $invested = $_POST['invested'];
        
        mysqli_query($conn,"INSERT INTO `wall_chart` (Date, Made, Spent, Invested) VALUES (".$date.",".$made.",".$spent.",".$invested.");");
    } else {
        $sqlResult = mysqli_query($conn,"SELECT * FROM `wall_chart` ORDER BY Date;");
        
        $entries = array();
        while($row = mysqli_fetch_assoc($sqlResult)){
            $currentEntry = new Entry();
            $currentEntry->Date = $row['Date'];
            $currentEntry->Made = $row['Made'];
            $currentEntry->Spent = $row['Spent'];
            $currentEntry->Invested = $row['Invested'];
            $entries[] = $currentEntry;
        }
        
        echo json_encode($entries);
    }
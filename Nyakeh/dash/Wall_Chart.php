<?php
    include('database.php');
    global $conn;
        
    $date = $_POST['date'];    
    $made = $_POST['made'];
    $spent = $_POST['spent'];
    $invested = $_POST['invested'];
    
    $sqlResult = mysqli_query($conn,"INSERT INTO `wall_chart` (date, made, spent, invested) VALUES (".$date.",".$made.",".$spent.",".$invested.");");
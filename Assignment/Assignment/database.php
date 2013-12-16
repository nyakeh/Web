<?php
    $host='localhost';
    $user='root';
    $password='';
    $databaseName='r004869a';
    $conn = mysqli_connect($host, $user, $password, $databaseName);
    if (mysqli_connect_errno($conn)) {
        echo 'Failed to connect to MySQL: ' . mysqli_connect_error();
    }
?>
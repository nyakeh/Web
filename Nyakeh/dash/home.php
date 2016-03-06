<?php
    echo "hello";
    
    mysql_connect('localhost', 'nyakeh_dashboard', 'RCzF6ppBrKC7YSt7') or die(mysql_error());
        
    echo "hello0";
    mysql_select_db("dashboard") or die(mysql_error());
    
    echo "hello1";
    $result = mysql_query("SELECT * FROM current_account limit 10");
 
    echo mysql_error();
    echo $result;
    mysql_close($link);
 
?>
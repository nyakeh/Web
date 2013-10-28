<?php
$oneToFiveTimesTable = array(array(1, 2, 3, 4, 5),
    array(2, 4, 6, 8, 10),
    array(3, 6, 9, 12, 15),
    array(4, 8, 12, 16, 20),
    array(5, 10, 15, 20, 25));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Task 5</title>
</head>
<body>
<?php
    $output = "<table>";
    foreach ($oneToFiveTimesTable as $row) {
        $output .= "<tr>";

        foreach ($row as $column) {
            $output .= "<td>";
            $output .= $column;
            $output .= "</td>";
        }

        $output .= "</tr>";
    }
    echo $output;
?>
</body>
</html>
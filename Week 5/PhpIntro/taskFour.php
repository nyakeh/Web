<?php
$randomNumber = rand(0, 1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Task 4</title>
</head>
<body>
<?php
    if ($randomNumber == 0) {
        echo "Heads";
    } else {
        echo "Tails";
    }
?>
</body>
</html>
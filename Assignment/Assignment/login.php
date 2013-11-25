<?php
    session_start();
    include('database.php');

    $output = '';
    if(!isset($_SESSION['username'])) {
        header('Location: Home.php');
    }
    if($_POST) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM tblUser WHERE username LIKE '$username' ORDER BY userId";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_array($result)) {
            if($username == $row['username'] & $password == $row['password']) {
                $_SESSION['username'] = $username;
                $output = "Welcome back " . $username;
            } else {
                header('Location: Home.php');
            }
        }
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <title>Welcome</title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="Styles.css">
    <script src="script.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Slackey' rel='stylesheet' type='text/css'>
</head>

<body>
    <header>
        <h1>Car Catalogue</h1>
    <nav>
            <ul>
                <a href="#"><li>Home</li></a>
                <a href="search.php"><li>Search</li></a>
                <a href="account.html"><li>Your Account</li></a>
            </ul>
            <p><?php if($output == '') { echo "Hi " . $_SESSION['username']; } ?> <a href="Home.php?logOut=true">log off</a></p>
        </nav>
    </header>

    <section>
        <div><p>Favorite Searches:</p></div>
    </section>
</body>
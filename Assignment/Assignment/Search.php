<?php
    session_start();
    include('database.php');
    include('utils.php');
    if(!isset($_SESSION['username'])) {
        header('Location: Home.php');
    }
    $results = '';
    if($_POST) {
        if($_POST['criteria'] == "make"){
            $results = SearchMake($conn, $_POST['searchText']);
        } // else if...
    }
?>
<!DOCTYPE html>
<html lang="en">
<head> <meta charset="utf-8">
    <title>Car Catalogue</title>
    <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>-->
    <link rel="stylesheet" type="text/css" href="Styles.css">
    <script src="script.js"></script>
</head>
<body>
<header>
    <h1>Car Catalogue</h1>
    <nav>
        <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="search.php">Search</a></li>
            <li><a href="account.php">Account</a></li>
            <li><a href="Register.php">Register temp link</li></a>
        </ul>
        <p><?php echo "Hi " . $_SESSION['username'] ?> <a href="Home.php?logOut=true">log off</a></p>
    </nav>
</header>

<section>
    <p>Enter your search query</p>

    <form id="search" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <p><label>Make: <input type="text" name="searchText" id="searchText"/></label></p>
        <input type="hidden" name="criteria" id="criteria" value="make"/>
        <p><input type="submit"></p>
    </form>
    <p><?php echo $results ?></p>
</section>
</body>
</html>
<?php
    session_start();
    include('database.php');
    include('utils.php');
    if(!isset($_SESSION['username'])) {
        header('Location: Home.php');
    }
    $results = '';
    if($_POST) {
        if( isset( $_REQUEST['save'] ))
        {
            SaveSearch();
        } else {
            $results = Search($_POST['searchText'], $_POST['criteria']);
        }
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
    <form id="search" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">

        <p>How would you like to search our car database?</p>
        <select name="criteria" id = "criteria">
            <option value = "make">Make</option>
            <option value = "model">Model</option>
            <option value = "year">Year</option>
            <option value = "colour">Colour</option>
        </select>
        <p><label>Search string: <input type="text" name="searchText" id="searchText"/></label></p>
        <p><input type="submit"></p>
    </form>
    <?php if($results !== '' && $results !== 'No results found') { ?>
    <p><?php echo $results ?></p>
    <p><button onclick="SaveSearch();">save</button></p>
    <form id="saveSearch" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <input type="submit" name="save" value="save" />
    </form>
    <?php }; ?>
</section>
</body>
</html>
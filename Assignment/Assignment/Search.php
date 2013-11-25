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
    <link rel="stylesheet" type="text/css" href="Styles.css">
    <script src="script.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Slackey' rel='stylesheet' type='text/css'>
</head>
<body>
<header>
    <h1>Car Catalogue</h1>
    <nav>
        <ul>
            <li><a href="login.php">Home</a></li>
            <li><a href="search.php">Search</a></li>
            <li><a href="account/">Your Account</a></li>
        </ul>
        <p><?php echo "Hi " . $_SESSION['username'] ?> <a href="Home.php?logOut=true">log off</a></p>
    </nav>
</header>

<section>
    <p>Search blurb. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tellus enim, mollis in ante non,
        aliquam ullamcorper lacus. Fusce gravida tincidunt nulla eu varius. Integer nisl urna, suscipit sed luctus ut,
        suscipit id leo. In mollis enim ante, nec vestibulum neque rutrum id.</p>
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
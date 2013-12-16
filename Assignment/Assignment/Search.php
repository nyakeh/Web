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
            $searchText = $_POST['searchText'];
            $results = Search($searchText, $_POST['criteria']);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head> <meta charset="utf-8">
    <title>Car Catalogue</title>
    <link rel="stylesheet" type="text/css" href="Styles.css">
    <script src="script.js"></script>
</head>
<body>
<header>
    <img src="Logo.png" id="logo">
    <nav>
        <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="search.php">Search</a></li>
            <li><a href="account.php">Account</a></li>

            <div class="welcome">
                <p><?php echo "Hi " . $_SESSION['username'] . ". "; ?><a href="Home.php?logOut=true">log off</a></p>
            </div>
        </ul>
    </nav>
</header>

<section>
    <form id="search" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <p>How would you like to <span class="bold">search</span> our car database?</p>
        <select name="criteria" id = "criteria">
            <option value = "make">Make</option>
            <option value = "model">Model</option>
            <option value = "year">Year</option>
            <option value = "colour">Colour</option>
        </select>
        <p><label>Search string: </label><input type="text" name="searchText" id="searchText" <?php echo addValueTag(@$searchText); ?>></p>
        <p><input type="submit"></p>
    </form>
    <?php if($results !== '' && $results !== 'No results found') { ?>
    <p><?php echo '<section id="NewSearch">' . $results . '</section>' ?></p>
    <form id="saveSearch" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <input type="submit" name="save" value="save">
    </form>
    <?php }; ?>
</section>
<footer><p>Made by Nyakeh Rogers</p></footer>
</body>
</html>
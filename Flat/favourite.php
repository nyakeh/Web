<?php 
    session_start(); 
    include( 'Utils.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Gauge</title>
    <link rel="stylesheet" type="text/css" href="Style.css">
    <script src="js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="Script.js"></script>
	<?php if(isset($_SESSION['userId'])) { ?>
	<script type='text/javascript'> window.onload=loadFavourites(<?php echo $_SESSION['userId'] ?>); </script>
	<?php } ?>
</head>

<body>
<div id="all">
    <header>
        <div class="container">
            <a href="index"><h1>Gauge</h1></a>
            <nav>
                <ul>
                    <li><a href="mortgage">Mortgage</a></li>
                    <li><a href="compare">Compare</a></li>
                    <li><a href="borrow">Borrow</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <?php if(isset($_SESSION['userId'])) { ?>
    <div class="customer">
        <div class="container">
            <div id="customerAccount"><a href="account.php"><?php echo $_SESSION['username'] ?></a> <a href="favourite.php">Favourites</a> <a href="index.php?logOut=true">Log off</a></div>
        </div>
    </div>
    <?php } ?>
    <div id="content">
    <div class="heading">
        <h1>Favourite Calculations</h1>
    </div>
    <div class="section" id="favouriteCalculations">
        <p>Here are the calculations you favourited earlier</p>
		<div id="favouritesTable"><p>We're just <span class="bold">retreiving</span> your favourite calculations.</p><p><img src="img/loader.gif"></p></div>
    </div>
	</div>
	<footer>
		<nav>
			<ul>
				<li><a href="index">Gauge</a></li>
				<li><a href="mortgage" class="greyText">Mortgage</a></li>
				<li><a href="compare" class="greyText">Compare</a></li>
				<li><a href="borrow" class="greyText">Borrow</a></li>
			</ul>
		</nav>
		<a href="http://www.nyakeh.co.uk">
			<img src="img/Emblem.png">
		</a>
	</footer>
</div>
</body>

</html>